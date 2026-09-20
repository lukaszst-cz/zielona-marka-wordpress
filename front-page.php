<?php
get_header();

$problems = [
  ['01','Klienci podają za mało informacji','Formularz zbiera rodzaj usługi, termin, lokalizację i zdjęcia potrzebne do pierwszej oceny.','/oferta'],
  ['02','Strona nie prowadzi do kontaktu','Porządkuję ofertę, przyciski oraz drogę od Google i Facebooka do konkretnego zgłoszenia.','/modernizacja-strony'],
  ['03','Zapytania giną w telefonach i wiadomościach','Łączę formularz, e-mail i prosty następny krok, aby każde zgłoszenie miało właściciela.','/oferta'],
  ['04','Te same pytania zabierają czas','Asystent odpowiada z zatwierdzonej bazy wiedzy, zbiera kontakt i przekazuje rozmowę człowiekowi.','/asystent-zapytan'],
];

$projects = [
  ['01','Natura Studio','Wellness i uroda','Projekt koncepcyjny / demonstracja','Spokojna strona usługowa z prostą drogą do kontaktu i rezerwacji.','https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/concept-natura.jpg','/demo/natura-strona'],
  ['04','Auto Naprawa','Warsztat i obsługa klienta','Projekt koncepcyjny / demonstracja','Strona warsztatu, portal klienta, kosztorysy, faktury i widok dla kierownika.','https://lukaszst-cz.github.io/operations-office-portfolio/auto-naprawa-preview/assets/workshop-hero.png','https://lukaszst-cz.github.io/operations-office-portfolio/auto-naprawa-preview/'],
  ['05','TransportFlow','Transport i logistyka','Projekt koncepcyjny / demonstracja','Demonstracyjny system TMS i CRM: zlecenia, kierowcy, dokumenty oraz wyniki firmy.','https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/og.png','/realizacje/transportflow'],
  ['06','DetailFlow','Auto detailing','Projekt koncepcyjny / demonstracja','System dla zapytań, stanowisk, kontroli jakości, zdjęć, płatności i powrotów klientów.','https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/og.png','/realizacje/detailflow'],
];

$packages = [
  ['PAKIET 01','ZM Start','od 2 490 zł netto','Jedna konkretna strona dla lokalnej firmy, która ma prowadzić z Google do telefonu lub zapytania.',['One Page do ok. 7 sekcji, oferta i kontakt','telefon, WhatsApp, mapa oraz formularz','wersja mobilna i podstawy lokalnego SEO'],'zwykle 7 dni roboczych'],
  ['PAKIET 02','ZM LeadFlow','od 4 490 zł netto','Strona i formularz kwalifikujący, dzięki którym firma otrzymuje kompletne zgłoszenia zamiast ogólnych pytań.',['do 6 podstron i indywidualny układ','formularz z opisem, terminem i możliwością dodania zdjęć','lokalne SEO, analityka i przygotowanie Profilu Firmy Google'],'zwykle 10–14 dni roboczych'],
  ['PAKIET 03','ZM Flow AI','od 6 900 zł netto','Strona, formularz i asystent połączone z prostym obiegiem zapytań w firmie.',['strona oraz formularz kwalifikujący','asystent FAQ lub AI oparty na zatwierdzonej bazie odpowiedzi','przekazanie zgłoszeń do właściciela lub zespołu'],'zwykle 14–21 dni roboczych'],
];

