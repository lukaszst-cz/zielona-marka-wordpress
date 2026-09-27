<?php
if (!defined('ABSPATH')) { exit; }
$code = strtoupper((string) get_query_var('zm_status_code'));
$p = zm_get_client_project_by_code($code);
if (!$p) { status_header(404); exit; }
$value = static function(string $key, string $fallback = 'DO UZUPEŁNIENIA') use ($p): string {
    $v = zm_project_value($p, $key);
    return $v !== '' ? $v : $fallback;
};
$price = (int) zm_project_value($p, 'price', '0');
$start = zm_project_value($p, 'start_date');
$deadline = zm_project_value($p, 'deadline');
?>
<!doctype html><html <?php language_attributes(); ?>><head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width,initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<main class="contract-page">
<div class="contract-actions"><button type="button" onclick="window.print()">Pobierz / zapisz jako PDF</button><a href="<?php echo esc_url(home_url('/status/' . rawurlencode($code))); ?>">Wróć do statusu</a></div>
<article>
<header><img src="https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/logo-zielona-marka-transparent-v1.png" alt="Zielona Marka"><div><small>WZÓR UMOWY DO WERYFIKACJI</small><h1>Umowa o wykonanie projektu</h1><p>nr <?php echo esc_html($value('contract_number')); ?></p></div></header>
<p class="contract-warning">Przed podpisaniem sprawdź wszystkie dane. Dokument stanowi roboczy wzór i powinien zostać dostosowany do konkretnego zlecenia oraz, w razie potrzeby, zweryfikowany prawnie.</p>
<section><h2>§ 1. Strony umowy</h2><p><b>Wykonawca:</b> <?php echo esc_html($value('provider_name', 'Zielona Marka - Łukasz Staniewicz')); ?>, adres: <?php echo esc_html($value('provider_address')); ?>, NIP: <?php echo esc_html($value('provider_nip')); ?>, e-mail: kontakt@zielona-marka.pl.</p><p><b>Zamawiający:</b> <?php echo esc_html($value('client_company', $value('client_name'))); ?>, reprezentowany przez: <?php echo esc_html($value('client_name')); ?>, adres: <?php echo esc_html($value('client_address')); ?>, NIP: <?php echo esc_html($value('client_nip')); ?>, e-mail: <?php echo esc_html($value('client_email')); ?>.</p></section>
<section><h2>§ 2. Przedmiot i zakres</h2><p>Wykonawca zobowiązuje się wykonać projekt „<?php echo esc_html(get_the_title($p)); ?>”. Zakres: <?php echo nl2br(esc_html($value('scope'))); ?>.</p></section>
<section><h2>§ 3. Termin i współpraca</h2><p>Planowane rozpoczęcie: <?php echo esc_html($start ? wp_date('d.m.Y', strtotime($start)) : 'DO UZUPEŁNIENIA'); ?>. Planowane zakończenie: <?php echo esc_html($deadline ? wp_date('d.m.Y', strtotime($deadline)) : 'DO UZUPEŁNIENIA'); ?>. Terminy mogą ulec zmianie, jeśli Zamawiający nie przekaże na czas materiałów lub akceptacji.</p></section>
<section><h2>§ 4. Wynagrodzenie</h2><p>Łączne wynagrodzenie za uzgodniony zakres wynosi <b><?php echo $price ? esc_html(number_format_i18n($price) . ' zł netto') : 'DO UZUPEŁNIENIA'; ?></b>. 30% zaliczki jest płatne po akceptacji zakresu i umowy. Pozostałe 70% jest płatne po odbiorze gotowej wersji i testach QA, przed publikacją na domenie lub serwerze Klienta. Płatność może nastąpić bezpośrednio albo przez uzgodnionego partnera rozliczeniowego. Koszty zewnętrzne wymagają wcześniejszej akceptacji.</p></section>
<section><h2>§ 5. Odbiór i poprawki</h2><p>Projekt zostanie przekazany do odbioru po zakończeniu uzgodnionego zakresu i testów jakości (QA). Liczba tur poprawek, sposób zgłaszania uwag oraz termin na odbiór: ............................................................</p></section>
<section><h2>§ 6. Prawa i odpowiedzialność</h2><p>Zakres przeniesienia praw lub licencji, zasady wykorzystania materiałów powierzonych przez Zamawiającego, odpowiedzialność za usługi zewnętrzne oraz utrzymanie rozwiązania należy uzgodnić przed podpisaniem: ............................................................</p></section>
<section><h2>§ 7. Postanowienia końcowe</h2><p>Zmiany umowy wymagają uzgodnienia przez obie Strony. W sprawach nieuregulowanych zastosowanie mają właściwe przepisy prawa polskiego. Umowę sporządzono w dwóch jednobrzmiących egzemplarzach.</p></section>
<div class="signatures"><div><span>........................................</span><b>Wykonawca</b><small>data i podpis</small></div><div><span>........................................</span><b>Zamawiający</b><small>data i podpis</small></div></div>
</article></main>
<?php wp_footer(); ?></body></html>
