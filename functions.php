<?php
if (!defined('ABSPATH')) { exit; }

require_once get_template_directory() . '/inc/client-status.php';
require_once get_template_directory() . '/inc/mail.php';
require_once get_template_directory() . '/inc/studio.php';

define('ZM_VERSION', '1.4.3');

function zm_setup(): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_image_size('zm-project', 1200, 820, true);
    register_nav_menus(['primary' => __('Menu główne', 'zielona-marka')]);
}
add_action('after_setup_theme', 'zm_setup');

function zm_assets(): void {
    wp_enqueue_style('zm-main', get_template_directory_uri() . '/assets/css/main.css', [], ZM_VERSION);

    if (is_front_page() || is_page('en')) {
        wp_enqueue_style('zm-live-home', get_template_directory_uri() . '/assets/css/live-home.css', ['zm-main'], ZM_VERSION);
        wp_enqueue_script('zm-live-home', get_template_directory_uri() . '/assets/js/live-home.js', [], ZM_VERSION, true);
    }

    if (is_page('detailflow')) {
        wp_enqueue_style('zm-detailflow', get_template_directory_uri() . '/assets/css/detailflow.css', ['zm-main'], ZM_VERSION);
    }

    $parity_deps = is_front_page() || is_page('en') ? ['zm-live-home'] : ['zm-main'];
    wp_enqueue_style('zm-production-parity', get_template_directory_uri() . '/assets/css/production-parity.css', $parity_deps, ZM_VERSION);

    wp_enqueue_script('zm-main', get_template_directory_uri() . '/assets/js/main.js', [], ZM_VERSION, true);
}
add_action('wp_enqueue_scripts', 'zm_assets');

function zm_body_classes(array $classes): array {
    if (is_front_page()) {
        $classes[] = 'zm-public-page';
        $classes[] = 'zm-page-home';
        return $classes;
    }

    if (is_page()) {
        $page = get_queried_object();
        if ($page instanceof WP_Post) {
            $slug = sanitize_html_class($page->post_name);
            $classes[] = 'zm-public-page';
            $classes[] = 'zm-page-' . $slug;
        }
    }

    return $classes;
}
add_filter('body_class', 'zm_body_classes');


