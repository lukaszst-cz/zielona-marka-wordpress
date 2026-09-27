<?php
if (!defined('ABSPATH')) { exit; }
$code = strtoupper((string) get_query_var('zm_status_code'));
$p = zm_get_client_project_by_code($code);
if (!$p) { status_header(404); exit; }
$checks = [
    ['Strona na telefonie i komputerze', zm_project_value($p, 'qa_mobile', 'Do wykonania')],
    ['Formularze, e-mail i komunikaty błędów', zm_project_value($p, 'qa_forms', 'Do wykonania')],
    ['Linki, meta dane i indeksowanie', zm_project_value($p, 'qa_links', 'Do wykonania')],
    ['Szybkość oraz podstawowa dostępność', zm_project_value($p, 'qa_speed', 'Do wykonania')],
];
$complete = 0;
foreach ($checks as $check) { if ($check[1] === 'Gotowe') { $complete++; } }
$updated = get_post_modified_time('d.m.Y', false, $p, true);
?>
<!doctype html><html <?php language_attributes(); ?>><head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width,initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<main class="qa-report-page">
<div class="qa-report-actions"><button type="button" onclick="window.print()">Drukuj / zapisz jako PDF</button><a href="<?php echo esc_url(home_url('/status/' . rawurlencode($code))); ?>">Wróć do statusu</a></div>
<article>
<header><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/logo-zielona-marka-transparent-v1.png'); ?>" alt="Zielona Marka"><div><small>RAPORT ODBIOROWY</small><h1>Kontrola jakości (QA)</h1><p><?php echo esc_html(get_the_title($p)); ?></p></div><b><?php echo esc_html($complete . '/' . count($checks)); ?></b></header>
<section class="qa-report-summary"><div><small>KOD PROJEKTU</small><strong><?php echo esc_html($code); ?></strong></div><div><small>OSTATNIA AKTUALIZACJA</small><strong><?php echo esc_html($updated); ?></strong></div><div><small>STATUS RAPORTU</small><strong><?php echo $complete === count($checks) ? 'GOTOWY' : 'W TRAKCIE'; ?></strong></div></section>
<section class="qa-report-list"><?php foreach($checks as $i=>$check): $done=$check[1]==='Gotowe'; ?><div class="<?php echo $done?'done':'pending'; ?>"><b><?php echo esc_html(sprintf('%02d',$i+1)); ?></b><span><?php echo esc_html($check[0]); ?></span><i><?php echo $done?'SPRAWDZONE ✓':esc_html(strtoupper($check[1])); ?></i></div><?php endforeach; ?></section>
<p class="qa-report-note">Raport pokazuje aktualny stan checklisty projektu. Pozycja oznaczona jako „sprawdzone” została zakończona w Studio Zielonej Marki. Pozostałe punkty wymagają jeszcze wykonania lub potwierdzenia.</p>
<footer><span>ZIELONA MARKA</span><span>zielona-marka.pl</span><span>kontakt@zielona-marka.pl</span></footer>
</article></main>
<?php wp_footer(); ?></body></html>