$brief_status = sanitize_key(wp_unslash($_GET['brief'] ?? ''));
?>
<main id="top">
  <section class="sales-hero shell">
    <div class="eyebrow"><span></span>STRONY WWW · FORMULARZE WYCENY · ASYSTENTY</div>
    <p class="sales-hero-kicker">Dla warsztatów, ekip remontowych, branży beauty i lokalnych firm usługowych.</p>
    <h1>Tworzę cyfrowe miejsca, <em>w których marki rosną.</em></h1>
    <p class="sales-hero-copy">Projektuję szybkie, charakterystyczne strony, formularze i małe CRM-y, które pomagają firmom zdobywać klientów i nie gubić żadnego zapytania.</p>
    <div class="hero-actions">
      <a class="button" href="<?php echo esc_url(home_url('/kontakt')); ?>">Poproś o wycenę <span>↗</span></a>
      <a class="text-link" href="<?php echo esc_url(home_url('/realizacje')); ?>">Zobacz realizacje <span>↓</span></a>
    </div>
    <div class="sales-hero-proof" aria-label="Najważniejsze zasady Zielonej Marki">
      <span>Jasny zakres</span><span>30% na start · 70% przed publikacją</span><span>Testy QA i 14 dni wsparcia</span>
    </div>
  </section>

  <section class="section shell niche-section" id="dla-kogo">
    <div class="section-head"><div><span class="section-no">TRZY GŁÓWNE KIERUNKI</span><h2>Rozwiązanie dopasowane do sposobu obsługi klienta.</h2></div><p>Formularz, treść i kolejne kroki wynikają z tego, czy firma wycenia zlecenia, przyjmuje pojazdy czy umawia wizyty.</p></div>
    <div class="niche-grid niche-grid-three">
      <article><span>01 / MOTORYZACJA</span><h3>Warsztaty i detailing</h3><p>Marka i model auta, usterka, preferowany termin, zdjęcia oraz kontakt w jednym zgłoszeniu.</p><a class="button" href="<?php echo esc_url(home_url('/strony-dla-warsztatow')); ?>">Zobacz demonstrację <b>↗</b></a></article>
      <article><span>02 / USŁUGI DLA DOMU</span><h3>Remonty i instalacje</h3><p>Rodzaj prac, lokalizacja, pilność, zdjęcia miejsca i oczekiwany termin bez wielokrotnego dopytywania.</p><a class="button" href="<?php echo esc_url(home_url('/strony-dla-firm-uslugowych')); ?>">Zobacz demonstrację <b>↗</b></a></article>
      <article><span>03 / WIZYTY</span><h3>Beauty i pokrewne usługi</h3><p>Oferta, wybór zabiegu, rezerwacja, przypomnienie i prośba o opinię w jednej spójnej ścieżce.</p><a class="button" href="<?php echo esc_url(home_url('/strony-dla-beauty')); ?>">Zobacz demonstrację <b>↗</b></a></article>
    </div>
  </section>

  <section class="problem-section"><div class="shell">
    <div class="section-head"><div><span class="section-no">ZACZNIJ OD PROBLEMU</span><h2>Co dziś zabiera czas albo blokuje sprzedaż?</h2></div><p>Technologia jest narzędziem. Najpierw ustalamy, czego brakuje klientom i czego potrzebuje firma, żeby szybko odpowiedzieć.</p></div>
    <div class="problem-grid">
      <?php foreach ($problems as $item) : ?>
        <article><span><?php echo esc_html($item[0]); ?></span><h3><?php echo esc_html($item[1]); ?></h3><p><?php echo esc_html($item[2]); ?></p><a href="<?php echo esc_url(home_url($item[3])); ?>">Zobacz rozwiązanie <b>↗</b></a></article>
      <?php endforeach; ?>
    </div>
  </div></section>

  <section class="rebuild-banner dark-section"><div class="shell rebuild-grid">
    <div><span class="section-no">MODERNIZACJA ZAMIAST ZMIANY DLA ZMIANY</span><h2>Stara strona nie zawsze wymaga budowy od zera. <em>Najpierw sprawdzam, co warto poprawić.</em></h2></div>
    <div><p>Ocenię widok na telefonie, ofertę, kontakt, szybkość i przygotowanie do Google. Potem dostaniesz prostą odpowiedź: poprawiamy czy budujemy od nowa.</p><a class="button button-light" href="<?php echo esc_url(home_url('/modernizacja-strony')); ?>">Sprawdź obecną stronę <span>↗</span></a></div>
  </div></section>

  <section class="section shell">
    <div class="section-head"><div><span class="section-no">PROJEKTY DEMONSTRACYJNE</span><h2>Zobacz stronę i proces, zanim porozmawiamy o wdrożeniu.</h2></div><p>Każdy projekt pokazowy jest jasno oznaczony. Demonstracje nie są przedstawiane jako realizacje prawdziwych klientów.</p></div>
    <div class="project-preview-grid">
      <?php foreach ($projects as $project) :
        $href = strpos($project[6], 'http') === 0 ? $project[6] : home_url($project[6]); ?>
        <article class="project-preview">
          <div class="project-preview-image" style="background-image:linear-gradient(180deg,rgba(10,31,22,.08),rgba(10,31,22,.78)),url('<?php echo esc_url($project[5]); ?>')"><span><?php echo esc_html($project[3]); ?></span><b><?php echo esc_html($project[0]); ?></b></div>
          <div><small><?php echo esc_html($project[2]); ?></small><h3><?php echo esc_html($project[1]); ?></h3><p><?php echo esc_html($project[4]); ?></p><a href="<?php echo esc_url($href); ?>">Zobacz demonstrację <b>↗</b></a></div>
        </article>
      <?php endforeach; ?>
    </div>
    <a class="section-link" href="<?php echo esc_url(home_url('/realizacje')); ?>">Zobacz wszystkie projekty demonstracyjne <span>↗</span></a>
  </section>

  <section class="section offer-teaser"><div class="shell">
    <div class="section-head"><div><span class="section-no">TRZY PROSTE PAKIETY</span><h2>Strona, system zapytań albo pełny przepływ.</h2></div><p>Najczęściej rekomenduję ZM LeadFlow: stronę połączoną z formularzem, który zbiera dane potrzebne do pierwszej rozmowy, wyceny lub rezerwacji.</p></div>
    <div class="core-package-grid">
      <?php foreach ($packages as $i => $item) : ?>
        <article<?php echo $i === 1 ? ' class="featured"' : ''; ?>><span><?php echo esc_html($item[0]); ?></span><div class="package-number">0<?php echo esc_html((string)($i + 1)); ?></div><h3><?php echo esc_html($item[1]); ?></h3><b><?php echo esc_html($item[2]); ?></b><p><?php echo esc_html($item[3]); ?></p><ul><?php foreach ($item[4] as $line) : ?><li><?php echo esc_html($line); ?></li><?php endforeach; ?></ul><small><?php echo esc_html($item[5]); ?></small><a href="<?php echo esc_url(home_url('/oferta')); ?>">Poznaj zakres <i>↗</i></a></article>
      <?php endforeach; ?>
    </div>
  </div></section>

  <section class="section shell more-services">
    <div class="section-head"><div><span class="section-no">PEŁNA OFERTA ZOSTAJE</span><h2>Strona może być pierwszym etapem większego usprawnienia.</h2></div><p>Główne branże ułatwiają rozpoczęcie rozmowy. Pozostałe rozwiązania są nadal dostępne i mają własne miejsca na stronie.</p></div>
    <div class="more-services-grid">
      <a href="<?php echo esc_url(home_url('/usprawnienia-firmy#automatyzacje')); ?>"><span>01</span><h3>Automatyzacje i integracje</h3><p>Formularze, e-mail, kalendarz, arkusze i używane systemy zaczynają współpracować.</p><b>Zobacz możliwości ↗</b></a>
      <a href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>"><span>02</span><h3>Mały CRM i statusy</h3><p>Klienci, zapytania, zlecenia, terminy i następny krok w jednym miejscu.</p><b>Zobacz Mały CRM ↗</b></a>
      <a href="<?php echo esc_url(home_url('/oferta#mini-sklep')); ?>"><span>03</span><h3>Mini sklep i vouchery</h3><p>Sprzedaż kilku produktów, zestawów lub voucherów bez budowania wielkiego sklepu.</p><b>Zobacz zakres ↗</b></a>
      <a href="<?php echo esc_url(home_url('/strony-internetowe-marki')); ?>"><span>04</span><h3>Google i widoczność lokalna</h3><p>Spójne dane, usługi, obszar działania, Search Console i mierzenie zapytań.</p><b>Zobacz lokalne SEO ↗</b></a>
    </div>
  </section>

  <section class="asystent-band dark-section"><div class="shell asystent-band-grid">
    <div><span class="section-no">ASYSTENT DEMONSTRACYJNY</span><h2>Najpierw wypróbuj go <em>na naszej stronie.</em></h2><p>Asystent w prawym dolnym rogu pokaże, jak rozpoznać potrzebę klienta, zebrać kontakt i przekazać uporządkowane zgłoszenie.</p></div>
    <div><button class="button button-light" type="button" data-open-demo-kontakt>Uruchom asystenta <span>↗</span></button><a href="<?php echo esc_url(home_url('/asystent-zapytan')); ?>">Jak działa wdrożenie <span>→</span></a></div>
  </div></section>

  <section class="section crm-home"><div class="shell crm-home-grid">
    <div><span class="section-no">MAŁY CRM DLA FIRMY</span><h2>Zapytanie nie kończy się w skrzynce. <em>Dostaje status i następny krok.</em></h2><p>Prosty panel pokazuje, kto czeka na odpowiedź, komu wysłano wycenę, które zlecenie jest w realizacji i kiedy trzeba wrócić do klienta. Bez wdrażania dużego, drogiego systemu.</p><div class="hero-actions"><a class="button" href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">Zobacz Mały CRM <span>↗</span></a><a class="text-link" href="<?php echo esc_url(home_url('/usprawnienia-firmy#film')); ?>">Obejrzyj film 20 s <span>→</span></a></div></div>
    <div class="crm-home-board" aria-label="Przykładowy lejek Małego CRM"><header><span>DZISIAJ / ZAPYTANIA</span><b>4 aktywne</b></header><article><i>01</i><div><b>Nowe zapytanie</b><small>oddzwoń do 12:00</small></div><span>NOWE</span></article><article><i>02</i><div><b>Wycena wysłana</b><small>przypomnienie jutro</small></div><span>OFERTA</span></article><article><i>03</i><div><b>Zlecenie przyjęte</b><small>termin: piątek</small></div><span>REALIZACJA</span></article><footer>Każdy klient ma właściciela i kolejny krok.</footer></div>
  </div></section>

  <section class="section quality-section"><div class="shell quality-grid">
    <div><span class="section-no">GOTOWA DO STARTU</span><h2>Przed publikacją sprawdzam to, czego klient nie powinien sam pilnować.</h2><p>QA obejmuje najważniejsze elementy strony, zanim zobaczy ją pierwszy klient.</p><a href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Zobacz proces i zasady 30/70 <b>↗</b></a></div>
    <ul><li><b>01</b>Telefon, tablet i komputer</li><li><b>02</b>Formularze, linki i kontakt</li><li><b>03</b>Szybkość oraz stabilność</li><li><b>04</b>Podstawy SEO i Google</li><li><b>05</b>Dostępność i czytelność</li><li><b>06</b>Pełna ścieżka klienta</li></ul>
  </div></section>

  <section class="section contact-section" id="kontakt"><div class="shell contact-grid">
    <div><span class="section-no">ZACZNIJMY</span><h2>Opowiedz, jak dziś trafiają do Ciebie klienci.</h2><p>Odpowiadam najpóźniej w następnym dniu roboczym. Możemy rozmawiać telefonicznie, przez Google Meet, e-mail lub WhatsApp.</p><div class="contact-direct"><a href="tel:+48450458466"><small>M:</small><strong>+48 450 458 466</strong></a><a href="mailto:kontakt@zielona-marka.pl"><small>E-mail:</small><strong>kontakt@zielona-marka.pl</strong></a></div></div>
    <div><span class="contact-form-kicker">KRÓTKI BRIEF · OKOŁO 1 MINUTY</span>
      <?php if ($brief_status === 'sent') : ?><div class="form-success" role="status"><b>Dziękuję, wiadomość została wysłana.</b><p>Wrócę z propozycją kolejnego kroku i wstępną wyceną.</p></div>
      <?php else : ?>
      <form class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
        <input type="hidden" name="action" value="zm_send_brief">
        <?php wp_nonce_field('zm_send_brief', 'zm_brief_nonce'); ?>
        <label>Imię<input required name="name" placeholder="Jak masz na imię?" autocomplete="name"></label>
        <label>E-mail<input required type="email" name="email" placeholder="twoj@email.pl" autocomplete="email"></label>
        <label>Firma <span>(opcjonalnie)</span><input name="company" placeholder="Nazwa firmy" autocomplete="organization"></label>
        <label>Czego potrzebujesz?<select required name="projectType"><option value="" disabled selected>Wybierz najbliższą odpowiedź</option><option>Strona dla warsztatu lub detailingu</option><option>Strona dla firmy remontowej lub instalatora</option><option>Strona dla beauty lub usług na termin</option><option>Nowa strona dla innej firmy usługowej</option><option>Modernizacja obecnej strony</option><option>Formularz wyceny lub zgłoszenia</option><option>Mały CRM do klientów i zleceń</option><option>Asystent dla firmy</option><option>Potrzebuję krótkiej konsultacji</option></select></label>
        <label class="form-wide">Co dziś nie działa albo jaki efekt chcesz osiągnąć?<textarea required name="message" rows="5" placeholder="Np. mam starą stronę, klienci nie dzwonią, chcę sprzedawać kilka produktów…"></textarea></label>
        <label class="form-consent form-wide"><input required type="checkbox" name="consent" value="yes"> <span>Zapoznałem/-am się z <a href="<?php echo esc_url(home_url('/polityka-prywatnosci')); ?>">polityką prywatności</a> i proszę o kontakt.</span></label>
        <button class="button form-wide" type="submit">Wyślij brief <span>↗</span></button>
        <?php if ($brief_status === 'error') : ?><p class="form-error form-wide" role="alert">Nie udało się wysłać wiadomości. Napisz bezpośrednio na kontakt@zielona-marka.pl.</p><?php endif; ?>
      </form>
      <?php endif; ?>
    </div>
  </div></section>
</main>
<a class="whatsapp-float" href="tel:+48450458466" aria-label="Zadzwoń do Zielonej Marki"><span aria-hidden="true">◌</span><b>Zadzwoń teraz</b><small>+48 450 458 466</small><i aria-hidden="true">↗</i></a>
<?php get_footer(); ?>
