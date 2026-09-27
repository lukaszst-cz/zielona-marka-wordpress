<?php
if (!defined('ABSPATH')) { exit; }

$slug = get_post_field('post_name', get_queried_object_id());
$locations = [
  'targowek' => [
    'name' => 'Targówek', 'genitive' => 'Targówka',
    'intro' => 'Tworzę strony i formularze dla usługodawców, którzy konkurują na warszawskim rynku i potrzebują czytelnie pokazać specjalizację, obszar oraz przewagę swojej oferty.',
    'local1' => 'Na Targówku klient ma duży wybór wykonawców. Strona musi w kilka chwil wyjaśnić specjalizację, pokazać wiarygodność i umożliwić wygodny kontakt z telefonu.',
    'local2' => 'Na Targówku konkurencja jest duża, dlatego pierwsza część strony powinna od razu łączyć usługę, dowód jakości i prosty kontakt z telefonu.',
    'nearby' => 'Bródno, Zacisze, Marki, Ząbki i Białołęka',
  ],
  'warszawa' => [
    'name' => 'Warszawa', 'genitive' => 'Warszawy',
    'intro' => 'Tworzę strony WWW, formularze wyceny i proste systemy obsługi klientów dla warszawskich firm usługowych, które chcą wyróżnić specjalizację i uporządkować zapytania.',
    'local1' => 'Warszawski klient porównuje wiele ofert. Strona powinna szybko odpowiedzieć na trzy pytania: czy rozwiązujesz jego problem, czy działasz w jego rejonie i jak może przekazać dane potrzebne do rozmowy.',
    'local2' => 'W Warszawie sama ogólna obietnica nie wystarcza. Strona powinna pokazać specjalizację, obszar działania i sposób przygotowania do wyceny zanim klient wybierze kolejną ofertę.',
    'nearby' => 'Targówek, Białołęka, Bródno, Zacisze oraz miejscowości po wschodniej stronie miasta',
  ],
  'zabki' => [
    'name' => 'Ząbki', 'genitive' => 'Ząbek',
    'intro' => 'Pomagam lokalnym usługodawcom jasno pokazać ofertę, zebrać dane potrzebne do wyceny i poprowadzić klienta od wyszukiwarki do kontaktu.',
    'local1' => 'W Ząbkach klient często porównuje kilka firm z najbliższej okolicy. Strona powinna od razu pokazać, czym się zajmujesz, dokąd dojeżdżasz i jak szybko można rozpocząć rozmowę.',
    'local2' => 'Dla firmy działającej w Ząbkach oznacza to prostą wersję mobilną, jasny numer telefonu i sekcje, które nie każą klientowi szukać zakresu usługi po całej stronie.',
    'nearby' => 'Marki, Zielonka, Targówek i wschodnia Warszawa',
  ],
  'zielonka' => [
    'name' => 'Zielonka', 'genitive' => 'Zielonki',
    'intro' => 'Tworzę strony, formularze i proste zaplecza, które pomagają lokalnej firmie otrzymywać bardziej kompletne zapytania i sprawniej na nie odpowiadać.',
    'local1' => 'Klient z Zielonki szuka wygodnego kontaktu i pewności, że firma rzeczywiście obsługuje jego rejon. Dobra strona łączy lokalną informację z konkretnym zakresem usługi.',
    'local2' => 'W Zielonce warto połączyć lokalny zasięg z konkretną specjalizacją. Dzięki temu klient widzi zarówno obszar działania, jak i powód, dla którego ma wybrać właśnie tę firmę.',
    'nearby' => 'Marki, Ząbki, Kobyłka i Wołomin',
  ],
  'kobylka' => [
    'name' => 'Kobyłka', 'genitive' => 'Kobyłki',
    'intro' => 'Projektuję strony internetowe dla firm usługowych, które chcą lepiej prezentować ofertę, kwalifikować zapytania i pilnować kolejnych kroków obsługi.',
    'local1' => 'W Kobyłce wiele usług opiera się na dojeździe, terminie albo wcześniejszej wycenie. Strona może zebrać lokalizację, zakres i zdjęcia, zanim właściciel oddzwoni.',
    'local2' => 'Dla usług wyjazdowych z Kobyłki najwięcej zmienia formularz, który już na początku zbierze miejsce realizacji, zdjęcia i dogodny termin kontaktu.',
    'nearby' => 'Zielonka, Wołomin, Marki i Radzymin',
  ],
  'wolomin' => [
    'name' => 'Wołomin', 'genitive' => 'Wołomina',
    'intro' => 'Buduję strony i niewielkie systemy dla firm, które chcą zamieniać lokalne wejścia z Google w uporządkowane rozmowy, wyceny i zlecenia.',
    'local1' => 'Firma z Wołomina może obsługiwać całe miasto i sąsiednie gminy. Strona powinna wyjaśnić zasięg, pokazać specjalizację oraz ułatwić przekazanie informacji potrzebnych do wyceny.',
    'local2' => 'Przy obsłudze miasta i sąsiednich gmin dobrze działają osobne opisy usług oraz przejrzysta informacja o dojeździe, czasie odpowiedzi i sposobie wyceny.',
    'nearby' => 'Kobyłka, Zielonka, Radzymin i okolice powiatu wołomińskiego',
  ],
  'radzymin' => [
    'name' => 'Radzymin', 'genitive' => 'Radzymina',
    'intro' => 'Pomagam firmom usługowym stworzyć czytelną ofertę online oraz prostą drogę od lokalnego wyszukiwania do telefonu, formularza i wyceny.',
    'local1' => 'Przy większym obszarze dojazdu klient powinien szybko sprawdzić, czy firma obsługuje jego miejscowość. Formularz może dodatkowo zebrać lokalizację, termin i opis zlecenia.',
    'local2' => 'Gdy firma dojeżdża poza sam Radzymin, klient powinien przed rozmową łatwo potwierdzić obszar obsługi. To ogranicza przypadkowe zapytania i skraca wycenę.',
    'nearby' => 'Marki, Wołomin, Nieporęt i północno-wschodnie okolice Warszawy',
  ],
  'bialoleka' => [
    'name' => 'Białołęka', 'genitive' => 'Białołęki',
    'intro' => 'Projektuję strony dla firm usługowych, które chcą docierać do klientów z dynamicznie rozwijającej się części Warszawy i szybciej obsługiwać zgłoszenia.',
    'local1' => 'Na Białołęce liczy się jasny obszar dojazdu, wygodna wersja mobilna i możliwość szybkiego przekazania szczegółów. Dobrze ułożona strona skraca drogę do rozmowy.',
    'local2' => 'Przy rozproszonych adresach Białołęki dobra strona prowadzi klienta od usługi do przekazania lokalizacji. Dzięki temu firma dostaje informacje potrzebne do oceny dojazdu.',
    'nearby' => 'Targówek, Marki, Nieporęt i północna Warszawa',
  ],
];

