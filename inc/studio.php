<?php
if (!defined('ABSPATH')) { exit; }

function zm_register_studio_types(): void {
    $types = [
        'zm_inquiry' => ['Zapytania', 'Zapytanie', 'dashicons-email-alt2'],
        'zm_lead' => ['Sprzedaż', 'Kontakt sprzedażowy', 'dashicons-chart-line'],
        'zm_task' => ['Zadania', 'Zadanie', 'dashicons-yes-alt'],
    ];
    foreach ($types as $type => [$plural, $single, $icon]) {
        register_post_type($type, [
            'labels' => [
                'name' => $plural,
                'singular_name' => $single,
                'add_new_item' => 'Dodaj: ' . $single,
                'edit_item' => 'Edytuj: ' . $single,
            ],
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'zm-studio',
            'menu_icon' => $icon,
            'supports' => ['title'],
            'show_in_rest' => false,
        ]);
    }
}
add_action('init', 'zm_register_studio_types');

function zm_studio_menu(): void {
    add_menu_page(
        'Studio Zielonej Marki',
        'Zielona Marka',
        'manage_options',
        'zm-studio',
        'zm_render_studio_dashboard',
        'dashicons-layout',
        3
    );
    add_submenu_page('zm-studio', 'Pulpit Studio', 'Pulpit', 'manage_options', 'zm-studio', 'zm_render_studio_dashboard');
}
add_action('admin_menu', 'zm_studio_menu');

function zm_studio_meta_boxes(): void {
    add_meta_box('zm_inquiry_meta', 'Dane zapytania', 'zm_inquiry_meta_box', 'zm_inquiry', 'normal', 'high');
    add_meta_box('zm_lead_meta', 'Sprzedaż', 'zm_lead_meta_box', 'zm_lead', 'normal', 'high');
    add_meta_box('zm_task_meta', 'Zadanie', 'zm_task_meta_box', 'zm_task', 'normal', 'high');
}
add_action('add_meta_boxes', 'zm_studio_meta_boxes');

function zm_admin_field(string $name, string $label, string $value = '', string $type = 'text', bool $wide = false): void {
    echo '<label style="display:grid;gap:5px;margin:0 0 14px;' . ($wide ? 'grid-column:1/-1;' : '') . '"><strong>' . esc_html($label) . '</strong>';
    if ($type === 'textarea') {
        echo '<textarea name="' . esc_attr($name) . '" rows="4">' . esc_textarea($value) . '</textarea>';
    } elseif ($type === 'select-status-inquiry') {
        echo '<select name="' . esc_attr($name) . '">';
        foreach (['Nowe','W kontakcie','Zamknięte'] as $option) {
            echo '<option value="' . esc_attr($option) . '"' . selected($value, $option, false) . '>' . esc_html($option) . '</option>';
        }
        echo '</select>';
    } elseif ($type === 'select-stage-lead') {
        echo '<select name="' . esc_attr($name) . '">';
        foreach (['Nowy kontakt','Brief','Oferta','Decyzja','Realizacja','Zakończony','Utracony'] as $option) {
            echo '<option value="' . esc_attr($option) . '"' . selected($value, $option, false) . '>' . esc_html($option) . '</option>';
        }
        echo '</select>';
    } elseif ($type === 'select-task-status') {
        echo '<select name="' . esc_attr($name) . '">';
        foreach (['Do zrobienia','W toku','Gotowe'] as $option) {
            echo '<option value="' . esc_attr($option) . '"' . selected($value, $option, false) . '>' . esc_html($option) . '</option>';
        }
        echo '</select>';
    } elseif ($type === 'select-priority') {
        echo '<select name="' . esc_attr($name) . '">';
        foreach (['Normalny','Wysoki','Pilne'] as $option) {
            echo '<option value="' . esc_attr($option) . '"' . selected($value, $option, false) . '>' . esc_html($option) . '</option>';
        }
        echo '</select>';
    } else {
        echo '<input type="' . esc_attr($type) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '">';
    }
    echo '</label>';
}

