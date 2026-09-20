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
    wp_enqueue_style('zm-main', get_template_directory_uri() . '/assets/css/main.css', [], ZM_VERSION);
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
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));
    $website = esc_url_raw(wp_unslash($_POST['website'] ?? ''));
    $audit = !empty($_POST['audit']);

    if (!$name || !is_email($email) || !$message) {
        wp_safe_redirect(add_query_arg('brief', 'error', wp_get_referer() ?: home_url('/')) . '#kontakt');
        exit;
    }

    $recipient = get_theme_mod('zm_email', get_option('admin_email'));
    $subject = sprintf(__('Nowy brief: %s', 'zielona-marka'), $company ?: $name);
    $body = "Imię: {$name}\nE-mail: {$email}\nFirma: {$company}\nPotrzeba: {$project_type}\nAdres strony: {$website}\nTryb minioceny: " . ($audit ? 'tak' : 'nie') . "\nBudżet: {$budget}\n\nOpis projektu:\n{$message}";
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
    $pages = [
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
    ];

    foreach ($pages as $slug => $title) {
        if (get_page_by_path($slug)) {
            continue;
        }
        wp_insert_post([
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_title' => $title,
            'post_name' => $slug,
            'post_content' => '',
        ]);
    }

    update_option('show_on_front', 'posts');
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'zm_create_required_pages');

function zm_excerpt_length(): int { return 22; }
add_filter('excerpt_length', 'zm_excerpt_length');