$data = $locations[$slug] ?? null;
if (!$data) {
  status_header(404);
  get_template_part('404');
  exit;
}

get_header();
?>
<main>
<section class="page-hero shell"><span class="eyebrow"><i></i><?php echo esc_html(mb_strtoupper($data['name'])); ?> · STRONY I SYSTEMY DLA FIRM</span><h1>Strona internetowa, która pomaga firmie z <?php echo esc_html($data['genitive']); ?> zdobywać konkretne zapytania.</h1><p><?php echo esc_html($data['intro']); ?></p><div class="hero-actions"><a class="button" href="#lokalny-kontakt">Porozmawiajmy o firmie <span>↗</span></a><a class="text-link" href="#przyklady">Zobacz przykłady <span>↓</span></a></div></section>

<section class="section local-client-section"><div class="shell local-client-grid"><div><span class="section-no">LOKALNY KLIENT CHCE SZYBKIEJ ODPOWIEDZI</span><h2>Od wyniku w Google do informacji potrzebnych do wyceny.</h2></div><div><p><?php echo esc_html($data['local1']); ?></p><p><?php echo esc_html($data['local2']); ?></p></div></div></section>

<section class="section shell"><div class="section-head"><div><span class="section-no">CO MOŻE ZYSKAĆ FIRMA</span><h2>Strona pracuje przed pierwszym telefonem.</h2></div><p>Najpierw klient rozumie usługę. Potem przekazuje dane, które pozwalają szybciej odpowiedzieć.</p></div><div class="local-benefit-grid">
<article><span>01</span><h3>Lepsza decyzja</h3><p>Czytelna oferta pokazuje zakres, obszar działania i sposób rozpoczęcia współpracy.</p></article>
<article><span>02</span><h3>Kompletne zapytanie</h3><p>Formularz zbiera usługę, lokalizację, termin, opis i zdjęcia potrzebne do pierwszej oceny.</p></article>
<article><span>03</span><h3>Widoczny następny krok</h3><p>Telefon, e-mail i formularz prowadzą do konkretnej rozmowy zamiast pozostawiać klienta bez odpowiedzi.</p></article>
<article><span>04</span><h3>Porządek po kontakcie</h3><p>Prosty system może przypisać status, termin i osobę odpowiedzialną za dalszą obsługę.</p></article>
</div></section>

