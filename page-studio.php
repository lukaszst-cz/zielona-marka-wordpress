<?php
if (!defined('ABSPATH')) { exit; }

if (!is_user_logged_in()) {
    auth_redirect();
    exit;
}
if (!current_user_can('manage_options')) {
    wp_die('Brak dostępu do prywatnego Studio Zielonej Marki.', 'Brak dostępu', ['response' => 403]);
}

wp_safe_redirect(admin_url('admin.php?page=zm-studio'));
exit;
