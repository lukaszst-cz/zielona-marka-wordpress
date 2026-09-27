<?php
if (!defined('ABSPATH')) { exit; }

define('ZM_VERSION', '1.1.0');

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
    if (is_front_page()) {
        wp_enqueue_style(
            'zm-production-home',
            'https://zielona-marka.pl/_next/static/css/index.DSDKteEL.css',
            [],
            null
        );
    } else {
        wp_enqueue_style('zm-main', get_template_directory_uri() . '/assets/css/main.css', [], ZM_VERSION);
    }
    if (is_page('detailflow')) {
        wp_enqueue_style('zm-detailflow', get_template_directory_uri() . '/assets/css/detailflow.css', ['zm-main'], ZM_VERSION);
    }
    wp_enqueue_script('zm-main', get_template_directory_uri() . '/assets/js/main.js', [], ZM_VERSION, true);
}
add_action('wp_enqueue_scripts', 'zm_assets');

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
    $budget = sanitize_text_field(wp_unslash($_POST['budget'] ?? ''));
    $timeline = sanitize_text_field(wp_unslash($_POST['timeline'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));
    $website = esc_url_raw(wp_unslash($_POST['website'] ?? ''));
    $audit = !empty($_POST['audit']);
    $assistant_goal = sanitize_text_field(wp_unslash($_POST['assistantGoal'] ?? ''));
    $assistant_industry = sanitize_text_field(wp_unslash($_POST['assistantIndustry'] ?? ''));
    $phone = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));

    if ($assistant_goal || $assistant_industry) {
        $message = "Asystent demonstracyjny\nCel: {$assistant_goal}\nBranża: {$assistant_industry}\nTelefon: " . ($phone ?: 'nie podano') . "\n\n" . ($message ?: 'Prośba o kontakt.');
        $project_type = 'Asystent dla firmy';
    }

    if (!$name || !is_email($email) || !$message) {
        wp_safe_redirect(add_query_arg('brief', 'error', wp_get_referer() ?: home_url('/')) . '#kontakt');
        exit;
    }

    $recipient = get_theme_mod('zm_email', get_option('admin_email'));
    $subject = sprintf(__('Nowy brief: %s', 'zielona-marka'), $company ?: $name);
    $body = "Imię: {$name}\nE-mail: {$email}\nTelefon: {$phone}\nFirma: {$company}\nPotrzeba: {$project_type}\nAdres strony: {$website}\nPlanowany termin: {$timeline}\nTryb minioceny: " . ($audit ? 'tak' : 'nie') . "\nBudżet: {$budget}\n\nOpis projektu:\n{$message}";
    $sent = wp_mail($recipient, $subject, $body, ['Reply-To: ' . $name . ' <' . $email . '>']);
    wp_safe_redirect(add_query_arg('brief', $sent ? 'sent' : 'error', wp_get_referer() ?: home_url('/')) . '#kontakt');
    exit;
}
add_action('admin_post_nopriv_zm_send_brief', 'zm_handle_brief');
add_action('admin_post_zm_send_brief', 'zm_handle_brief');

