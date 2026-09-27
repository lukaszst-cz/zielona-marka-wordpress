<?php
get_header();
$checks=[
['01','Widok i czytelność','telefon, tablet i komputer','nagłówki, przyciski, obrazy oraz układ nie zasłaniają treści'],
['02','Kontakt','telefon, e-mail, formularz i WhatsApp','każda droga kontaktu prowadzi we właściwe miejsce'],
['03','Podstawy Google','tytuł, opis, główny adres, mapa strony','wyszukiwarka otrzymuje uporządkowane informacje o stronie'],
['04','Szybkość i stabilność','obciążenie strony oraz test Lighthouse','wynik jest omawiany jako kontrola techniczna, nie obietnica pozycji w Google'],
['05','Przed publikacją','adres domeny, HTTPS i przekierowania','otwierają się właściwe wersje strony, bez ostrzeżeń przeglądarki']
];
?>
<main>
<section class="page-hero shell"><span class="eyebrow"><i></i>PRZYKŁADOWY RAPORT KONTROLI JAKOŚCI</span><h1>Co sprawdzam, zanim strona zacznie pracować na firmę.</h1><p>Kontrola jakości (QA, ang. Quality Assurance) to ostatnie sprawdzenie przed publikacją. Poniżej jest przykładowa forma podsumowania bez danych klienta. W konkretnym projekcie raport odnosi się do jego strony i ustalonego zakresu.</p><div class="hero-actions"><a class="button" href="<?php echo esc_url(home_url('/kontakt')); ?>">Omów swój projekt <span>↗</span></a><a class="text-link" href="#raport">Przejdź do raportu <span>↓</span></a></div></section>
<section class="section shell qa-report-page" id="raport"><div class="section-head"><div><span class="section-no">KONTROLA PRZED STARTEM</span><h2>Przykład: strona firmowa</h2></div><p>Możesz zapisać tę stronę jako PDF z poziomu przeglądarki: Drukuj → Zapisz jako PDF.</p></div>
<div class="qa-report-card"><header><span>STANDARD ZIELONEJ MARKI</span><strong>QA</strong><b>KONTROLA JAKOŚCI<br>PRZED PUBLIKACJĄ</b></header><div class="qa-report-meta"><span><b>PROJEKT:</b> przykładowa strona firmowa</span><span><b>STATUS:</b> gotowa do publikacji po akceptacji</span><span><b>DATA:</b> uzupełniana przy odbiorze</span></div>
<?php foreach($checks as $c): ?><article><span><?php echo esc_html($c[0]); ?></span><div><h3><?php echo esc_html($c[1]); ?></h3><p><b>Sprawdzony zakres:</b> <?php echo esc_html($c[2]); ?></p><p><b>Wynik kontroli:</b> <?php echo esc_html($c[3]); ?></p></div><strong aria-label="zaliczone">✓</strong></article><?php endforeach; ?>
<footer><h3>Co oznacza „gotowa do publikacji”?</h3><p>Najważniejsze elementy z uzgodnionego zakresu zostały sprawdzone. Wdrożenie pozostaje zależne od akceptacji klienta, dostępu do domeny oraz ewentualnych materiałów lub usług zewnętrznych.</p></footer></div></section>
</main>
<?php get_footer(); ?>
