<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php /* Production mirror: /demo/natura-strona */ ?>
<main class="natura-site">
<nav class="natura-nav">
<a class="natura-brand" href="<?php echo esc_url(home_url('/')); ?>"><i></i>NATURA <b>STUDIO</b></a>
<div><a href="#zabiegi">Zabiegi</a><a href="#filozofia">Filozofia</a><a href="#rezerwacja">Kontakt</a><a href="<?php echo esc_url(home_url('/#realizacje')); ?>">Portfolio</a><a href="<?php echo esc_url(home_url('/')); ?>">Zielona Marka</a></div>
<a class="natura-book" href="#rezerwacja">Zarezerwuj termin</a>
</nav>
<header class="natura-hero">
<div class="natura-hero-copy"><span>STUDIO PIELĘGNACJI / WARSZAWA</span><h1>Ciszej.<br><em>Bliżej siebie.</em></h1><p>Indywidualne rytuały pielęgnacyjne, spokojna atmosfera i rezerwacja bez zbędnych kroków.</p><a href="#zabiegi">Poznaj zabiegi <b>↓</b></a></div>
<figure><img src="https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/concept-natura.jpg" alt="Spokojne, naturalne wnętrze studia wellness"><figcaption><small>OTWARTE DZISIAJ</small><b>10:00–20:00</b></figcaption></figure>
<div class="natura-seal">NATURALNIE<br>DLA CIEBIE<br>01</div>
</header>
<section class="natura-intro" id="filozofia"><span>NASZA FILOZOFIA</span><h2>Mniej pośpiechu.<br>Więcej uważności.</h2><div><p>Najpierw słuchamy, potem dobieramy zabieg. Każda wizyta ma jasny przebieg, czas i cenę.</p><p>Strona prowadzi do decyzji delikatnie, ale konkretnie: usługa, termin, kontakt.</p></div></section>
<section class="natura-treatments" id="zabiegi"><header><span>WYBRANE RYTUAŁY</span><h2>Znajdź chwilę dla siebie.</h2></header><div>
<?php foreach ([['01','Rytuał twarzy','75 min','od 240 zł'],['02','Masaż kojący','60 min','od 190 zł'],['03','Pielęgnacja ciała','90 min','od 290 zł']] as $row): ?>
<article><b><?php echo esc_html($row[0]); ?></b><h3><?php echo esc_html($row[1]); ?></h3><p>Spokojny rytuał dobierany do aktualnych potrzeb skóry i samopoczucia.</p><footer><span><?php echo esc_html($row[2]); ?></span><strong><?php echo esc_html($row[3]); ?></strong><a href="#rezerwacja">Wybierz ↗</a></footer></article>
<?php endforeach; ?>
</div></section>
<section class="natura-moment"><div><span>TWÓJ MOMENT</span><h2>Oddech, dotyk i regeneracja.</h2></div><div class="natura-rings" aria-hidden="true"><i></i><i></i><i></i></div></section>
<section class="natura-reservation" id="rezerwacja"><div><span>REZERWACJA</span><h2>Wybierz dogodny sposób kontaktu.</h2><p>W gotowej wersji rezerwacja może łączyć się z kalendarzem, potwierdzeniami e-mail i przypomnieniami.</p></div><div><a href="tel:+48450458466">Zadzwoń +48 450 458 466 <b>↗</b></a><a href="<?php echo esc_url(home_url('/#kontakt')); ?>">Napisz do studia <b>↗</b></a><small>Projekt demonstracyjny. Nie przyjmuje prawdziwych rezerwacji.</small></div></section>
<footer class="natura-footer"><a class="natura-brand" href="<?php echo esc_url(home_url('/')); ?>"><i></i>NATURA <b>STUDIO</b></a><p>Projekt koncepcyjny Zielonej Marki.</p><a href="<?php echo esc_url(home_url('/demo/natura')); ?>">Zobacz zaplecze rezerwacji ↗</a></footer>
</main>
<?php wp_footer(); ?>
</body>
</html>