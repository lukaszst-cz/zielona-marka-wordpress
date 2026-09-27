<?php get_header(); ?>
<main>
<section class="page-hero shell"><span class="eyebrow"><i></i>MARKI I OKOLICE</span><h1>Strony internetowe dla lokalnych firm, <em>które chcą zdobywać konkretne zapytania.</em></h1><p>Pomagam firmom z Marek, Ząbek, Zielonki, Kobyłki, Wołomina, Radzymina, Nieporętu, Targówka, Bródna i Białołęki. Możemy pracować zdalnie albo spotkać się lokalnie.</p><a class="button" href="#lokalny-kontakt">Opowiedz o firmie <span>↓</span></a></section>

<section class="section shell local-service-grid"><div><span class="section-no">DLA KOGO</span><h2>Firma jest lokalna, ale strona musi konkurować jakością.</h2><p>Najwięcej wartości daję firmom, które wyceniają zlecenia, przyjmują pojazdy lub umawiają klientów na termin.</p></div><div class="niche-grid"><article><h3>Motoryzacja</h3><p>Warsztaty, detailing, wulkanizacja i serwisy.</p><a href="<?php echo esc_url(home_url('/strony-dla-warsztatow')); ?>">Zobacz rozwiązanie ↗</a></article><article><h3>Dom i instalacje</h3><p>Remonty, hydraulika, elektryka, klimatyzacja i serwis.</p><a href="<?php echo esc_url(home_url('/strony-dla-firm-uslugowych')); ?>">Zobacz rozwiązanie ↗</a></article><article><h3>Beauty i wizyty</h3><p>Salony, fryzjerzy, barberzy, masaż i pokrewne usługi.</p><a href="<?php echo esc_url(home_url('/strony-dla-beauty')); ?>">Zobacz rozwiązanie ↗</a></article></div></section>

<section class="section local-proof"><div class="shell quality-grid"><div><span class="section-no">GOOGLE + STRONA + KONTAKT</span><h2>Spójna droga od wyniku wyszukiwania do rozmowy.</h2><p>Porządkuję podstawy techniczne strony, dane kontaktowe, opisy usług, obszar działania i mierzenie wysłanych formularzy. Nie gwarantuję konkretnej pozycji w Google.</p></div><ul><li><b>01</b>wersja mobilna i szybkość</li><li><b>02</b>lokalne dane firmy</li><li><b>03</b>usługi i obszar działania</li><li><b>04</b>formularz i mierzenie zapytań</li><li><b>05</b>mapa strony i Search Console</li><li><b>06</b>wsparcie Profilu Firmy Google</li></ul></div></section>

<section class="section shell local-area-section"><div class="section-head"><div><span class="section-no">OBSZAR DZIAŁANIA</span><h2>Sprawdź rozwiązania dla swojej okolicy.</h2></div><p>Każda strona opisuje ten sam standard pracy Zielonej Marki, ale odpowiada na potrzeby klientów z konkretnego miasta lub dzielnicy.</p></div><div class="local-area-links">
<a href="<?php echo esc_url(home_url('/strony-internetowe/zabki')); ?>">Ząbki ↗</a>
<a href="<?php echo esc_url(home_url('/strony-internetowe/zielonka')); ?>">Zielonka ↗</a>
<a href="<?php echo esc_url(home_url('/strony-internetowe/kobylka')); ?>">Kobyłka ↗</a>
<a href="<?php echo esc_url(home_url('/strony-internetowe/wolomin')); ?>">Wołomin ↗</a>
<a href="<?php echo esc_url(home_url('/strony-internetowe/radzymin')); ?>">Radzymin ↗</a>
<a href="<?php echo esc_url(home_url('/strony-internetowe/targowek')); ?>">Targówek ↗</a>
<a href="<?php echo esc_url(home_url('/strony-internetowe/bialoleka')); ?>">Białołęka ↗</a>
<a href="<?php echo esc_url(home_url('/strony-internetowe/warszawa')); ?>">Warszawa ↗</a>
</div></section>

<section class="section contact-section" id="lokalny-kontakt"><div class="shell contact-grid"><div><span class="section-no">LOKALNA ROZMOWA</span><h2>Najpierw sprawdzimy, czego naprawdę brakuje.</h2><p>Odpowiadam najpóźniej w następnym dniu roboczym. W wiadomości możesz podać adres obecnej strony lub Profilu Firmy w Google.</p></div><div><?php zm_render_contact_form(true); ?></div></div></section>
</main>
<?php get_footer(); ?>
