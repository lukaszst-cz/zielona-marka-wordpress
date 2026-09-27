<?php
if (!defined('ABSPATH')) { exit; }
add_filter('wp_robots', static function(array $robots): array {
    $robots['noindex'] = true;
    $robots['nofollow'] = true;
    return $robots;
});
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width,initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<main class="transport-demo" data-transport-demo>
<header><a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><span class="brand-signature"><img class="brand-apple" src="<?php echo esc_url(get_template_directory_uri().'/assets/images/logo-zielona-marka-transparent-v1.png'); ?>" alt=""><span class="brand-wordmark"><b>ZIELONA</b><b>MARKA</b><small>STRONY WWW I SYSTEMY DLA FIRM</small></span></span></a><span class="demo-badge">INTERAKTYWNE DEMO · DANE PRZYKŁADOWE</span><div class="demo-return-links"><a href="<?php echo esc_url(home_url('/realizacje')); ?>">Portfolio</a><a href="<?php echo esc_url(home_url('/')); ?>">Strona główna</a><a href="<?php echo esc_url(home_url('/kontakt')); ?>">Zapytaj o wdrożenie ↗</a></div></header>
<div class="transport-shell">
<section class="transport-title"><div><span class="section-no">ZIELONY TRANSPORT / CENTRUM OPERACYJNE</span><h1>Dzień dobry, zespole.</h1><p>Jeden widok zleceń, terminów, dokumentów i automatyzacji.</p></div><button type="button" data-transport-add>+ Zasymuluj nowe zlecenie</button></section>

<section class="transport-kpis"><article><span>Aktywne zlecenia</span><b data-transport-kpi="active">3</b><small>aktualizowane automatycznie</small></article><article><span>Wartość zleceń</span><b data-transport-kpi="revenue">15 450 zł</b><small>bieżący zestaw demonstracyjny</small></article><article><span>Terminowość</span><b data-transport-kpi="ontime">75%</b><small>cel: minimum 95%</small></article><article><span>Dokumenty dostawy</span><b data-transport-kpi="documents">1/4</b><small>gotowe do rozliczenia</small></article></section>

<section class="transport-grid"><div class="transport-card"><div class="transport-head"><div><span class="section-no">ZLECENIA</span><h2>Praca w toku</h2></div><small>Kliknij „następny etap”</small></div><div data-transport-orders>
<?php
$orders=[
['ZT-1048','Nord-Bud','Poznań → Berlin',4800,4,1],
['ZT-1049','Forma Meble','Wrocław → Praga',3600,3,1],
['ZT-1050','Dobry Dom','Łódź → Gdańsk',2850,2,1],
['ZT-1051','Natura Lab','Katowice → Brno',4200,1,0],
];
$stages=['Nowe','Wycena','Przypisane','W trasie','Dostarczone','Faktura'];
foreach($orders as $o): ?>
<article class="order-row" data-transport-order data-id="<?php echo esc_attr($o[0]); ?>" data-value="<?php echo esc_attr((string)$o[3]); ?>" data-stage="<?php echo esc_attr((string)$o[4]); ?>" data-ontime="<?php echo $o[5]?'1':'0'; ?>"><div><b><?php echo esc_html($o[0]); ?></b><small><?php echo esc_html($o[1]); ?></small></div><div><strong><?php echo esc_html($o[2]); ?></strong><small><?php echo esc_html(number_format_i18n($o[3])); ?> zł</small></div><span class="order-status s<?php echo esc_attr((string)$o[4]); ?>" data-transport-stage><?php echo esc_html($stages[$o[4]]); ?></span><div class="order-progress"><i data-transport-bar style="width:<?php echo esc_attr((string)(($o[4]+1)/6*100)); ?>%"></i></div><button type="button" data-transport-advance <?php disabled($o[4]===5); ?>><?php echo $o[4]===5?'Zakończone':'Następny etap →'; ?></button></article>
<?php endforeach; ?>
</div></div>

<aside class="transport-card"><div class="transport-head"><div><span class="section-no">AUTOMATYZACJE</span><h2>Co zrobił system</h2></div></div><div class="automation-log" data-transport-log><p><i></i> 08:42 · Dokument dostawy ZT-1048 zapisany</p><p><i></i> 08:35 · Klient otrzymał wiadomość o dostawie</p><p><i></i> 08:10 · Kierowca potwierdził rozpoczęcie trasy</p></div><div class="automation-note"><b>Przykładowy efekt</b><span>Jedna zmiana statusu może uruchomić wiadomość do klienta, zadanie dla pracownika i aktualizację KPI. Wartości w demo są ilustracyjne.</span></div></aside></section>

<section class="client-preview"><div><span class="section-no">WIDOK KLIENTA</span><h2>Klient też wie, co się dzieje.</h2><p>Po wpisaniu indywidualnego kodu widzi etap, termin, następny krok oraz umowę bez dostępu do danych innych klientów.</p></div><div class="phone-preview"><small>ZLECENIE ZT-1049</small><b>Transport jest w trasie</b><div><i style="width:68%"></i></div><span>Następny krok: potwierdzenie dostawy</span><button type="button">Umowa i dokumenty ↓</button></div></section>
</div>
</main>
<?php wp_footer(); ?></body></html>
