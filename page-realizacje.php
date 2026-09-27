<?php
get_header();
$projects=[
['01','Natura Studio','Wellness i uroda','Projekt koncepcyjny / demonstracja','Spokojna strona usługowa z prostą drogą do kontaktu i rezerwacji.',get_template_directory_uri() . '/assets/images/concept-natura.jpg','/demo/natura-strona','/demo/natura','Zobacz stronę','Zobacz zaplecze'],
['02','Bistro Forma','Gastronomia','Projekt koncepcyjny / demonstracja','Menu, klimat miejsca, rezerwacja stolika i codzienna obsługa w jednym kierunku.',get_template_directory_uri() . '/assets/images/concept-bistro.jpg','/demo/bistro-strona','/demo/bistro','Zobacz stronę','Zobacz zaplecze'],
['03','Dom Dobry','Nieruchomości','Projekt koncepcyjny / demonstracja','Czytelna prezentacja inwestycji, dostępności i drogi od oglądania do zapytania.',get_template_directory_uri() . '/assets/images/concept-dom.jpg','/demo/dom-strona','/demo/dom','Zobacz stronę','Zobacz zaplecze'],
['04','Auto Naprawa','Warsztat i obsługa klienta','Projekt koncepcyjny / demonstracja','Strona warsztatu, portal klienta, kosztorysy, faktury i widok dla kierownika.','https://lukaszst-cz.github.io/operations-office-portfolio/auto-naprawa-preview/assets/workshop-hero.png','/demo/auto-naprawa/','/demo/auto-naprawa/portal/?role=manager','Zobacz stronę','Zobacz zaplecze'],
['05','RouteFlow Transport','Transport i logistyka','Projekt koncepcyjny / demonstracja','Odrębny serwis i Control Tower dla zleceń, kierowców, dokumentów oraz wyników firmy.',get_template_directory_uri() . '/assets/images/og.png','/demo/routeflow/','/demo/routeflow/portal/?role=manager','Zobacz stronę','Zobacz zaplecze']
];
?>
<main>
<section class="page-hero shell"><span class="eyebrow"><i></i>REALIZACJE I DEMONSTRACJE</span><h1>Nie jeden szablon dla wszystkich. <em>Różne cele, różne układy.</em></h1><p>Każda demonstracja ma własny rytm: dom i usługi prowadzą do wyceny, beauty do wizyty lub sprzedaży, a transport i CRM do decyzji operacyjnej. Są to projekty koncepcyjne, nie realizacje klientów.</p><a class="button" href="#projekty">Zobacz projekty <span>↓</span></a></section>

<section id="projekty" class="section shell"><div class="project-list"><?php foreach($projects as $p): ?><article class="project-case"><div class="project-case-image" style="background-image:linear-gradient(115deg,rgba(10,31,22,.84),rgba(10,31,22,.12)),url('<?php echo esc_url($p[5]); ?>')"><span><?php echo esc_html($p[3]); ?></span><b><?php echo esc_html($p[0]); ?></b></div><div><small><?php echo esc_html($p[2]); ?></small><h2><?php echo esc_html($p[1]); ?></h2><p><?php echo esc_html($p[4]); ?></p><div class="project-case-links"><a class="button" href="<?php echo esc_url(home_url($p[6])); ?>"><?php echo esc_html($p[8]); ?> <span>↗</span></a><a class="text-link" href="<?php echo esc_url(home_url($p[7])); ?>"><?php echo esc_html($p[9]); ?> <span>↗</span></a></div></div></article><?php endforeach; ?></div></section>

<section class="section dark-section"><div class="shell operations-grid"><div><span class="section-no">PRZYKŁADY ZAPLECZA FIRMY</span><h2>Strona może być początkiem lepiej uporządkowanej pracy.</h2><p>Te przykłady pokazują obsługę zleceń, role, dokumenty, najważniejsze liczby firmy oraz kontrolę jakości w różnych sytuacjach biznesowych.</p></div><div><a class="button button-light" href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">Otwórz przykłady zaplecza <span>↗</span></a><a href="https://github.com/lukaszst-cz" target="_blank" rel="noreferrer">Zobacz kod na GitHubie ↗</a></div></div></section>

<section class="section shell next-project"><span class="section-no">TWOJA FIRMA</span><h2>Masz branżę, której jeszcze nie ma w portfolio?</h2><p>Nie kopiuję układu z innego projektu. Zaczynamy od tego, co klient Twojej firmy musi znaleźć i zrobić.</p><a class="button" href="<?php echo esc_url(home_url('/kontakt')); ?>">Porozmawiajmy o projekcie <span>↗</span></a></section>
</main>
<?php get_footer(); ?>
