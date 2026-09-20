<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php /* Production mirror: /demo/dom-strona */ ?>
<main class="dom-site">
<nav class="dom-nav"><a class="dom-brand" href="<?php echo esc_url(home_url('/')); ?>"><i>DD</i><span>DOM<br><b>DOBRY</b></span></a><div><a href="#inwestycja">Inwestycja</a><a href="#lokale">Lokale</a><a href="#standard">Standard</a><a href="<?php echo esc_url(home_url('/#realizacje')); ?>">Portfolio</a></div><a href="#kontakt">Zapytaj o lokal ↗</a></nav>
<header class="dom-hero"><div class="dom-hero-copy"><span>NOWA INWESTYCJA / ZIELONE PRZEDMIEŚCIA</span><h1>Przestrzeń,<br>do której <em>wracasz.</em></h1><p>12 kameralnych domów. Funkcjonalne układy, prywatne ogrody i szybki dojazd do miasta.</p><div><a href="#lokale">Sprawdź dostępność</a><a href="#inwestycja">Poznaj inwestycję ↓</a></div></div><figure><img src="https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/concept-dom.jpg" alt="Nowoczesny dom w zielonym otoczeniu"><figcaption><b>ETAP I</b><span>ODBIÓR / IV KW. 2027</span></figcaption></figure><aside><small>POWIERZCHNIA</small><b>61–92 m²</b><small>CENY</small><b>od 689 tys. zł</b><small>DOSTĘPNE</small><b>7 z 12</b></aside></header>
<section class="dom-story" id="inwestycja"><div><span>01 / INWESTYCJA</span><h2>Dobry układ. Dobra decyzja.</h2></div><div><p>Najważniejsze informacje są widoczne od razu: metraż, termin, standard oraz status lokalu.</p><p>Klient nie musi przeszukiwać plików PDF. Porównuje ofertę i przechodzi prosto do rozmowy z doradcą.</p></div></section>
<section class="dom-list" id="lokale"><header><div><span>02 / DOSTĘPNE LOKALE</span><h2>Wybierz swój dom.</h2></div><div class="dom-filters"><button>Wszystkie</button><button>3 pokoje</button><button>4 pokoje</button></div></header><div class="dom-table"><div class="dom-table-head"><span>LOKAL</span><span>UKŁAD</span><span>METRAŻ</span><span>DODATKOWO</span><span>STATUS</span><span></span></div>
<?php foreach ([['A.01','3 pokoje','61,8 m²','ogród 84 m²','Dostępny'],['A.04','4 pokoje','78,2 m²','taras 18 m²','Rezerwacja'],['B.02','3 pokoje','66,4 m²','ogród 56 m²','Dostępny']] as $row): ?>
<article><?php foreach ($row as $i=>$cell): ?><span<?php echo $i===4?' class="status"':''; ?>><?php echo esc_html($cell); ?></span><?php endforeach; ?><a href="#kontakt">Karta lokalu ↗</a></article>
<?php endforeach; ?>
</div></section>
<section class="dom-standard" id="standard"><div class="dom-blueprint" aria-hidden="true"><i></i><i></i><i></i><b>A.01</b><span>61,8 M²</span></div><div><span>03 / STANDARD</span><h2>Konkrety, które budują zaufanie.</h2><ul><li>pompa ciepła i ogrzewanie podłogowe</li><li>duże przeszklenia i prywatny ogród</li><li>dwa miejsca postojowe</li><li>przygotowanie pod fotowoltaikę</li></ul></div></section>
<section class="dom-contact" id="kontakt"><span>POROZMAWIAJMY O TWOIM DOMU</span><h2>Zapytaj o dostępność, cenę i harmonogram.</h2><div><a href="tel:+48450458466">+48 450 458 466 ↗</a><a href="<?php echo esc_url(home_url('/#kontakt')); ?>">Wyślij zapytanie ↗</a></div><small>Projekt demonstracyjny. Lokale i ceny są przykładowe.</small></section>
<footer class="dom-footer"><a class="dom-brand" href="<?php echo esc_url(home_url('/')); ?>"><i>DD</i><span>DOM <b>DOBRY</b></span></a><p>Projekt koncepcyjny Zielonej Marki.</p><a href="<?php echo esc_url(home_url('/demo/dom')); ?>">Zobacz panel sprzedaży ↗</a></footer>
</main>
<?php wp_footer(); ?>
</body>
</html>