function zm_inquiry_meta_box(WP_Post $post): void {
    wp_nonce_field('zm_save_studio_meta', 'zm_studio_nonce');
    echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">';
    zm_admin_field('zm_name', 'Imię', (string) get_post_meta($post->ID, 'zm_name', true));
    zm_admin_field('zm_email', 'E-mail', (string) get_post_meta($post->ID, 'zm_email', true), 'email');
    zm_admin_field('zm_company', 'Firma', (string) get_post_meta($post->ID, 'zm_company', true));
    zm_admin_field('zm_budget', 'Budżet', (string) get_post_meta($post->ID, 'zm_budget', true));
    zm_admin_field('zm_status', 'Status', (string) get_post_meta($post->ID, 'zm_status', true) ?: 'Nowe', 'select-status-inquiry');
    zm_admin_field('zm_project_type', 'Potrzeba', (string) get_post_meta($post->ID, 'zm_project_type', true));
    zm_admin_field('zm_message', 'Wiadomość', (string) get_post_meta($post->ID, 'zm_message', true), 'textarea', true);
    echo '</div>';
}

function zm_lead_meta_box(WP_Post $post): void {
    wp_nonce_field('zm_save_studio_meta', 'zm_studio_nonce');
    echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">';
    zm_admin_field('zm_name', 'Imię', (string) get_post_meta($post->ID, 'zm_name', true));
    zm_admin_field('zm_company', 'Firma', (string) get_post_meta($post->ID, 'zm_company', true));
    zm_admin_field('zm_email', 'E-mail', (string) get_post_meta($post->ID, 'zm_email', true), 'email');
    zm_admin_field('zm_value', 'Wartość (zł)', (string) get_post_meta($post->ID, 'zm_value', true), 'number');
    zm_admin_field('zm_stage', 'Etap', (string) get_post_meta($post->ID, 'zm_stage', true) ?: 'Nowy kontakt', 'select-stage-lead');
    zm_admin_field('zm_next_action', 'Następny krok', (string) get_post_meta($post->ID, 'zm_next_action', true) ?: 'Skontaktować się');
    zm_admin_field('zm_due_date', 'Termin', (string) get_post_meta($post->ID, 'zm_due_date', true), 'date');
    zm_admin_field('zm_source', 'Źródło', (string) get_post_meta($post->ID, 'zm_source', true) ?: 'Ręcznie');
    echo '</div>';
}

function zm_task_meta_box(WP_Post $post): void {
    wp_nonce_field('zm_save_studio_meta', 'zm_studio_nonce');
    echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">';
    zm_admin_field('zm_status', 'Status', (string) get_post_meta($post->ID, 'zm_status', true) ?: 'Do zrobienia', 'select-task-status');
    zm_admin_field('zm_priority', 'Priorytet', (string) get_post_meta($post->ID, 'zm_priority', true) ?: 'Normalny', 'select-priority');
    zm_admin_field('zm_due_date', 'Termin', (string) get_post_meta($post->ID, 'zm_due_date', true), 'date');

    $project_id = (int) get_post_meta($post->ID, 'zm_project_id', true);
    $projects = get_posts(['post_type' => 'zm_client_project', 'post_status' => ['publish','private','draft'], 'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC']);
    echo '<label style="display:grid;gap:5px;margin:0 0 14px"><strong>Projekt</strong><select name="zm_project_id"><option value="0">Bez projektu</option>';
    foreach ($projects as $project) {
        echo '<option value="' . esc_attr((string) $project->ID) . '"' . selected($project_id, $project->ID, false) . '>' . esc_html($project->post_title) . '</option>';
    }
    echo '</select></label>';
    echo '</div>';
}