function zm_register_project_type(): void {
    register_post_type('realizacja', [
        'labels' => [
            'name' => __('Realizacje', 'zielona-marka'),
            'singular_name' => __('Realizacja', 'zielona-marka'),
            'add_new_item' => __('Dodaj realizację', 'zielona-marka'),
            'edit_item' => __('Edytuj realizację', 'zielona-marka'),
        ],
        'public' => true,
        'menu_icon' => 'dashicons-layout',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'],
        'has_archive' => false,
        'rewrite' => ['slug' => 'projekt', 'with_front' => false],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'zm_register_project_type');

function zm_project_meta_box(): void {
    add_meta_box('zm_project_details', __('Szczegóły realizacji', 'zielona-marka'), 'zm_project_meta_box_html', 'realizacja', 'side', 'default');
}
add_action('add_meta_boxes', 'zm_project_meta_box');

function zm_project_meta_box_html(WP_Post $post): void {
    wp_nonce_field('zm_save_project', 'zm_project_nonce');
    $client = get_post_meta($post->ID, 'klient', true);
    $scope = get_post_meta($post->ID, 'zakres', true);
    ?>
    <p><label for="zm-client"><strong><?php esc_html_e('Klient', 'zielona-marka'); ?></strong></label><br><input class="widefat" id="zm-client" name="zm_client" value="<?php echo esc_attr($client); ?>"></p>
    <p><label for="zm-scope"><strong><?php esc_html_e('Zakres', 'zielona-marka'); ?></strong></label><br><input class="widefat" id="zm-scope" name="zm_scope" value="<?php echo esc_attr($scope); ?>" placeholder="np. Projekt, WordPress, SEO"></p>
    <p><?php esc_html_e('Miniatura wpisu jest używana jako podgląd projektu w portfolio.', 'zielona-marka'); ?></p>
    <?php
}

function zm_save_project_meta(int $post_id): void {
    if (!isset($_POST['zm_project_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['zm_project_nonce'])), 'zm_save_project')) { return; }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }
    if (!current_user_can('edit_post', $post_id)) { return; }
    update_post_meta($post_id, 'klient', sanitize_text_field(wp_unslash($_POST['zm_client'] ?? '')));
    update_post_meta($post_id, 'zakres', sanitize_text_field(wp_unslash($_POST['zm_scope'] ?? '')));
}
add_action('save_post_realizacja', 'zm_save_project_meta');

function zm_customize_register(WP_Customize_Manager $customizer): void {
    $customizer->add_section('zm_contact', [
        'title' => __('Zielona Marka, kontakt', 'zielona-marka'),
        'priority' => 30,
    ]);
    $fields = [
        'zm_email' => ['E-mail', 'kontakt@zielona-marka.pl', 'email'],
        'zm_phone' => ['Telefon', '+48 450 458 466', 'text'],
        'zm_instagram' => ['Adres profilu Instagram', 'https://www.instagram.com/zielona.marka.pl/', 'url'],
    ];
    foreach ($fields as $id => [$label, $default, $type]) {
        $customizer->add_setting($id, ['default' => $default, 'sanitize_callback' => $type === 'email' ? 'sanitize_email' : ($type === 'url' ? 'esc_url_raw' : 'sanitize_text_field')]);
        $customizer->add_control($id, ['label' => __($label, 'zielona-marka'), 'section' => 'zm_contact', 'type' => $type]);
    }
}
add_action('customize_register', 'zm_customize_register');

function zm_handle_brief(): void {
    if (!isset($_POST['zm_brief_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['zm_brief_nonce'])), 'zm_send_brief')) {
        wp_safe_redirect(add_query_arg('brief', 'error', wp_get_referer() ?: home_url('/')) . '#kontakt');
        exit;
    }

    $name = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $company = sanitize_text_field(wp_unslash($_POST['company'] ?? ''));
    $project_type = sanitize_text_field(wp_unslash($_POST['projectType'] ?? ''));
    $goal = sanitize_text_field(wp_unslash($_POST['goal'] ?? ''));
    $commerce = sanitize_text_field(wp_unslash($_POST['commerce'] ?? ''));
    $budget = sanitize_text_field(wp_unslash($_POST['budget'] ?? ''));
    $timeline = sanitize_text_field(wp_unslash($_POST['timeline'] ?? ''));
    $honeypot = sanitize_text_field(wp_unslash($_POST['companyWebsite'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));
    $website = esc_url_raw(wp_unslash($_POST['website'] ?? ''));
    $audit = !empty($_POST['audit']);
    $assistant_goal = sanitize_text_field(wp_unslash($_POST['assistantGoal'] ?? ''));
    $assistant_industry = sanitize_text_field(wp_unslash($_POST['assistantIndustry'] ?? ''));
    $phone = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));
    $consent = sanitize_text_field(wp_unslash($_POST['consent'] ?? ''));

    if ($assistant_goal || $assistant_industry) {
        $message = "Asystent demonstracyjny\nCel: {$assistant_goal}\nBranża: {$assistant_industry}\nTelefon: " . ($phone ?: 'nie podano') . "\n\n" . ($message ?: 'Prośba o kontakt.');
        $project_type = 'Asystent dla firmy';
    }

    if ($honeypot !== '') {
        wp_safe_redirect(add_query_arg('brief', 'sent', wp_get_referer() ?: home_url('/')) . '#kontakt');
        exit;
    }

    if (!$name || !is_email($email) || !$message || $consent !== 'yes') {
        wp_safe_redirect(add_query_arg('brief', 'error', wp_get_referer() ?: home_url('/')) . '#kontakt');
        exit;
    }

    $recipient = get_theme_mod('zm_email', get_option('admin_email'));
    $subject = sprintf(__('Nowy brief: %s', 'zielona-marka'), $company ?: $name);
    $body = "Imię: {$name}\nE-mail: {$email}\nTelefon: {$phone}\nFirma: {$company}\nPotrzeba: {$project_type}\nNajważniejszy efekt: {$goal}\nSprzedaż lub płatności: {$commerce}\nAdres strony: {$website}\nPlanowany termin: {$timeline}\nTryb minioceny: " . ($audit ? 'tak' : 'nie') . "\nBudżet: {$budget}\n\nOpis projektu:\n{$message}";

    zm_store_inquiry([
        'name' => $name,
        'email' => $email,
        'company' => $company,
        'phone' => $phone,
        'budget' => $budget,
        'timeline' => $timeline,
        'project_type' => $project_type,
        'goal' => $goal,
        'commerce' => $commerce,
        'website' => $website,
        'audit' => $audit ? 'tak' : 'nie',
        'message' => $message,
    ]);
    $sent = wp_mail($recipient, $subject, $body, ['Reply-To: ' . $name . ' <' . $email . '>']);
    wp_safe_redirect(add_query_arg('brief', $sent ? 'sent' : 'error', wp_get_referer() ?: home_url('/')) . '#kontakt');
    exit;
}
add_action('admin_post_nopriv_zm_send_brief', 'zm_handle_brief');
add_action('admin_post_zm_send_brief', 'zm_handle_brief');

function zm_seo_data(): array {
    $defaults = [
        'title' => 'Strony internetowe dla firm usługowych | Zielona Marka',
        'description' => 'Strony WWW, formularze wyceny, mały CRM i usprawnienia dla lokalnych firm usługowych. Warszawa, Targówek i okolice oraz współpraca zdalna w całej Polsce.',
    ];

    if (is_front_page()) {
        return $defaults;
    }

    if (!is_page()) {
        return $defaults;
    }

    $page = get_queried_object();
    $slug = $page instanceof WP_Post ? $page->post_name : '';

    $map = [
        'oferta' => ['Oferta stron WWW i systemów dla firm | Zielona Marka', 'Pakiety stron WWW, formularze, mały CRM, asystent zapytań, mini sklep i opieka. Jasne ceny startowe i zakres prac.'],
        'modernizacja-strony' => ['Modernizacja strony internetowej dla firmy | Zielona Marka', 'Audyt i modernizacja istniejącej strony: wersja mobilna, kontakt, treści, szybkość, formularze i podstawy widoczności w Google.'],
        'realizacje' => ['Projekty i demonstracje | Zielona Marka', 'Zobacz demonstracyjne strony i systemy dla beauty, gastronomii, nieruchomości, warsztatu i transportu.'],
        'maly-crm-dla-firm' => ['Mały CRM dla firmy usługowej | Zielona Marka', 'Prosty CRM do klientów, zapytań, wycen, statusów zleceń, terminów i następnych działań.'],
        'usprawnienia-firmy' => ['Usprawnienia i automatyzacje dla małej firmy | Zielona Marka', 'Formularze, automatyzacje, raporty i proste systemy, które ograniczają ręczne przepisywanie danych i pilnowanie terminów.'],
        'jak-pracuje' => ['Jak pracuję nad stroną i systemem | Zielona Marka', 'Proces współpracy od briefu, przez projekt i wdrożenie, po QA, publikację, przekazanie dostępów i wsparcie.'],
        'kontakt' => ['Kontakt i wycena projektu | Zielona Marka', 'Opowiedz o swojej firmie i potrzebie. Kontakt telefoniczny, e-mail, WhatsApp lub spotkanie online.'],
        'strony-dla-warsztatow' => ['Strony internetowe dla warsztatów i detailingu | Zielona Marka', 'Strona warsztatu z formularzem: auto, usterka, zdjęcia i termin. Rozwiązania dla warsztatów, detailingu i lokalnych serwisów.'],
        'strony-dla-firm-uslugowych' => ['Strony dla firm remontowych i instalatorów | Zielona Marka', 'Strona i formularz wyceny dla ekip remontowych, hydraulików, elektryków, instalatorów i lokalnych wykonawców.'],
        'strony-dla-beauty' => ['Strony internetowe dla branży beauty | Zielona Marka', 'Strony, rezerwacje i sprzedaż dla salonów kosmetycznych, fryzjerów, barberów, masażu i usług umawianych na termin.'],
        'asystent-zapytan' => ['Asystent zapytań dla firmy usługowej | Zielona Marka', 'Asystent FAQ, kwalifikacja zapytań i przekazanie kontaktu dla warsztatów, wykonawców, salonów beauty i lokalnych usług.'],
        'strony-internetowe-marki' => ['Strony internetowe Marki i okolice | Zielona Marka', 'Strony internetowe dla firm z Marek i okolic: oferta, formularz, lokalne podstawy Google i prosty kontakt z klientem.'],
        'raport-qa' => ['Przykładowy raport kontroli jakości | Zielona Marka', 'Zobacz, co jest sprawdzane przed publikacją strony: urządzenia, formularze, linki, podstawy Google, szybkość i stabilność.'],
        'polityka-prywatnosci' => ['Polityka prywatności | Zielona Marka', 'Informacje o przetwarzaniu danych w formularzu kontaktowym, Strefie klienta i serwisie Zielona Marka.'],
        'en' => ['Websites and business systems | Zielona Marka', 'Websites, enquiry forms, small CRM systems and practical digital workflows for service businesses.'],
        'status' => ['Status projektu | Zielona Marka', 'Private client area for checking project progress, next steps, deadlines and documents.'],
    ];

    if (isset($map[$slug])) {
        return ['title' => $map[$slug][0], 'description' => $map[$slug][1]];
    }

    if ($page instanceof WP_Post && $page->post_parent) {
        $parent = get_post($page->post_parent);
        if ($parent instanceof WP_Post && $parent->post_name === 'strony-internetowe') {
            $city_names = [
                'targowek' => 'Targówek',
                'warszawa' => 'Warszawa',
                'zabki' => 'Ząbki',
                'zielonka' => 'Zielonka',
                'kobylka' => 'Kobyłka',
                'wolomin' => 'Wołomin',
                'radzymin' => 'Radzymin',
                'bialoleka' => 'Białołęka',
            ];
            $city = $city_names[$slug] ?? ucfirst($slug);
            return [
                'title' => sprintf('Strony internetowe %s dla firm | Zielona Marka', $city),
                'description' => sprintf('Strony internetowe, formularze i lokalne podstawy Google dla firm usługowych z obszaru %s i okolic.', $city),
            ];
        }
    }

    return $defaults;
}

function zm_document_title(string $title): string {
    if (is_front_page() || is_page()) {
        $seo = zm_seo_data();
        return $seo['title'] ?? $title;
    }
    return $title;
}
add_filter('pre_get_document_title', 'zm_document_title');

function zm_meta_tags(): void {
    if (!(is_front_page() || is_page()) || is_page(['status', 'umowa-przykladowa']) || (string) get_query_var('zm_status_code') !== '') {
        return;
    }
    if (defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || defined('SEOPRESS_VERSION')) {
        return;
    }

    $seo = zm_seo_data();
    $title = $seo['title'] ?? get_bloginfo('name');
    $description = $seo['description'] ?? '';
    $canonical = is_front_page() ? home_url('/') : get_permalink();
    $image = get_template_directory_uri() . '/assets/images/fern-stream-hero.png';

    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($canonical) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action('wp_head', 'zm_meta_tags', 5);

function zm_schema(): void {
    if (!is_front_page()) { return; }

    $schema = [
        [
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => 'Zielona Marka',
            'url' => home_url('/'),
            'email' => get_theme_mod('zm_email', 'kontakt@zielona-marka.pl'),
            'telephone' => get_theme_mod('zm_phone', '+48 450 458 466'),
            'areaServed' => 'PL',
            'description' => 'Strony WWW, formularze wyceny, małe CRM-y i usprawnienia dla lokalnych firm usługowych.',
            'serviceType' => ['Strony internetowe', 'Formularze wyceny', 'Mały CRM', 'WordPress', 'Lokalne SEO'],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'OfferCatalog',
            'name' => 'Oferta Zielonej Marki',
            'itemListElement' => [
                [
                    '@type' => 'Offer',
                    'name' => 'ZM Start',
                    'price' => '1449',
                    'priceCurrency' => 'PLN',
                    'valueAddedTaxIncluded' => false,
                    'url' => home_url('/oferta'),
                ],
                [
                    '@type' => 'Offer',
                    'name' => 'ZM LeadFlow',
                    'price' => '4490',
                    'priceCurrency' => 'PLN',
                    'valueAddedTaxIncluded' => false,
                    'url' => home_url('/oferta'),
                ],
                [
                    '@type' => 'Offer',
                    'name' => 'ZM Flow',
                    'price' => '6900',
                    'priceCurrency' => 'PLN',
                    'valueAddedTaxIncluded' => false,
                    'url' => home_url('/oferta'),
                ],
            ],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
add_action('wp_head', 'zm_schema', 30);



function zm_private_pages_robots(array $robots): array {
    if (is_page(['status', 'umowa-przykladowa']) || (string) get_query_var('zm_status_code') !== '') {
        $robots['noindex'] = true;
        $robots['nofollow'] = true;
    }
    return $robots;
}
add_filter('wp_robots', 'zm_private_pages_robots', 40);

function zm_exclude_private_pages_from_sitemap(array $args, string $post_type): array {
    if ($post_type !== 'page') {
        return $args;
    }
    $exclude = [];
    foreach (['status', 'umowa-przykladowa'] as $slug) {
        $page = get_page_by_path($slug);
        if ($page instanceof WP_Post) {
            $exclude[] = $page->ID;
        }
    }
    if ($exclude) {
        $args['post__not_in'] = array_values(array_unique(array_merge($args['post__not_in'] ?? [], $exclude)));
    }
    return $args;
}
add_filter('wp_sitemaps_posts_query_args', 'zm_exclude_private_pages_from_sitemap', 10, 2);

function zm_render_contact_form(bool $audit = false): void {
    $brief_status = sanitize_key(wp_unslash($_GET['brief'] ?? ''));
    if ($brief_status === 'sent') {
        echo '<div class="form-success" role="status"><b>Dziękuję, wiadomość została wysłana.</b><p>Wrócę z propozycją kolejnego kroku i wstępną wyceną.</p></div>';
        return;
    }
    ?>
    <form class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
        <input type="hidden" name="action" value="zm_send_brief">
        <input type="hidden" name="audit" value="<?php echo $audit ? '1' : '0'; ?>">
        <?php wp_nonce_field('zm_send_brief', 'zm_brief_nonce'); ?>
        <label>Imię<input required name="name" placeholder="Jak masz na imię?" autocomplete="name"></label>
        <label>E-mail<input required type="email" name="email" placeholder="twoj@email.pl" autocomplete="email"></label>
        <label>Firma <span>(opcjonalnie)</span><input name="company" placeholder="Nazwa firmy" autocomplete="organization"></label>
        <input class="form-honeypot" name="companyWebsite" tabindex="-1" autocomplete="off" aria-hidden="true">
        <?php if ($audit) : ?><label>Adres obecnej strony <span>(opcjonalnie)</span><input name="website" type="url" placeholder="https://twoja-strona.pl"></label><?php endif; ?>
        <label>Czego potrzebujesz?<select required name="projectType"><option value="" disabled selected>Wybierz najbliższą odpowiedź</option><option>Strona dla warsztatu lub detailingu</option><option>Strona dla firmy remontowej lub instalatora</option><option>Strona dla beauty lub usług na termin</option><option>Nowa strona dla innej firmy usługowej</option><option>Modernizacja obecnej strony</option><option>Formularz wyceny lub zgłoszenia</option><option>Mały CRM do klientów i zleceń</option><option>Asystent dla firmy</option><option>Potrzebuję krótkiej konsultacji</option></select></label>
        <label>Najważniejszy efekt<select name="goal"><option value="">Wybierz efekt</option><option>Więcej konkretnych zapytań</option><option>Lepszy kontakt z telefonu</option><option>Łatwiejsza wycena</option><option>Porządek w klientach i zleceniach</option><option>Sprzedaż online lub płatności</option><option>Modernizacja obecnej strony</option></select></label>
        <label>Sprzedaż lub płatności <span>(opcjonalnie)</span><select name="commerce"><option value="">Nie dotyczy / do ustalenia</option><option>Rezerwacja usługi</option><option>Mini sklep</option><option>Vouchery</option><option>Płatność online</option><option>Potrzebuję konsultacji</option></select></label>
        <label>Orientacyjny budżet <span>(opcjonalnie)</span><select name="budget"><option value="">Nie chcę deklarować</option><option>do 2 500 zł</option><option>2 500–5 000 zł</option><option>5 000–10 000 zł</option><option>powyżej 10 000 zł</option></select></label>
        <label class="form-wide">Co dziś nie działa albo jaki efekt chcesz osiągnąć?<textarea required name="message" rows="5" placeholder="Np. mam starą stronę, klienci nie dzwonią, chcę sprzedawać kilka produktów…"></textarea></label>
        <label class="form-consent form-wide"><input required type="checkbox" name="consent" value="yes"> <span>Zapoznałem/-am się z <a href="<?php echo esc_url(home_url('/polityka-prywatnosci')); ?>">polityką prywatności</a> i proszę o kontakt.</span></label>
        <button class="button form-wide" type="submit"><?php echo $audit ? 'Poproś o miniocenę' : 'Wyślij brief'; ?> <span>↗</span></button>
        <?php if ($brief_status === 'error') : ?><p class="form-error form-wide" role="alert">Nie udało się wysłać wiadomości. Napisz bezpośrednio na kontakt@zielona-marka.pl.</p><?php endif; ?>
    </form>
    <?php
}


function zm_create_required_pages(): void {
    $root_pages = [
        'oferta' => 'Oferta',
        'modernizacja-strony' => 'Modernizacja strony',
        'realizacje' => 'Realizacje',
        'maly-crm-dla-firm' => 'Mały CRM dla firm',
        'usprawnienia-firmy' => 'Usprawnienia firmy',
        'jak-pracuje' => 'Jak pracuję',
        'raport-qa' => 'Przykładowy raport kontroli jakości',
        'kontakt' => 'Kontakt',
        'polityka-prywatnosci' => 'Polityka prywatności',
        'strony-dla-warsztatow' => 'Strony dla warsztatów',
        'strony-dla-firm-uslugowych' => 'Strony dla firm usługowych',
        'strony-dla-beauty' => 'Strony dla beauty',
        'asystent-zapytan' => 'Asystent zapytań',
        'strony-internetowe-marki' => 'Strony internetowe Marki',
        'strony-internetowe' => 'Strony internetowe',
        'en' => 'English',
        'status' => 'Status projektu',
        'studio' => 'Studio',
        'umowa-przykladowa' => 'Przykładowy draft umowy',
        'demo' => 'Demo',
    ];

    $ids = [];
    foreach ($root_pages as $slug => $title) {
        $page = get_page_by_path($slug);
        if ($page) {
            $ids[$slug] = (int) $page->ID;
            continue;
        }
        $ids[$slug] = (int) wp_insert_post([
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_title' => $title,
            'post_name' => $slug,
            'post_content' => '',
        ]);
    }

    $children = [
        'demo' => [
            'natura-strona' => 'Natura Studio — demo strony',
            'bistro-strona' => 'Bistro Forma — demo strony',
            'dom-strona' => 'Dom Dobry — demo strony',
            'natura' => 'Natura Studio — zaplecze',
            'bistro' => 'Bistro Forma — zaplecze',
            'dom' => 'Dom Dobry — zaplecze',
            'transport' => 'Transport — interaktywne demo',
        ],
        'realizacje' => [
            'natura-studio' => 'Natura Studio',
            'bistro-forma' => 'Bistro Forma',
            'dom-dobry' => 'Dom Dobry',
            'transportflow' => 'TransportFlow',
            'detailflow' => 'DetailFlow',
        ],
        'strony-internetowe' => [
            'targowek' => 'Strony internetowe dla firm z Targówka',
            'warszawa' => 'Strony internetowe dla firm z Warszawy',
            'zabki' => 'Strony internetowe dla firm z Ząbek',
            'zielonka' => 'Strony internetowe dla firm z Zielonki',
            'kobylka' => 'Strony internetowe dla firm z Kobyłki',
            'wolomin' => 'Strony internetowe dla firm z Wołomina',
            'radzymin' => 'Strony internetowe dla firm z Radzymina',
            'bialoleka' => 'Strony internetowe dla firm z Białołęki',
        ],
    ];

    foreach ($children as $parent_slug => $pages) {
        $parent_id = $ids[$parent_slug] ?? 0;
        if (!$parent_id) {
            continue;
        }
        foreach ($pages as $slug => $title) {
            if (get_page_by_path($parent_slug . '/' . $slug)) {
                continue;
            }
            wp_insert_post([
                'post_type' => 'page',
                'post_status' => 'publish',
                'post_title' => $title,
                'post_name' => $slug,
                'post_parent' => $parent_id,
                'post_content' => '',
            ]);
        }
    }

    update_option('show_on_front', 'posts');
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'zm_create_required_pages');

function zm_maybe_create_required_pages(): void {
    $pages_version = (string) get_option('zm_required_pages_version', '');
    if ($pages_version === ZM_VERSION) {
        return;
    }
    zm_create_required_pages();
    update_option('zm_required_pages_version', ZM_VERSION, false);
}
add_action('admin_init', 'zm_maybe_create_required_pages');



function zm_local_landing_template(string $template): string {
    if (!is_page()) {
        return $template;
    }

    $page = get_queried_object();
    if (!($page instanceof WP_Post) || !$page->post_parent) {
        return $template;
    }

    $parent = get_post($page->post_parent);
    if (!($parent instanceof WP_Post) || $parent->post_name !== 'strony-internetowe') {
        return $template;
    }

    $local_template = get_template_directory() . '/page-lokalna.php';
    return file_exists($local_template) ? $local_template : $template;
}
add_filter('template_include', 'zm_local_landing_template', 20);

function zm_excerpt_length(): int { return 22; }
add_filter('excerpt_length', 'zm_excerpt_length');


function zm_front_admin_bar(bool $show): bool {
    return is_front_page() ? false : $show;
}
add_filter('show_admin_bar', 'zm_front_admin_bar');


/**
 * Temporary compatibility routes for public demonstration apps.
 * Keeps current portfolio URLs working while the demos remain deployed on GitHub Pages.
 */
function zm_demo_redirects(): void {
    $path = trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

    if ($path === 'chatbot-dla-firm') {
        wp_safe_redirect(home_url('/asystent-zapytan'), 301);
        exit;
    }
    $targets = [
        'demo/auto-naprawa' => 'https://lukaszst-cz.github.io/auto-naprawa-ksef-demo/',
        'demo/auto-naprawa/portal' => 'https://lukaszst-cz.github.io/auto-naprawa-ksef-demo/portal/',
        'demo/routeflow' => 'https://lukaszst-cz.github.io/transportflow-360/',
        'demo/routeflow/portal' => 'https://lukaszst-cz.github.io/transportflow-360/portal/',
    ];
    if (!isset($targets[$path])) {
        return;
    }
    $target = $targets[$path];
    if (!empty($_GET)) {
        $target = add_query_arg(wp_unslash($_GET), $target);
    }
    wp_redirect($target, 302);
    exit;
}
add_action('template_redirect', 'zm_demo_redirects', 1);