<section class="section local-examples" id="przyklady"><div class="shell"><div class="section-head"><div><span class="section-no">PRZYKŁADY DLA BRANŻ</span><h2>Zobacz, jak strona może działać w praktyce.</h2></div><p>Demonstracje pokazują mechanizm. Wdrożenie otrzymuje treść, pytania i wygląd dopasowane do konkretnej firmy.</p></div><div class="local-example-grid">
<a href="<?php echo esc_url(home_url('/strony-dla-warsztatow')); ?>"><h3>Warsztaty i detailing</h3><p>Zgłoszenie z danymi auta, opisem problemu, zdjęciami i preferowanym terminem.</p><b>Zobacz rozwiązanie ↗</b></a>
<a href="<?php echo esc_url(home_url('/strony-dla-firm-uslugowych')); ?>"><h3>Remonty i instalacje</h3><p>Zakres prac, lokalizacja, pilność oraz materiały do pierwszej oceny w jednym formularzu.</p><b>Zobacz rozwiązanie ↗</b></a>
<a href="<?php echo esc_url(home_url('/strony-dla-beauty')); ?>"><h3>Beauty i usługi na termin</h3><p>Czytelna oferta, przygotowanie do wizyty i prosta droga do rezerwacji.</p><b>Zobacz rozwiązanie ↗</b></a>
</div></div></section>

<section class="section local-seo"><div class="shell local-seo-grid"><div><span class="section-no">WIDOCZNOŚĆ LOKALNA</span><h2>Spójna informacja na stronie i w Google.</h2><p>Przygotowuję stronę do indeksowania, lokalne treści, dane strukturalne, mapę witryny i pomiar kontaktów. Nie obiecuję konkretnego miejsca, bo pozycja zależy również od konkurencji i historii domeny.</p></div><ol><li>unikalna treść dla <?php echo esc_html($data['genitive']); ?></li><li>czytelny obszar działania</li><li>wersja mobilna i szybkość</li><li>linki do właściwych usług</li><li>formularz i mierzenie kontaktu</li><li>mapa strony dla Google</li></ol></div></section>

<section class="section shell faq-page"><div class="section-head"><div><span class="section-no">NAJCZĘSTSZE PYTANIA</span><h2>Co warto wiedzieć przed rozmową?</h2></div></div><div class="faq-list">
<details open><summary><span>01</span>Czy obsługujesz firmy z <?php echo esc_html($data['genitive']); ?>?<i>+</i></summary><p>Tak. Zielona Marka projektuje strony i proste systemy dla firm działających w <?php echo esc_html($data['name']); ?> oraz w okolicy: <?php echo esc_html($data['nearby']); ?>. Współpraca może odbywać się online.</p></details>
<details><summary><span>02</span>Ile kosztuje strona dla lokalnej firmy?<i>+</i></summary><p>Kompletna strona startowa kosztuje od 1 449 zł netto. Rozbudowana strona z formularzem kwalifikującym zaczyna się od 4 490 zł netto. Dokładny zakres ustalamy po krótkiej rozmowie.</p></details>
<details><summary><span>03</span>Czy strona może pomóc w lokalnej widoczności?<i>+</i></summary><p>Tak. Przygotowuję strukturę, treści, dane firmy, mapę witryny oraz podstawy techniczne. Widoczność rozwija się z czasem i zależy również od konkurencji, opinii, Profilu Firmy Google i jakości oferty.</p></details>
<details><summary><span>04</span>Czy można poprawić istniejącą stronę?<i>+</i></summary><p>Tak. Najpierw sprawdzam wersję mobilną, ofertę, kontakt, szybkość i podstawy widoczności. Dopiero wtedy rekomenduję modernizację albo budowę od nowa.</p></details>
</div></section>

<section class="section contact-section" id="lokalny-kontakt"><div class="shell contact-grid"><div><span class="section-no">KRÓTKA ROZMOWA</span><h2>Opowiedz, co dziś nie działa.</h2><p>Podaj obecną stronę, rodzaj usług i sposób, w jaki klienci najczęściej się kontaktują. Odpowiadam najpóźniej w następnym dniu roboczym.</p></div><div><?php zm_render_contact_form(true); ?></div></div></section>
</main>
<?php get_footer(); ?>