function zm_schema(): void {
    if (!is_front_page()) { return; }
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        'name' => 'Zielona Marka',
        'url' => home_url('/'),
        'email' => get_theme_mod('zm_email', 'kontakt@zielona-marka.pl'),
        'areaServed' => 'PL',
        'description' => 'Strony WWW, formularze wyceny, małe CRM-y i usprawnienia dla lokalnych firm usługowych.',
        'serviceType' => ['Strony internetowe', 'Formularze wyceny', 'Mały CRM', 'WordPress', 'Lokalne SEO'],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
add_action('wp_head', 'zm_schema', 30);


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
        <?php if ($audit) : ?><label>Adres obecnej strony <span>(opcjonalnie)</span><input name="website" type="url" placeholder="https://twoja-strona.pl"></label><?php endif; ?>
        <label>Czego potrzebujesz?<select required name="projectType"><option value="" disabled selected>Wybierz najbliższą odpowiedź</option><option>Strona dla warsztatu lub detailingu</option><option>Strona dla firmy remontowej lub instalatora</option><option>Strona dla beauty lub usług na termin</option><option>Nowa strona dla innej firmy usługowej</option><option>Modernizacja obecnej strony</option><option>Formularz wyceny lub zgłoszenia</option><option>Mały CRM do klientów i zleceń</option><option>Asystent dla firmy</option><option>Potrzebuję krótkiej konsultacji</option></select></label>
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
        'kontakt' => 'Kontakt',
        'polityka-prywatnosci' => 'Polityka prywatności',
        'strony-dla-warsztatow' => 'Strony dla warsztatów',
        'strony-dla-firm-uslugowych' => 'Strony dla firm usługowych',
        'strony-dla-beauty' => 'Strony dla beauty',
        'asystent-zapytan' => 'Asystent zapytań',
        'strony-internetowe-marki' => 'Strony internetowe Marki',
        'en' => 'English',
        'status' => 'Status projektu',
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
        ],
        'realizacje' => [
            'natura-studio' => 'Natura Studio',
            'bistro-forma' => 'Bistro Forma',
            'dom-dobry' => 'Dom Dobry',
            'transportflow' => 'TransportFlow',
            'detailflow' => 'DetailFlow',
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

function zm_excerpt_length(): int { return 22; }
add_filter('excerpt_length', 'zm_excerpt_length');


function zm_front_admin_bar(bool $show): bool {
    return is_front_page() ? false : $show;
}
add_filter('show_admin_bar', 'zm_front_admin_bar');


/* Production sync 2026-09-27: shared shell from the approved 2026-09-21 release. */
if (!defined('ZM_PRODUCTION_VERSION')) { define('ZM_PRODUCTION_VERSION', '2026.09.27'); }

function zm_theme_asset(string $path = ''): string {
    return trailingslashit(get_template_directory_uri()) . ltrim($path, '/');
}

function zm_production_assets(): void {
    if (is_front_page()) {
        wp_dequeue_style('zm-production-home');
    }
    wp_enqueue_style('zm-main', zm_theme_asset('assets/css/main.css'), [], ZM_PRODUCTION_VERSION);
    wp_enqueue_style('zm-brand-system', zm_theme_asset('assets/css/brand-system.css'), ['zm-main'], ZM_PRODUCTION_VERSION);
    wp_enqueue_style('zm-fern-public', zm_theme_asset('assets/css/fern-public.css'), ['zm-brand-system'], ZM_PRODUCTION_VERSION);
    if (is_front_page()) {
        wp_enqueue_style('zm-home-v5', zm_theme_asset('assets/css/home-v5.css'), ['zm-fern-public'], ZM_PRODUCTION_VERSION);
    }
    wp_enqueue_script('zm-production', zm_theme_asset('assets/js/production.js'), [], ZM_PRODUCTION_VERSION, true);
    wp_localize_script('zm-production', 'ZMTheme', [
        'assetBase' => zm_theme_asset('assets/'),
        'forestVideo' => 'https://www.zielona-marka.pl/brand-review-v5/fern-moss-stream-20260919.mp4',
    ]);
}
add_action('wp_enqueue_scripts', 'zm_production_assets', 50);

function zm_brand_signature(): void { ?>
    <span class="brand-signature" role="img" aria-label="Zielona Marka">
        <img class="brand-apple" src="<?php echo esc_url(zm_theme_asset('assets/images/logo-fern-automation-white.svg')); ?>" width="96" height="98" alt="">
        <span class="brand-wordmark"><b>ZIELONA</b><b>MARKA</b><small>STRONY WWW I SYSTEMY DLA FIRM</small></span>
    </span>
<?php }

function zm_language_switch(bool $english = false): void { ?>
    <span class="zm-languages" role="group" aria-label="<?php echo esc_attr($english ? 'Language' : 'Język strony'); ?>">
        <a href="<?php echo esc_url(home_url('/')); ?>" lang="pl" hreflang="pl" aria-label="Polski"<?php echo !$english ? ' aria-current="true"' : ''; ?>>PL</a>
        <a href="<?php echo esc_url(home_url('/en')); ?>" lang="en" hreflang="en" aria-label="English"<?php echo $english ? ' aria-current="true"' : ''; ?>>EN</a>
    </span>
<?php }

function zm_site_header(bool $english = false): void {
    $offers = [
        ['Strony WWW','Websites','/oferta'],
        ['Modernizacja strony','Website redesign','/modernizacja-strony'],
        ['CRM i obsługa klientów','CRM and client service','/maly-crm-dla-firm'],
        ['Usprawnienia i automatyzacje','Process automation','/usprawnienia-firmy'],
        ['Firmy usługowe','Service businesses','/strony-dla-firm-uslugowych'],
        ['Beauty','Beauty','/strony-dla-beauty'],
        ['Warsztaty','Car workshops','/strony-dla-warsztatow'],
        ['Asystent zapytań','Enquiry assistant','/asystent-zapytan'],
        ['Chatbot dla firmy','Business chatbot','/chatbot-dla-firm'],
        ['Warszawa · Targówek','Local websites','/strony-internetowe/targowek'],
    ]; ?>
    <header class="zm-header"><nav class="zm-nav" aria-label="<?php echo esc_attr($english ? 'Main navigation' : 'Główna nawigacja'); ?>">
        <a class="zm-brand" href="<?php echo esc_url(home_url($english ? '/en' : '/')); ?>" aria-label="Zielona Marka"><?php zm_brand_signature(); ?></a>
        <div class="zm-nav-desktop">
            <details class="zm-offer-menu"><summary><?php echo esc_html($english ? 'Services' : 'Oferta'); ?> <span aria-hidden="true">⌄</span></summary><div>
                <?php foreach ($offers as [$pl,$en,$href]) : ?><a href="<?php echo esc_url(home_url($english ? '/en#services' : $href)); ?>"><?php echo esc_html($english ? $en : $pl); ?></a><?php endforeach; ?>
            </div></details>
            <a href="<?php echo esc_url(home_url($english ? '/en#projects' : '/realizacje')); ?>"><?php echo esc_html($english ? 'Projects' : 'Projekty'); ?></a>
            <a href="<?php echo esc_url(home_url($english ? '/en#process' : '/jak-pracuje')); ?>"><?php echo esc_html($english ? 'Working together' : 'Współpraca'); ?></a>
            <a href="<?php echo esc_url(home_url($english ? '/en#contact' : '/kontakt')); ?>"><?php echo esc_html($english ? 'Contact' : 'Kontakt'); ?></a>
            <a class="zm-client-link" href="<?php echo esc_url(home_url('/status')); ?>"><?php echo esc_html($english ? 'Client area (PL)' : 'Strefa klienta'); ?></a>
            <?php zm_language_switch($english); ?>
        </div>
        <details class="zm-mobile-menu"><summary>Menu <span aria-hidden="true">+</span></summary><div>
            <?php if ($english) : ?>
                <a href="#services">Services</a><a href="#projects">Projects</a><a href="#process">Working together</a><a href="#contact">Contact</a>
            <?php else : foreach ($offers as [$pl,$en,$href]) : ?><a href="<?php echo esc_url(home_url($href)); ?>"><?php echo esc_html($pl); ?></a><?php endforeach; ?>
                <a href="<?php echo esc_url(home_url('/realizacje')); ?>">Projekty</a><a href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Współpraca</a><a href="<?php echo esc_url(home_url('/kontakt')); ?>">Kontakt</a>
            <?php endif; ?>
            <a href="<?php echo esc_url(home_url('/status')); ?>"><?php echo esc_html($english ? 'Client area (PL)' : 'Strefa klienta'); ?></a>
            <?php zm_language_switch($english); ?>
            <a href="tel:+48450458466">+48 450 458 466</a>
        </div></details>
    </nav></header>
<?php }

function zm_site_footer(bool $english = false): void { ?>
    <footer class="zm-footer"><div class="zm-footer-inner">
        <div class="zm-footer-brand"><a href="<?php echo esc_url(home_url($english ? '/en' : '/')); ?>"><?php zm_brand_signature(); ?></a><p><?php echo $english ? 'Websites and systems for businesses.<br>Warsaw, Targówek and nearby. Remote work across Poland.' : 'Strony WWW i systemy dla firm.<br>Warszawa, Targówek i okolice. Zdalnie w całej Polsce.'; ?></p></div>
        <div><h2><?php echo esc_html($english ? 'Explore' : 'Poznaj ofertę'); ?></h2><a href="<?php echo esc_url(home_url($english ? '/en#services' : '/oferta')); ?>"><?php echo esc_html($english ? 'Services' : 'Oferta'); ?></a><a href="<?php echo esc_url(home_url($english ? '/en#projects' : '/realizacje')); ?>"><?php echo esc_html($english ? 'Projects' : 'Projekty'); ?></a><a href="<?php echo esc_url(home_url($english ? '/en#process' : '/jak-pracuje')); ?>"><?php echo esc_html($english ? 'Working together' : 'Współpraca'); ?></a><a href="<?php echo esc_url(home_url('/status')); ?>"><?php echo esc_html($english ? 'Client area (PL)' : 'Strefa klienta'); ?></a></div>
        <div><h2><?php echo esc_html($english ? 'Contact' : 'Porozmawiajmy'); ?></h2><a href="tel:+48450458466">+48 450 458 466</a><a href="mailto:kontakt@zielona-marka.pl">kontakt@zielona-marka.pl</a><a href="https://www.facebook.com/zielonamarka" target="_blank" rel="noreferrer">Facebook ↗</a><a href="https://www.instagram.com/zielona.marka.pl/" target="_blank" rel="noreferrer">Instagram ↗</a><a href="https://github.com/lukaszst-cz" target="_blank" rel="noreferrer">GitHub ↗</a></div>
        <?php if (!$english) : ?><div class="zm-footer-locations"><h2>Warszawa · Targówek i okolice</h2><div><?php foreach ([['Targówek','targowek'],['Warszawa','warszawa'],['Ząbki','zabki'],['Zielonka','zielonka'],['Kobyłka','kobylka'],['Wołomin','wolomin'],['Radzymin','radzymin'],['Białołęka','bialoleka']] as [$name,$slug]) : ?><a href="<?php echo esc_url(home_url('/strony-internetowe/'.$slug)); ?>"><?php echo esc_html($name); ?></a><?php endforeach; ?><a href="<?php echo esc_url(home_url('/strony-internetowe-marki')); ?>">Marki</a></div></div><?php endif; ?>
        <div class="zm-footer-bottom"><small>© <?php echo esc_html(wp_date('Y')); ?> Zielona Marka</small><a href="<?php echo esc_url(home_url('/polityka-prywatnosci')); ?>"><?php echo esc_html($english ? 'Privacy policy (PL)' : 'Polityka prywatności'); ?></a><button type="button" class="zm-cookie-settings" data-cookie-settings><?php echo esc_html($english ? 'Cookie settings' : 'Ustawienia cookies'); ?></button><a href="<?php echo esc_url(home_url($english ? '/' : '/en')); ?>"><?php echo esc_html($english ? 'Polski' : 'English'); ?></a></div>
    </div></footer>
<?php }

function zm_quick_whatsapp(): void { ?>
    <a class="whatsapp-float" href="https://wa.me/48603806833?text=Dzień%20dobry%2C%20chcę%20porozmawiać%20o%20stronie%20dla%20mojej%20firmy." target="_blank" rel="noreferrer" aria-label="Napisz do Zielonej Marki na WhatsAppie"><span aria-hidden="true">◌</span><b>Napisz na WhatsApp</b><small>Szybka wiadomość</small><i aria-hidden="true">↗</i></a>
<?php }

function zm_cookie_consent(): void { ?>
    <div class="zm-cookie-consent" data-cookie-consent hidden><div><b>Ustawienia prywatności</b><p>Ta strona może używać plików cookies potrzebnych do działania oraz, po Twojej zgodzie, analitycznych.</p><div><button type="button" data-cookie-choice="necessary">Tylko niezbędne</button><button type="button" data-cookie-choice="all">Akceptuję</button></div></div></div>
<?php }

function zm_render_home_contact_form(): void {
    $status = sanitize_key(wp_unslash($_GET['brief'] ?? ''));
    if ($status === 'sent') { echo '<div class="zmh-form-success" role="status"><b>Dziękuję, wiadomość dotarła.</b><p>Zapoznam się z Twoją sprawą i odezwę się w sprawie kolejnego kroku.</p></div>'; return; }
    ?>
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
        <input type="hidden" name="action" value="zm_send_brief"><?php wp_nonce_field('zm_send_brief','zm_brief_nonce'); ?>
        <div class="zmh-field-grid"><label>Imię<input required name="name" autocomplete="name" placeholder="Jak masz na imię?"></label><label>E-mail<input required name="email" type="email" autocomplete="email" placeholder="twoj@email.pl"></label></div>
        <label>Co chcesz ułatwić w swojej firmie?<textarea required name="message" rows="5" placeholder="Np. chcę lepiej pokazać usługi, sprzedawać vouchery albo uporządkować zapytania."></textarea></label>
        <details class="zmh-extra-fields"><summary>Dodaj szczegóły, jeśli chcesz <span aria-hidden="true">+</span></summary><div class="zmh-field-grid"><label>Telefon <span>(opcjonalnie)</span><input name="phone" type="tel" autocomplete="tel"></label><label>Firma <span>(opcjonalnie)</span><input name="company" autocomplete="organization"></label><label>Obecna strona <span>(opcjonalnie)</span><input name="website" type="url" placeholder="https://"></label><label>Obszar <span>(opcjonalnie)</span><select name="projectType"><option value="">Wybierz, jeśli wiesz</option><option>Strona WWW</option><option>Formularze i zapytania</option><option>CRM i obsługa klientów</option><option>Sklep i płatności</option><option>Kilka z tych rzeczy</option><option>Chcę najpierw porozmawiać</option></select></label><label>Planowany termin <span>(opcjonalnie)</span><input name="timeline" placeholder="Np. w ciągu 2 miesięcy"></label><label>Orientacyjny budżet <span>(opcjonalnie)</span><select name="budget"><option value="">Wolę najpierw poznać zakres</option><option>do 3 000 zł</option><option>3 000-6 000 zł</option><option>6 000-12 000 zł</option><option>powyżej 12 000 zł</option></select></label></div></details>
        <label class="zmh-privacy-check"><input required type="checkbox" name="consent" value="yes"><span>Zapoznałem/-am się z <a href="<?php echo esc_url(home_url('/polityka-prywatnosci')); ?>">polityką prywatności</a> i proszę o kontakt.</span></label>
        <button class="zmh-pill" type="submit">Wyślij wiadomość ↗</button>
        <?php if ($status === 'error') : ?><p role="alert" class="zmh-form-error">Wiadomość nie została wysłana. Spróbuj ponownie albo zadzwoń: +48 450 458 466.</p><?php endif; ?>
    </form>
<?php }

function zm_create_production_pages(): void {
    foreach ([
        'chatbot-dla-firm' => 'Chatbot dla firmy',
        'opieka-nad-strona' => 'Opieka nad stroną',
        'przyklady-zaplecza' => 'Przykłady zaplecza',
    ] as $slug=>$title) {
        if (!get_page_by_path($slug)) {
            wp_insert_post(['post_type'=>'page','post_status'=>'publish','post_title'=>$title,'post_name'=>$slug,'post_content'=>'']);
        }
    }
}
add_action('after_switch_theme', 'zm_create_production_pages', 30);