function zm_save_studio_meta(int $post_id): void {
    $type = get_post_type($post_id);
    if (!in_array($type, ['zm_inquiry','zm_lead','zm_task'], true)) { return; }
    if (!isset($_POST['zm_studio_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['zm_studio_nonce'])), 'zm_save_studio_meta')) { return; }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }
    if (!current_user_can('edit_post', $post_id)) { return; }

    $keys = [
        'zm_inquiry' => ['name','email','company','budget','status','project_type','message'],
        'zm_lead' => ['name','company','email','value','stage','next_action','due_date','source'],
        'zm_task' => ['status','priority','due_date','project_id'],
    ];
    foreach ($keys[$type] as $key) {
        $raw = wp_unslash($_POST['zm_' . $key] ?? '');
        $value = $key === 'message' ? sanitize_textarea_field($raw) : sanitize_text_field($raw);
        if ($key === 'email') { $value = sanitize_email($raw); }
        if (in_array($key, ['value','project_id'], true)) { $value = (string) max(0, (int) $raw); }
        update_post_meta($post_id, 'zm_' . $key, $value);
    }
}
add_action('save_post', 'zm_save_studio_meta');

function zm_count_posts_by_meta(string $type, array $meta_query = []): int {
    $q = new WP_Query([
        'post_type' => $type,
        'post_status' => ['publish','private','draft'],
        'posts_per_page' => 1,
        'fields' => 'ids',
        'no_found_rows' => false,
        'meta_query' => $meta_query,
    ]);
    return (int) $q->found_posts;
}

function zm_studio_pipeline_value(): int {
    $leads = get_posts(['post_type' => 'zm_lead', 'post_status' => ['publish','private','draft'], 'numberposts' => -1]);
    $sum = 0;
    foreach ($leads as $lead) {
        $stage = (string) get_post_meta($lead->ID, 'zm_stage', true);
        if (in_array($stage, ['Zakończony','Utracony'], true)) { continue; }
        $sum += (int) get_post_meta($lead->ID, 'zm_value', true);
    }
    return $sum;
}

function zm_render_studio_dashboard(): void {
    if (!current_user_can('manage_options')) { return; }

    $new_inquiries = zm_count_posts_by_meta('zm_inquiry', [['key'=>'zm_status','value'=>'Nowe']]);
    $urgent = zm_count_posts_by_meta('zm_task', [
        'relation' => 'AND',
        ['key'=>'zm_priority','value'=>'Pilne'],
        ['key'=>'zm_status','value'=>'Gotowe','compare'=>'!='],
    ]);

    $projects = get_posts(['post_type' => 'zm_client_project', 'post_status' => ['publish','private','draft'], 'numberposts' => -1]);
    $active_projects = 0;
    foreach ($projects as $project) {
        if (!in_array((string) get_post_meta($project->ID, 'zm_status', true), ['Opublikowany','Opieka'], true)) { $active_projects++; }
    }

    $recent_inquiries = get_posts(['post_type'=>'zm_inquiry','post_status'=>['publish','private','draft'],'numberposts'=>5,'orderby'=>'date','order'=>'DESC']);
    $open_tasks = get_posts(['post_type'=>'zm_task','post_status'=>['publish','private','draft'],'numberposts'=>6,'orderby'=>'date','order'=>'DESC']);
    ?>
    <div class="wrap zm-studio-admin">
      <style>
        .zm-studio-admin{max-width:1250px}
        .zm-studio-head{display:flex;justify-content:space-between;gap:24px;align-items:end;margin:22px 0}
        .zm-studio-head h1{font-size:34px;margin:0}.zm-studio-head p{max-width:650px;color:#58645e}
        .zm-studio-kpis{display:grid;grid-template-columns:repeat(4,1fr);gap:12px}
        .zm-studio-kpis a{background:#fff;border:1px solid #d6dbd7;padding:20px;text-decoration:none;color:#173126}
        .zm-studio-kpis span{display:block;font-size:11px;text-transform:uppercase;color:#69766f}
        .zm-studio-kpis b{display:block;font-size:30px;margin:10px 0}
        .zm-studio-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:14px}
        .zm-studio-card{background:#fff;border:1px solid #d6dbd7;padding:22px}
        .zm-studio-card h2{margin:0 0 16px}.zm-studio-row{display:flex;justify-content:space-between;gap:18px;padding:12px 0;border-top:1px solid #e4e8e5}
        .zm-studio-row small{display:block;color:#69766f;margin-top:4px}
        .zm-studio-actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:16px}
        @media(max-width:900px){.zm-studio-kpis{grid-template-columns:1fr 1fr}.zm-studio-grid{grid-template-columns:1fr}}
      </style>
      <div class="zm-studio-head"><div><h1>Studio Zielonej Marki</h1><p>Zapytania ze strony, sprzedaż, projekty klientów i zadania w jednym panelu WordPress. Publiczne dane klienta pozostają dostępne wyłącznie przez indywidualny kod projektu.</p></div><a class="button button-primary" href="<?php echo esc_url(home_url('/')); ?>" target="_blank">Podgląd strony ↗</a></div>

      <div class="zm-studio-kpis">
        <a href="<?php echo esc_url(admin_url('edit.php?post_type=zm_lead')); ?>"><span>Pipeline sprzedaży</span><b><?php echo esc_html(number_format_i18n(zm_studio_pipeline_value())); ?> zł</b><small>Aktywne kontakty</small></a>
        <a href="<?php echo esc_url(admin_url('edit.php?post_type=zm_client_project')); ?>"><span>Aktywne projekty</span><b><?php echo esc_html((string) $active_projects); ?></b><small>Strefa klienta</small></a>
        <a href="<?php echo esc_url(admin_url('edit.php?post_type=zm_inquiry')); ?>"><span>Nowe zapytania</span><b><?php echo esc_html((string) $new_inquiries); ?></b><small>Skrzynka ze strony</small></a>
        <a href="<?php echo esc_url(admin_url('edit.php?post_type=zm_task')); ?>"><span>Pilne zadania</span><b><?php echo esc_html((string) $urgent); ?></b><small>Do działania</small></a>
      </div>

      <div class="zm-studio-grid">
        <section class="zm-studio-card"><h2>Ostatnie zapytania</h2>
          <?php if (!$recent_inquiries): ?><p>Nowe formularze ze strony pojawią się tutaj.</p><?php endif; ?>
          <?php foreach($recent_inquiries as $item): ?><div class="zm-studio-row"><div><strong><?php echo esc_html(get_post_meta($item->ID,'zm_name',true) ?: $item->post_title); ?></strong><small><?php echo esc_html((string) get_post_meta($item->ID,'zm_company',true)); ?> · <?php echo esc_html((string) get_post_meta($item->ID,'zm_email',true)); ?></small></div><span><?php echo esc_html((string) get_post_meta($item->ID,'zm_status',true)); ?></span></div><?php endforeach; ?>
          <div class="zm-studio-actions"><a class="button" href="<?php echo esc_url(admin_url('edit.php?post_type=zm_inquiry')); ?>">Wszystkie zapytania</a><a class="button" href="<?php echo esc_url(admin_url('post-new.php?post_type=zm_lead')); ?>">Dodaj kontakt sprzedażowy</a></div>
        </section>
        <section class="zm-studio-card"><h2>Zadania</h2>
          <?php if (!$open_tasks): ?><p>Dodaj zadania do realizacji.</p><?php endif; ?>
          <?php foreach($open_tasks as $task): if ((string) get_post_meta($task->ID,'zm_status',true)==='Gotowe') continue; ?><div class="zm-studio-row"><div><strong><?php echo esc_html($task->post_title); ?></strong><small><?php echo esc_html((string) get_post_meta($task->ID,'zm_due_date',true) ?: 'bez terminu'); ?></small></div><span><?php echo esc_html((string) get_post_meta($task->ID,'zm_priority',true) ?: 'Normalny'); ?></span></div><?php endforeach; ?>
          <div class="zm-studio-actions"><a class="button" href="<?php echo esc_url(admin_url('edit.php?post_type=zm_task')); ?>">Wszystkie zadania</a><a class="button" href="<?php echo esc_url(admin_url('post-new.php?post_type=zm_task')); ?>">Dodaj zadanie</a></div>
        </section>
      </div>
    </div>
    <?php
}

function zm_store_inquiry(array $data): int {
    $title = trim(($data['name'] ?? '') . (($data['company'] ?? '') ? ' · ' . $data['company'] : ''));
    $id = wp_insert_post([
        'post_type' => 'zm_inquiry',
        'post_status' => 'private',
        'post_title' => $title ?: 'Zapytanie ze strony',
    ]);
    if (is_wp_error($id) || !$id) { return 0; }

    $map = ['name','email','company','budget','project_type','message'];
    foreach ($map as $key) {
        update_post_meta($id, 'zm_' . $key, sanitize_textarea_field((string) ($data[$key] ?? '')));
    }
    update_post_meta($id, 'zm_status', 'Nowe');
    update_post_meta($id, 'zm_goal', sanitize_text_field((string) ($data['goal'] ?? '')));
    update_post_meta($id, 'zm_commerce', sanitize_text_field((string) ($data['commerce'] ?? '')));
    update_post_meta($id, 'zm_website', esc_url_raw((string) ($data['website'] ?? '')));
    return (int) $id;
}
