<?php
if (!defined('ABSPATH')) { exit; }

function zm_register_client_project_type(): void {
    register_post_type('zm_client_project', [
        'labels' => [
            'name' => __('Projekty klientów', 'zielona-marka'),
            'singular_name' => __('Projekt klienta', 'zielona-marka'),
            'add_new_item' => __('Dodaj projekt klienta', 'zielona-marka'),
            'edit_item' => __('Edytuj projekt klienta', 'zielona-marka'),
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'zm-studio',
        'menu_icon' => 'dashicons-clipboard',
        'supports' => ['title'],
        'show_in_rest' => false,
    ]);
}
add_action('init', 'zm_register_client_project_type');

function zm_client_project_fields(): array {
    return [
        'public_code' => ['Kod publiczny', 'text'],
        'client_name' => ['Imię i nazwisko klienta', 'text'],
        'client_company' => ['Firma klienta', 'text'],
        'client_email' => ['E-mail klienta', 'email'],
        'client_address' => ['Adres klienta', 'text'],
        'client_nip' => ['NIP klienta', 'text'],
        'progress' => ['Postęp (%)', 'number'],
        'deadline' => ['Planowany termin', 'date'],
        'start_date' => ['Planowane rozpoczęcie', 'date'],
        'price' => ['Wartość netto (zł)', 'number'],
        'contract_status' => ['Status umowy', 'text'],
        'contract_number' => ['Numer umowy', 'text'],
        'next_step' => ['Następny krok', 'text'],
        'scope' => ['Zakres projektu', 'textarea'],
        'client_note' => ['Informacja dla klienta', 'textarea'],
        'provider_name' => ['Wykonawca', 'text'],
        'provider_address' => ['Adres wykonawcy', 'text'],
        'provider_nip' => ['NIP wykonawcy', 'text'],
    ];
}

function zm_client_project_meta_box(): void {
    add_meta_box(
        'zm_client_project_details',
        __('Strefa klienta', 'zielona-marka'),
        'zm_client_project_meta_box_html',
        'zm_client_project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'zm_client_project_meta_box');

function zm_client_project_meta_box_html(WP_Post $post): void {
    wp_nonce_field('zm_save_client_project', 'zm_client_project_nonce');
    $status = (string) get_post_meta($post->ID, 'zm_status', true);
    if ($status === '') { $status = 'Planowanie'; }
    $stages = ['Planowanie','Treści','Projekt graficzny','Wdrożenie','Testy','Opublikowany','Opieka'];
    ?>
    <style>
      .zm-project-admin-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px}
      .zm-project-admin-grid label{display:grid;gap:5px;font-weight:600}
      .zm-project-admin-grid .wide{grid-column:1/-1}
      .zm-project-admin-grid input,.zm-project-admin-grid textarea,.zm-project-admin-grid select{width:100%}
      @media(max-width:782px){.zm-project-admin-grid{grid-template-columns:1fr}.zm-project-admin-grid .wide{grid-column:1}}
    </style>
    <div class="zm-project-admin-grid">
      <label>Status projektu
        <select name="zm_status"><?php foreach ($stages as $stage): ?><option value="<?php echo esc_attr($stage); ?>" <?php selected($status, $stage); ?>><?php echo esc_html($stage); ?></option><?php endforeach; ?></select>
      </label>
      <?php foreach (zm_client_project_fields() as $key => [$label, $type]): 
          $value = (string) get_post_meta($post->ID, 'zm_' . $key, true);
          if ($key === 'provider_name' && $value === '') { $value = 'Zielona Marka - Łukasz Staniewicz'; }
          $wide = $type === 'textarea' ? ' wide' : '';
      ?>
        <label class="<?php echo esc_attr(trim($wide)); ?>"><?php echo esc_html($label); ?>
          <?php if ($type === 'textarea'): ?>
            <textarea name="zm_<?php echo esc_attr($key); ?>" rows="4"><?php echo esc_textarea($value); ?></textarea>
          <?php else: ?>
            <input type="<?php echo esc_attr($type); ?>" name="zm_<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>" <?php echo $key === 'progress' ? 'min="0" max="100"' : ''; ?>>
          <?php endif; ?>
        </label>
      <?php endforeach; ?>
      <div class="wide"><hr><h3>Kontrola jakości (QA)</h3><p>Ustaw stan każdego punktu widocznego w raporcie klienta.</p></div>
      <?php
      $qa = [
          'mobile' => 'Strona na telefonie i komputerze',
          'forms' => 'Formularze, e-mail i komunikaty błędów',
          'links' => 'Linki, meta dane i indeksowanie',
          'speed' => 'Szybkość oraz podstawowa dostępność',
      ];
      foreach ($qa as $key => $label):
          $value = (string) get_post_meta($post->ID, 'zm_qa_' . $key, true);
          if ($value === '') { $value = 'Do wykonania'; }
      ?>
        <label><?php echo esc_html($label); ?>
          <select name="zm_qa_<?php echo esc_attr($key); ?>">
            <?php foreach (['Do wykonania','W trakcie','Gotowe'] as $state): ?><option value="<?php echo esc_attr($state); ?>" <?php selected($value, $state); ?>><?php echo esc_html($state); ?></option><?php endforeach; ?>
          </select>
        </label>
      <?php endforeach; ?>
    </div>
    <?php
}

function zm_generate_project_code(): string {
    $parts = [];
    for ($i = 0; $i < 3; $i++) {
        $parts[] = strtoupper(wp_generate_password(4, false, false));
    }
    return 'ZM-' . implode('-', $parts);
}

function zm_save_client_project(int $post_id): void {
    if (!isset($_POST['zm_client_project_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['zm_client_project_nonce'])), 'zm_save_client_project')) { return; }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }
    if (!current_user_can('edit_post', $post_id)) { return; }

    $status = sanitize_text_field(wp_unslash($_POST['zm_status'] ?? 'Planowanie'));
    update_post_meta($post_id, 'zm_status', $status);

    foreach (zm_client_project_fields() as $key => [, $type]) {
        $raw = wp_unslash($_POST['zm_' . $key] ?? '');
        if ($type === 'email') {
            $value = sanitize_email($raw);
        } elseif ($type === 'textarea') {
            $value = sanitize_textarea_field($raw);
        } elseif ($type === 'number') {
            $value = (string) max(0, (int) $raw);
            if ($key === 'progress') { $value = (string) min(100, (int) $value); }
        } else {
            $value = sanitize_text_field($raw);
        }
        if ($key === 'public_code') {
            $value = strtoupper($value);
            if ($value === '') { $value = zm_generate_project_code(); }
        }
        update_post_meta($post_id, 'zm_' . $key, $value);
    }

    foreach (['mobile','forms','links','speed'] as $key) {
        update_post_meta($post_id, 'zm_qa_' . $key, sanitize_text_field(wp_unslash($_POST['zm_qa_' . $key] ?? 'Do wykonania')));
    }
}
add_action('save_post_zm_client_project', 'zm_save_client_project');

function zm_register_status_routes(): void {
    add_rewrite_rule('^status/([^/]+)/umowa/?$', 'index.php?zm_status_code=$matches[1]&zm_status_view=contract', 'top');
    add_rewrite_rule('^status/([^/]+)/qa/?$', 'index.php?zm_status_code=$matches[1]&zm_status_view=qa', 'top');
    add_rewrite_rule('^status/([^/]+)/?$', 'index.php?zm_status_code=$matches[1]&zm_status_view=project', 'top');
}
add_action('init', 'zm_register_status_routes');

function zm_status_query_vars(array $vars): array {
    $vars[] = 'zm_status_code';
    $vars[] = 'zm_status_view';
    return $vars;
}
add_filter('query_vars', 'zm_status_query_vars');

function zm_get_client_project_by_code(string $code): ?WP_Post {
    $code = strtoupper(sanitize_text_field(rawurldecode($code)));
    if ($code === '') { return null; }

    $query = new WP_Query([
        'post_type' => 'zm_client_project',
        'post_status' => ['publish','private','draft'],
        'posts_per_page' => 1,
        'no_found_rows' => true,
        'meta_key' => 'zm_public_code',
        'meta_value' => $code,
    ]);
    return $query->have_posts() ? $query->posts[0] : null;
}

function zm_project_value(WP_Post $project, string $key, string $default = ''): string {
    $value = (string) get_post_meta($project->ID, 'zm_' . $key, true);
    return $value !== '' ? $value : $default;
}

function zm_status_template(string $template): string {
    $code = (string) get_query_var('zm_status_code');
    if ($code === '') { return $template; }

    $project = zm_get_client_project_by_code($code);
    if (!$project) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        return get_404_template();
    }

    $view = (string) get_query_var('zm_status_view');
    $files = [
        'project' => 'status-client.php',
        'contract' => 'status-contract.php',
        'qa' => 'status-qa.php',
    ];
    $file = get_template_directory() . '/' . ($files[$view] ?? $files['project']);
    return file_exists($file) ? $file : $template;
}
add_filter('template_include', 'zm_status_template', 50);

function zm_status_robots(array $robots): array {
    if ((string) get_query_var('zm_status_code') !== '') {
        $robots['noindex'] = true;
        $robots['nofollow'] = true;
    }
    return $robots;
}
add_filter('wp_robots', 'zm_status_robots');
