<?php
if (!defined('ABSPATH')) { exit; }

if (!is_user_logged_in()) {
    auth_redirect();
    exit;
}
if (!current_user_can('manage_options')) {
    wp_die('Brak dostępu do prywatnego wzoru umowy.', 'Brak dostępu', ['response' => 403]);
}

add_filter('wp_robots', static function(array $robots): array {
    $robots['noindex'] = true;
    $robots['nofollow'] = true;
    return $robots;
});

$clauses = [
['1. Strony i dokumenty','Wykonawca: Łukasz Staniewicz, działający pod marką Zielona Marka, kontakt: kontakt@zielona-marka.pl, +48 450 458 466. Klient i jego dane wpisywane są w wersji finalnej. Umowę uzupełniają zaakceptowana oferta, zakres prac i ewentualny brief.'],
['2. Cel i zakres','Celem jest wykonanie strony internetowej, systemu lub automatyzacji opisanych w załączniku do umowy. Załącznik wskazuje liczbę widoków lub podstron, funkcje, integracje, materiały, technologię, wersje językowe, harmonogram, cenę i liczbę rund poprawek. Elementy niewymienione w zakresie nie są objęte ceną podstawową.'],
['3. Materiały i współpraca','Klient przekazuje materiały, do których ma prawa, oraz terminowo akceptuje kolejne etapy. Wykonawca może pomóc zaplanować treści i dobrać legalne zdjęcia licencjonowane. Odpowiedzialność za zgodność przekazanych tekstów, znaków, zdjęć, cenników i informacji branżowych z prawem oraz stanem faktycznym pozostaje po stronie Klienta.'],
['4. Etapy i termin','Praca przebiega przez brief i zakres, projekt, realizację, uporządkowane poprawki, testy jakości (QA), publikację i przekazanie. Typowe terminy podane na stronie są orientacyjne; wiążący termin wpisuje się do oferty. Termin ulega odpowiedniemu przesunięciu, gdy oczekiwanie dotyczy materiałów, odpowiedzi, akceptacji lub decyzji Klienta.'],
['5. Poprawki i zmiana zakresu','W cenie są rundy poprawek wskazane w ofercie. Jedna runda to zebrany zestaw uwag do udostępnionej wersji. Nowe funkcje, dodatkowe widoki, integracje, treści, języki lub zmiana wcześniej zaakceptowanego kierunku są wyceniane przed rozpoczęciem i wymagają akceptacji Klienta.'],
['6. Wynagrodzenie i rozliczenie','Cena jest wskazana w zaakceptowanej ofercie. Klient wpłaca 30% zaliczki po akceptacji zakresu i umowy; jej zaksięgowanie rezerwuje termin i rozpoczyna realizację. Pozostałe 70% jest płatne po zaakceptowaniu gotowej wersji i zakończeniu uzgodnionych testów jakości (QA), przed publikacją na domenie lub serwerze Klienta. Rozliczenie może nastąpić bezpośrednio z Wykonawcą albo za pośrednictwem uzgodnionego partnera rozliczeniowego, np. Useme. Wybór partnera, jego regulamin, prowizje, podatki i ewentualne dodatkowe koszty są wskazywane oraz akceptowane przed zawarciem zlecenia. Za moment zapłaty uznaje się zaksięgowanie środków u Wykonawcy albo skuteczne potwierdzenie płatności przez partnera. Publikacja i przekazanie uzgodnionych dostępów następują po pełnym rozliczeniu. Koszty zewnętrzne, takie jak domena, płatne licencje, hosting, sesja zdjęciowa lub płatne narzędzia, są ujmowane wyłącznie po wyraźnej akceptacji Klienta.'],
['7. Domena, hosting i dostępy','Domena oraz kluczowe konta powinny należeć do Klienta. Wykonawca może pomóc w konfiguracji hostingu, DNS, SSL, poczty i publikacji w ramach ustalonego zakresu. Klient zachowuje bezpiecznie swoje hasła i uprawnienia; Wykonawca nie przyjmuje odpowiedzialności za blokady lub warunki narzucone przez zewnętrznych dostawców.'],
['8. SEO, widoczność i analityka','W ramach uzgodnionego pakietu strona otrzymuje techniczne podstawy SEO: logiczną strukturę, metadane, indeksowanie, mapę strony, wersję mobilną oraz podstawy wydajności. To przygotowuje stronę do dalszego pozycjonowania, ale nie jest gwarancją konkretnej pozycji w Google ani liczby zapytań. Dalsze SEO, reklamy, wizytówka Google i treści są osobnymi działaniami, jeśli nie wpisano ich do zakresu.'],
['9. Testy i odbiór','Przed publikacją Wykonawca wykonuje uzgodnione testy jakości (QA), w szczególności sprawdzenie responsywności, formularzy, podstawowej dostępności, działania linków i wydajności. Raport QA opisuje faktycznie wykonane kontrole, a nie obiecuje stałych wyników zależnych od urządzenia, sieci lub usług zewnętrznych. Klient zgłasza istotne niezgodności z zakresem w terminie wpisanym do oferty.'],
['10. Publikacja, przekazanie i opieka','Po odbiorze i rozliczeniu Wykonawca publikuje rozwiązanie oraz przekazuje uzgodnione dostępy, instrukcję i materiały. Opieka może obejmować monitoring, aktualizacje, kopie bezpieczeństwa, test formularzy, drobne zmiany treści i podsumowanie. Zakres opieki, limit drobnych zmian, czas reakcji oraz koszt są zawsze osobno wskazane; nowe funkcje nie są opieką.'],
['11. Prawa do efektów pracy','Zasady korzystania z kodu, projektu, tekstów i innych rezultatów określa oferta. Jeżeli strony chcą przenieść autorskie prawa majątkowe, finalna umowa precyzyjnie wskaże pola eksploatacji i zachowa wymaganą formę. Elementy pochodzące z licencji zewnętrznych podlegają warunkom ich licencjodawców.'],
['12. Dane osobowe i poufność','Strony wykorzystują dane kontaktowe i materiały wyłącznie do przygotowania, realizacji oraz rozliczenia współpracy. Szczegóły działania formularza i Strefy Klienta opisuje polityka prywatności Zielonej Marki. Dane dostępowe, materiały robocze i informacje handlowe nie są udostępniane osobom nieuprawnionym, z wyjątkiem sytuacji wymaganych prawem lub potrzebnych do działania uzgodnionych usług.'],
['13. Konsument i postanowienia końcowe','Jeżeli Klient jest konsumentem, finalna umowa zawierana na odległość uwzględnia wymagane informacje o prawie odstąpienia. Rozpoczęcie usługi przed upływem ustawowego terminu następuje wyłącznie na wyraźne żądanie i po przekazaniu właściwych informacji. Ten dokument jest wzorem informacyjnym, nie zawiera danych stron, ceny ani zakresu konkretnego projektu i nie stanowi porady prawnej.'],
];
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width,initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<main class="contract-page sample-contract-page">
<div class="contract-actions"><button type="button" onclick="window.print()">Drukuj / zapisz jako PDF</button><a href="<?php echo esc_url(admin_url('admin.php?page=zm-studio')); ?>">Wróć do Studio</a><a href="<?php echo esc_url(home_url('/')); ?>">Strona główna</a></div>
<article class="contract-document">
<header><img src="https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/logo-zielona-marka-transparent-v1.png" alt="Zielona Marka"><div><small>DOKUMENT INFORMACYJNY / WERSJA PRZYKŁADOWA</small><h1>Przykładowy draft umowy</h1><p>Zakres, cena, terminy i dane stron są uzupełniane dla konkretnego projektu.</p></div></header>
<p class="contract-warning"><b>Ważne:</b> to prywatny wzór do rozmowy i wglądu. Finalny dokument zawsze należy dopasować do konkretnego zlecenia; przy nietypowym zakresie lub współpracy z konsumentem warto skonsultować go z prawnikiem.</p>
<section class="contract-summary"><b>Co jest zabezpieczone w umowie?</b><span>zakres i terminy</span><span>poprawki i rozliczenie</span><span>SEO i QA</span><span>dostępy i przekazanie</span><span>opieka i prawa</span></section>
<div class="contract-clauses"><?php foreach($clauses as [$title,$body]): ?><section><h2>§ <?php echo esc_html($title); ?></h2><p><?php echo esc_html($body); ?></p></section><?php endforeach; ?></div>
<section class="contract-signatures signatures"><div><span>........................................</span><b>Wykonawca</b><small>Łukasz Staniewicz / Zielona Marka</small></div><div><span>........................................</span><b>Klient</b><small>imię, firma lub nazwa podmiotu</small></div></section>
<p class="contract-sources">Przy tworzeniu finalnej umowy uwzględnia się m.in. zasady dotyczące praw autorskich oraz praw konsumenta. Wzór nie stanowi porady prawnej.</p>
</article>
</main>
<?php wp_footer(); ?></body></html>
