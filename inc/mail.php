<?php
if (!defined('ABSPATH')) { exit; }

function zm_mail_setting(string $constant, string $env, string $default = ''): string {
    if (defined($constant)) {
        return (string) constant($constant);
    }

    $value = getenv($env);
    return $value !== false && $value !== '' ? (string) $value : $default;
}

function zm_mail_config(): array {
    $username = zm_mail_setting('ZM_SMTP_USER', 'ZM_SMTP_USER');
    $password = zm_mail_setting('ZM_SMTP_PASS', 'ZM_SMTP_PASS');

    return [
        'host' => zm_mail_setting('ZM_SMTP_HOST', 'ZM_SMTP_HOST', 'mail.cba.pl'),
        'port' => (int) zm_mail_setting('ZM_SMTP_PORT', 'ZM_SMTP_PORT', '587'),
        'secure' => strtolower(zm_mail_setting('ZM_SMTP_SECURE', 'ZM_SMTP_SECURE', 'tls')),
        'username' => $username,
        'password' => $password,
        'from' => zm_mail_setting('ZM_MAIL_FROM', 'ZM_MAIL_FROM', $username),
        'from_name' => zm_mail_setting('ZM_MAIL_FROM_NAME', 'ZM_MAIL_FROM_NAME', 'Zielona Marka'),
        'configured' => $username !== '' && $password !== '',
    ];
}

function zm_mail_is_configured(): bool {
    $config = zm_mail_config();
    return (bool) $config['configured'];
}

function zm_configure_phpmailer($phpmailer): void {
    $config = zm_mail_config();
    if (!$config['configured']) {
        return;
    }

    $phpmailer->isSMTP();
    $phpmailer->Host = $config['host'];
    $phpmailer->Port = $config['port'];
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = $config['username'];
    $phpmailer->Password = $config['password'];

    if ($config['secure'] === 'ssl' || $config['secure'] === 'smtps') {
        $phpmailer->SMTPSecure = PHPMailerPHPMailerPHPMailer::ENCRYPTION_SMTPS;
    } else {
        $phpmailer->SMTPSecure = PHPMailerPHPMailerPHPMailer::ENCRYPTION_STARTTLS;
    }

    $phpmailer->SMTPAutoTLS = true;
}
add_action('phpmailer_init', 'zm_configure_phpmailer');

function zm_mail_from(string $email): string {
    $config = zm_mail_config();
    return $config['configured'] && is_email($config['from']) ? $config['from'] : $email;
}
add_filter('wp_mail_from', 'zm_mail_from');

function zm_mail_from_name(string $name): string {
    $config = zm_mail_config();
    return $config['configured'] && $config['from_name'] !== '' ? $config['from_name'] : $name;
}
add_filter('wp_mail_from_name', 'zm_mail_from_name');

function zm_send_mail_test(): void {
    if (!current_user_can('manage_options')) {
        wp_die(__('Brak uprawnień.', 'zielona-marka'), '', ['response' => 403]);
    }

    check_admin_referer('zm_mail_test');

    $user = wp_get_current_user();
    $recipient = is_email($user->user_email) ? $user->user_email : get_option('admin_email');
    $sent = false;

    if (zm_mail_is_configured() && is_email($recipient)) {
        $sent = wp_mail(
            $recipient,
            'Test poczty — Zielona Marka',
            "To jest test wysyłki z WordPressa Zielonej Marki.\n\nJeżeli ta wiadomość dotarła, konfiguracja SMTP działa poprawnie."
        );
    }

    wp_safe_redirect(add_query_arg(
        'mailtest',
        $sent ? 'sent' : 'error',
        admin_url('admin.php?page=zm-studio')
    ));
    exit;
}
add_action('admin_post_zm_mail_test', 'zm_send_mail_test');
