<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<main class="zm-v5">
<a class="zmh-skip" href="#opowiesc">Przejdź do treści</a>

<div class="zmh-forest" id="start">
  <div class="zmh-opening">
    <div class="zmh-living-forest" aria-hidden="true">
      <video data-zm-forest-video muted loop playsinline preload="none"></video>
    </div>
    <button class="zmh-film-control" type="button" data-zm-film-control aria-pressed="false">Ⅱ Zatrzymaj tło</button>

    <header class="zm-header">
      <nav class="zm-nav" aria-label="Główna nawigacja">
        <a class="zm-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Zielona Marka">
          <span class="brand-signature" role="img" aria-label="Zielona Marka">
            <img class="brand-apple" src="https://zielona-marka.pl/logo-fern-automation-white.svg" width="96" height="98" alt="">
            <span class="brand-wordmark"><b>ZIELONA</b><b>MARKA</b><small>STRONY WWW I SYSTEMY DLA FIRM</small></span>
          </span>
        </a>

        <div class="zm-nav-desktop">
          <details class="zm-offer-menu">
            <summary>Oferta <span aria-hidden="true">⌄</span></summary>
            <div>
              <a href="<?php echo esc_url(home_url('/oferta')); ?>">Strony WWW</a>
              <a href="<?php echo esc_url(home_url('/modernizacja-strony')); ?>">Modernizacja strony</a>
              <a href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">CRM i obsługa klientów</a>
              <a href="<?php echo esc_url(home_url('/usprawnienia-firmy')); ?>">Usprawnienia i automatyzacje</a>
              <a href="<?php echo esc_url(home_url('/strony-dla-firm-uslugowych')); ?>">Firmy usługowe</a>
              <a href="<?php echo esc_url(home_url('/strony-dla-beauty')); ?>">Beauty</a>
              <a href="<?php echo esc_url(home_url('/strony-dla-warsztatow')); ?>">Warsztaty</a>
              <a href="<?php echo esc_url(home_url('/asystent-zapytan')); ?>">Asystent zapytań</a>
              <a href="<?php echo esc_url(home_url('/chatbot-dla-firm')); ?>">Chatbot dla firmy</a>
              <a href="<?php echo esc_url(home_url('/strony-internetowe/targowek')); ?>">Warszawa · Targówek</a>
            </div>
          </details>
          <a href="<?php echo esc_url(home_url('/realizacje')); ?>">Projekty</a>
          <a href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Współpraca</a>
          <a href="<?php echo esc_url(home_url('/kontakt')); ?>">Kontakt</a>
          <a class="zm-client-link" href="<?php echo esc_url(home_url('/status')); ?>">Strefa klienta</a>
          <span class="zm-languages" role="group" aria-label="Język strony">
            <a href="<?php echo esc_url(home_url('/')); ?>" lang="pl" hreflang="pl" aria-label="Polski" aria-current="true">PL</a>
            <a href="<?php echo esc_url(home_url('/en')); ?>" lang="en" hreflang="en" aria-label="English">EN</a>
          </span>
        </div>

        <details class="zm-mobile-menu">
          <summary>Menu <span aria-hidden="true">+</span></summary>
          <div>
            <a href="<?php echo esc_url(home_url('/oferta')); ?>">Strony WWW</a>
            <a href="<?php echo esc_url(home_url('/modernizacja-strony')); ?>">Modernizacja strony</a>
            <a href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">CRM i obsługa klientów</a>
            <a href="<?php echo esc_url(home_url('/usprawnienia-firmy')); ?>">Usprawnienia i automatyzacje</a>
            <a href="<?php echo esc_url(home_url('/strony-dla-firm-uslugowych')); ?>">Firmy usługowe</a>
            <a href="<?php echo esc_url(home_url('/strony-dla-beauty')); ?>">Beauty</a>
            <a href="<?php echo esc_url(home_url('/strony-dla-warsztatow')); ?>">Warsztaty</a>
            <a href="<?php echo esc_url(home_url('/asystent-zapytan')); ?>">Asystent zapytań</a>
            <a href="<?php echo esc_url(home_url('/realizacje')); ?>">Projekty</a>
            <a href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Współpraca</a>
            <a href="<?php echo esc_url(home_url('/kontakt')); ?>">Kontakt</a>
            <a href="<?php echo esc_url(home_url('/status')); ?>">Strefa klienta</a>
            <span class="zm-languages"><a href="<?php echo esc_url(home_url('/')); ?>" aria-current="true">PL</a><a href="<?php echo esc_url(home_url('/en')); ?>">EN</a></span>
            <a href="tel:+48450458466">+48 450 458 466</a>
          </div>
        </details>
      </nav>
    </header>

    <section class="zmh-hero zmh-wrap" aria-labelledby="hero-title">
      <div class="zmh-hero-copy">
        <p class="zmh-eyebrow">STRONY WWW I SYSTEMY DLA FIRM</p>
        <h1 id="hero-title">Masz dobrą firmę.<br><em>Pokażmy ją z dobrej strony.</em></h1>
        <p class="zmh-lead">Projektuję strony WWW dla firm usługowych. Pomagam też uporządkować zapytania, sprzedaż i obsługę klientów.</p>
        <p class="zmh-service-line">Formularze · Sklepy i płatności · Systemy CRM</p>
        <div class="zmh-actions">
          <a class="zmh-pill" href="#opowiesc">Zobacz możliwości <span aria-hidden="true">↓</span></a>
          <a class="zmh-quiet" href="tel:+48450458466">Porozmawiajmy ↗</a>
        </div>
        <p class="zmh-trust-note">Od pierwszej rozmowy pracujesz bezpośrednio ze mną.<br> Gotową stronę oglądasz i zatwierdzasz przed publikacją.</p>
      </div>
      <div class="zmh-hero-foot">
        <span class="zmh-aside-note">TWÓJ POMYSŁ.<br>WSPÓLNY KIERUNEK.</span>
        <p>Dobry grunt<br>dla Twoich<br>pomysłów.</p>
      </div>
    </section>
  </div>

  <div id="opowiesc" class="zmh-assembly" data-zm-assembly>
    <div class="zmh-assembly-heading">
      <span>Z CHAOSU DO PORZĄDKU</span>
      <h2>Wszystko zaczyna<br>się <em>łączyć.</em></h2>
      <p>Strona. Zapytanie. Kolejny krok.<br>Przewiń i zobacz, jak tworzą całość.</p>
    </div>
    <div class="zmh-assembly-board" aria-label="Ilustracja połączenia strony, zapytania i obsługi klienta">
      <div class="zmh-assembly-lines" aria-hidden="true"><svg viewBox="0 0 600 400"><path d="M80 90 C300 90 150 310 350 310 S480 210 550 210"></path></svg></div>
      <div class="zmh-piece zmh-piece-web"><small>01 / TWOJA STRONA</small><strong>Dobra firma.<br>Dobry początek.</strong><div class="zmh-piece-photo"></div><span>Oferta · Kontakt ↗</span></div>
      <div class="zmh-piece-inquiry"><small>02 / ZAPYTANIE</small><b>Nowy kontakt <i>✓</i></b><span>Potrzeba · Termin · Szczegóły</span></div>
      <div class="zmh-piece-order"><small>03 / KOLEJNY KROK</small><b>Wszystko na swoim miejscu.</b><span>Zapytanie <i>→</i> Wycena <i>→</i> Realizacja</span></div>
      <span class="zmh-assembly-note">PRZYKŁADOWY PROCES DLA TWOJEJ FIRMY</span>
    </div>
  </div>

  <div class="zmh-cinema zmh-wrap">
    <div class="zmh-cinema-chapters">
      <section class="zmh-story" id="twoja-strona" aria-labelledby="strona-title"><div class="zmh-wrap zmh-split">
        <div class="zmh-copy"><p class="zmh-chapter">01 / TWOJA STRONA</p><h2 id="strona-title">Strona, na której<br>łatwo Cię zrozumieć.</h2><p>Klient widzi, co oferujesz, dla kogo pracujesz i jak się z Tobą skontaktować. Układam treść, zdjęcia i nawigację tak, żeby tworzyły spójną opowieść o Twojej firmie.</p><p class="zmh-callout">Wybieramy to, czego potrzebujesz.<br>Od samej strony po połączone z nią narzędzia.</p><a class="zmh-text-link" href="<?php echo esc_url(home_url('/oferta')); ?>">Co obejmuje strona WWW ↗</a></div>
        <div class="zmh-visual"><p class="zmh-caption">Przykładowa strona dla branży beauty · demonstracja</p><div class="zmh-website zmh-glass"><div class="zmh-mini-nav"><b>✳ Natura Studio</b><span>O nas  Oferta  Kontakt</span></div><div class="zmh-site-interior"><span>CHWILA DLA SIEBIE</span><h3>Spokojniej.<br>Bliżej siebie.</h3><p>Pielęgnacja. Relaks. Naturalne piękno.</p><span class="zmh-sample-button">Poznaj zabiegi ↗</span></div></div></div>
      </div></section>

      <section class="zmh-story" aria-labelledby="formularze-title"><div class="zmh-wrap zmh-split">
        <div class="zmh-copy"><p class="zmh-chapter">02 / FORMULARZE</p><h2 id="formularze-title">Mniej dopytywania.<br>Więcej konkretów.</h2><p>Usługa, preferowany termin, kilka zdań o potrzebie. Dobrze dobrany formularz pomaga klientowi opisać sprawę, a Tobie przygotować rozmowę lub wycenę.</p><span class="zmh-aside-note">WIĘCEJ MIEJSCA<br>NA DOBRĄ ROZMOWĘ.</span></div>
        <div class="zmh-visual zmh-form-visual"><div class="zmh-sample-form zmh-glass"><p class="zmh-caption">PRZYKŁADOWY FORMULARZ USŁUGOWY</p><h3>Zapytaj o usługę</h3><div><span>Usługa</span><span>Wybierz usługę ⌄</span></div><div><span>Termin</span><span>Preferowany termin ▦</span></div><div><span>Opis</span><span>Opisz krótko sprawę…</span></div><span class="zmh-sample-button">Wyślij zapytanie →</span></div></div>
      </div></section>

      <section class="zmh-story" aria-labelledby="sprzedaz-title"><div class="zmh-wrap zmh-split">
        <div class="zmh-copy"><p class="zmh-chapter">03 / SKLEP I PŁATNOŚCI</p><h2 id="sprzedaz-title">Twoja oferta sięga<br>dalej niż wizyta.</h2><p>Kosmetyk polecony po zabiegu. Voucher dla kogoś bliskiego. Produkt, po który klient chce wrócić. Łączę stronę ze sklepem i płatnościami online, żeby można było kupić go także z domu.</p><a class="zmh-text-link" href="<?php echo esc_url(home_url('/oferta#mini-sklep')); ?>">Co obejmuje sklep z płatnościami ↗</a></div>
        <div class="zmh-visual"><div class="zmh-commerce zmh-glass"><div class="zmh-voucher"><small>NATURA STUDIO</small><strong>Chwila<br>dla Ciebie.</strong><span>VOUCHER PODARUNKOWY</span></div><div class="zmh-commerce-copy"><p class="zmh-caption">PRZYKŁADOWY ZAKUP</p><h3>Pomysł<br>na prezent.</h3><p>Produkt → Koszyk → Płatność</p><small>Demonstracja zakupu vouchera.</small></div></div></div>
      </div></section>

      <section class="zmh-story" aria-labelledby="crm-title"><div class="zmh-wrap zmh-split">
        <div class="zmh-copy"><p class="zmh-chapter">04 / CRM I OBSŁUGA ZLECEŃ</p><h2 id="crm-title">Zapytanie przyszło.<br>Wiadomo, co dalej.</h2><p>Gdy ustalenia mają swoje miejsce, łatwiej zaplanować dzień. CRM to system, w którym łączę kontakty, wyceny, terminy i statusy zleceń. Wiesz, komu odpowiedzieć i co jest już zrobione.</p><a class="zmh-text-link" href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">Zobacz, jak działa CRM ↗</a></div>
        <div class="zmh-visual"><div class="zmh-flow zmh-glass"><div class="zmh-active zmh-flow-item"><span>✉</span><b>Nowe zapytanie</b></div><i>→</i><div class="zmh-flow-item"><span>▤</span><b>Wycena</b></div><i>→</i><div class="zmh-flow-item"><span>✓</span><b>Realizacja</b></div></div><p class="zmh-caption zmh-bottom-caption">Przykładowy przebieg obsługi w systemie.</p></div>
      </div></section>

      <section class="zmh-story zmh-relationships" aria-labelledby="relacje-title"><div class="zmh-wrap zmh-split">
        <div class="zmh-copy"><p class="zmh-chapter">05 / KONTAKT PO USŁUDZE</p><h2 id="relacje-title">Dobre relacje<br>warto pielęgnować.</h2><p>Po wykonanej usłudze zostaje miejsce na pytanie, czy wszystko w porządku, prośbę o opinię albo przypomnienie o kolejnym terminie. Pomagam zaplanować taki kontakt i połączyć go z obsługą zleceń.</p></div>
        <div class="zmh-visual"><div class="zmh-flow zmh-glass"><div class="zmh-active zmh-flow-item"><span>✓</span><b>Zakończenie</b></div><i>→</i><div class="zmh-flow-item"><span>☏</span><b>Kontakt po usłudze</b></div><i>→</i><div class="zmh-flow-item"><span>▦</span><b>Kolejny krok</b></div></div><p class="zmh-caption zmh-bottom-caption">Przykład opieki nad klientem po realizacji.</p></div>
      </div></section>
    </div>

    <div class="zmh-motion-intro zmh-wrap">
      <p>Przewijaj, aby zobaczyć, jak łączą się kolejne etapy.</p>
      <button type="button" data-zm-motion-toggle aria-pressed="false">Ogranicz ruch</button>
    </div>
    <aside class="zmh-cinema-stage" aria-hidden="true">
      <div class="zmh-cinema-screen">
        <div class="zmh-cinema-status"><span>STRONA · PROCES · RELACJA</span><span class="cinema-counter">01 / 05</span></div>
        <div class="zmh-cinema-shots"></div>
        <div class="zmh-cinema-rail"><span></span></div>
        <div class="zmh-cinema-dots"><i></i><i></i><i></i><i></i><i></i></div>
      </div>
    </aside>
  </div>
</div>

<div class="zmh-lower-forest">
  <section class="zmh-portfolio zmh-wrap" id="projekty" aria-labelledby="projekty-title">
    <div class="zmh-section-heading"><div><p class="zmh-eyebrow">PROJEKTY DEMONSTRACYJNE</p><h2 id="projekty-title">Zobacz, zanim zdecydujesz.</h2></div><a class="zmh-pill zmh-outline" href="<?php echo esc_url(home_url('/realizacje')); ?>">Obejrzyj projekty ↗</a></div>
    <p class="zmh-intro">Sprawdź, jak strona pomaga wybrać usługę, zaplanować wizytę albo znaleźć mieszkanie. Każdy przykład odpowiada na inną potrzebę.</p>
    <div class="zmh-projects">
      <a class="zmh-project zmh-glass" href="<?php echo esc_url(home_url('/demo/natura-strona')); ?>"><img src="https://zielona-marka.pl/concept-natura.jpg" width="600" height="400" loading="lazy" alt="Wnętrze demonstracyjnego studia wellness"><div><small>DEMONSTRACJA / BEAUTY</small><h3>Natura Studio</h3><p>Wybór zabiegu zaczyna się od jasnego opisu. Strona pokazuje usługi, ceny i drogę do umówienia wizyty.</p><span>Obejrzyj stronę studia ↗</span></div></a>
      <a class="zmh-project zmh-glass zmh-bistro" href="<?php echo esc_url(home_url('/demo/bistro-strona')); ?>"><img src="https://zielona-marka.pl/concept-bistro.jpg" width="600" height="400" loading="lazy" alt="Wnętrze demonstracyjnej restauracji"><div><small>DEMONSTRACJA / GASTRONOMIA</small><h3>Bistro Forma</h3><p>Gość chce poczuć klimat miejsca i zaplanować wizytę. Strona łączy menu z informacją o rezerwacji.</p><span>Obejrzyj stronę restauracji ↗</span></div></a>
    </div>
    <div class="zmh-more-projects"><a href="<?php echo esc_url(home_url('/demo/dom-strona')); ?>">Dom Dobry / mieszkania i dostępność ↗</a><a href="<?php echo esc_url(home_url('/realizacje/transportflow')); ?>">TransportFlow / panel operacyjny ↗</a></div>
    <p class="zmh-caption">Autorskie demonstracje możliwości. Nie są realizacjami dla klientów.</p>
  </section>

  <section class="zmh-process zmh-wrap" id="proces" aria-labelledby="proces-title">
    <p class="zmh-chapter">WSPÓŁPRACA Z ZIELONĄ MARKĄ</p>
    <h2 id="proces-title">Spokojny proces.<br>Wspólny kierunek.</h2>
    <p>Mam na imię Łukasz. Tworzę strony i proste narzędzia, które ułatwiają kontakt z klientami i codzienną pracę firmy. Zaczynam od rozmowy o tym, czego potrzebujesz, a potem proponuję rozwiązanie i zakres prac. Rozmawiasz bezpośrednio ze mną i wiesz, co przygotowujemy oraz co będziesz zatwierdzać.</p>
    <figure class="zmh-founder-photo"><img src="https://zielona-marka.pl/lukasz-zielona-marka-strona-glowna-20260908.webp" width="1000" height="563" loading="lazy" alt="Łukasz podczas konsultacji projektu"><figcaption>Rozmawiasz bezpośrednio ze mną, od pomysłu po gotową stronę.</figcaption></figure>
    <ol class="zmh-care-steps"><li><span>01</span><h3>Ustalamy zakres</h3><p>Wybieramy potrzebne funkcje i uzgadniamy zakres przed rozpoczęciem prac.</p></li><li><span>02</span><h3>Przygotowuję projekt</h3><p>Układam treści, wygląd i narzędzia. Ty oglądasz gotową propozycję.</p></li><li><span>03</span><h3>Ty zatwierdzasz</h3><p>Sprawdzam działanie strony. Publikacja następuje po Twojej akceptacji.</p></li></ol>
    <a class="zmh-text-link" href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Przeczytaj zasady współpracy ↗</a>
  </section>

  <section class="zmh-story zmh-grow" aria-labelledby="rozwoj-title"><div class="zmh-wrap zmh-split">
    <div class="zmh-copy"><p class="zmh-chapter">PO PUBLIKACJI / OPIEKA NAD STRONĄ</p><h2 id="rozwoj-title">Rozwój w rytmie<br>Twojej firmy.</h2><p>Nowa usługa, pomysł na sprzedaż, wygodniejszy sposób obsługi. Stronę można rozbudować, gdy pojawi się taka potrzeba. Dalszą opiekę i nowe funkcje ustalamy osobno, w zakresie dopasowanym do Twojej firmy.</p></div>
    <div class="zmh-growth-words"><span>Opieka</span><span>Usprawnienia</span><span>Rozwój</span></div>
  </div></section>

  <section class="zmh-contact zmh-wrap" id="kontakt" aria-labelledby="kontakt-title">
    <div class="zmh-water-portal" data-zm-water-portal>
      <div class="zmh-water-orbit" aria-hidden="true"><div class="zmh-water-drop"><video data-zm-water-video muted loop playsinline preload="none"></video><span></span></div><i></i><i></i></div>
      <p>Dobry pomysł.<br><em>Niech płynie dalej.</em></p>
      <button type="button" data-zm-water-control aria-pressed="false">Zatrzymaj wodę Ⅱ</button>
    </div>
    <div>
      <p class="zmh-eyebrow">ZACZNIJMY OD ROZMOWY</p>
      <h2 id="kontakt-title">Zróbmy miejsce<br>na <em>dobrą zmianę.</em></h2>
      <p>Opowiedz, czym zajmuje się Twoja firma i co chcesz ułatwić sobie lub klientom. Wystarczy kilka zdań. Pomogę Ci wybrać kierunek i ustalić, od czego warto zacząć.</p>
      <a class="zmh-pill" href="tel:+48450458466">Porozmawiajmy ↗</a>
      <a class="zmh-phone" href="tel:+48450458466">+48 450 458 466</a>
      <details class="zmh-contact-draft">
        <summary>Wolisz napisać? Opisz swoją sprawę <span aria-hidden="true">+</span></summary>
        <div class="zmh-form-surface">
          <h3>Kilka zdań na dobry początek.</h3>
          <p>Opisz swoją firmę i to, co chcesz zmienić. Szczegóły możemy ustalić w rozmowie.</p>
          <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
            <input type="hidden" name="action" value="zm_send_brief">
            <?php wp_nonce_field('zm_send_brief', 'zm_brief_nonce'); ?>
            <div class="zmh-field-grid">
              <label>Imię<input required name="name" autocomplete="name" placeholder="Jak masz na imię?"></label>
              <label>E-mail<input required name="email" type="email" autocomplete="email" placeholder="twoj@email.pl"></label>
            </div>
            <label>Co chcesz ułatwić w swojej firmie?<textarea required name="message" rows="5" placeholder="Np. chcę lepiej pokazać usługi, sprzedawać vouchery albo uporządkować zapytania."></textarea></label>
            <details class="zmh-extra-fields"><summary>Dodaj szczegóły, jeśli chcesz <span aria-hidden="true">+</span></summary>
              <div class="zmh-field-grid">
                <label>Telefon <span>(opcjonalnie)</span><input name="phone" type="tel" autocomplete="tel"></label>
                <label>Firma <span>(opcjonalnie)</span><input name="company" autocomplete="organization"></label>
                <label>Obecna strona <span>(opcjonalnie)</span><input name="website" type="url" placeholder="https://"></label>
                <label>Obszar <span>(opcjonalnie)</span><select name="projectType"><option value="">Wybierz, jeśli wiesz</option><option>Strona WWW</option><option>Formularze i zapytania</option><option>CRM i obsługa klientów</option><option>Sklep i płatności</option><option>Kilka z tych rzeczy</option><option>Chcę najpierw porozmawiać</option></select></label>
                <label>Planowany termin <span>(opcjonalnie)</span><input name="timeline" placeholder="Np. w ciągu 2 miesięcy"></label>
                <label>Orientacyjny budżet <span>(opcjonalnie)</span><select name="budget"><option value="">Wolę najpierw poznać zakres</option><option>do 3 000 zł</option><option>3 000-6 000 zł</option><option>6 000-12 000 zł</option><option>powyżej 12 000 zł</option></select></label>
              </div>
            </details>
            <label class="zmh-privacy-check"><input required type="checkbox" name="consent" value="yes"><span>Zapoznałem/-am się z <a href="<?php echo esc_url(home_url('/polityka-prywatnosci')); ?>">polityką prywatności</a> i proszę o kontakt.</span></label>
            <button class="zmh-pill" type="submit">Wyślij wiadomość ↗</button>
          </form>
        </div>
      </details>
    </div>
  </section>

  <footer class="zm-footer">
    <div class="zm-footer-inner">
      <div class="zm-footer-brand">
        <a href="<?php echo esc_url(home_url('/')); ?>"><span class="brand-signature" role="img" aria-label="Zielona Marka"><img class="brand-apple" src="https://zielona-marka.pl/logo-fern-automation-white.svg" width="96" height="98" alt=""><span class="brand-wordmark"><b>ZIELONA</b><b>MARKA</b><small>STRONY WWW I SYSTEMY DLA FIRM</small></span></span></a>
        <p>Strony WWW i systemy dla firm.<br>Warszawa, Targówek i okolice. Zdalnie w całej Polsce.</p>
      </div>
      <div><h2>Poznaj ofertę</h2><a href="<?php echo esc_url(home_url('/oferta')); ?>">Oferta</a><a href="<?php echo esc_url(home_url('/realizacje')); ?>">Projekty</a><a href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Współpraca</a><a href="<?php echo esc_url(home_url('/status')); ?>">Strefa klienta</a></div>
      <div><h2>Porozmawiajmy</h2><a href="tel:+48450458466">+48 450 458 466</a><a href="mailto:kontakt@zielona-marka.pl">kontakt@zielona-marka.pl</a><a href="https://www.facebook.com/zielonamarka" target="_blank" rel="noreferrer">Facebook ↗</a><a href="https://www.instagram.com/zielona.marka.pl/" target="_blank" rel="noreferrer">Instagram ↗</a><a href="https://github.com/lukaszst-cz" target="_blank" rel="noreferrer">GitHub ↗</a></div>
      <div class="zm-footer-bottom"><small>© <?php echo esc_html(wp_date('Y')); ?> Zielona Marka</small><a href="<?php echo esc_url(home_url('/polityka-prywatnosci')); ?>">Polityka prywatności</a><a href="<?php echo esc_url(home_url('/en')); ?>">English</a></div>
    </div>
  </footer>
</div>

<div class="demo-assistant" data-demo-assistant>
  <button class="demo-assistant-trigger" type="button" data-demo-toggle aria-label="Wypróbuj asystenta" aria-expanded="false" aria-controls="demo-assistant-panel"><span aria-hidden="true">✦</span><b>Wypróbuj asystenta</b><small>demonstracja ZM</small></button>
  <section class="demo-assistant-panel" id="demo-assistant-panel" role="dialog" aria-label="Demonstracyjny asystent zapytań Zielonej Marki" hidden>
    <header><div><span>DEMO · ZIELONA MARKA</span><b>Asystent zapytań</b></div><button type="button" data-demo-close aria-label="Zamknij asystenta">×</button></header>
    <div class="demo-assistant-body" aria-live="polite">
      <div class="bot-message"><b>Cześć!</b><p>Jestem demonstracyjnym asystentem działającym według przygotowanego scenariusza. Pomogę określić, czego potrzebuje Twoja firma.</p><small>Nie udaję człowieka i nie podaję wiążącej wyceny.</small></div>
      <div class="assistant-step" data-demo-step="goal"><p>Co chcesz poprawić?</p><div class="assistant-options"><button type="button" data-demo-goal="Nowa strona">Nowa strona</button><button type="button" data-demo-goal="Modernizacja strony">Modernizacja strony</button><button type="button" data-demo-goal="Formularz wyceny">Formularz wyceny</button><button type="button" data-demo-goal="Mały CRM">Mały CRM</button><button type="button" data-demo-goal="Asystent zapytań">Asystent zapytań</button><button type="button" data-demo-goal="Ceny i terminy">Ceny i terminy</button></div></div>
      <div class="assistant-step" data-demo-step="industry" hidden><div class="user-message" data-demo-goal-label></div><p>W jakiej branży działasz?</p><div class="assistant-options"><button type="button" data-demo-industry="Warsztat / detailing">Warsztat / detailing</button><button type="button" data-demo-industry="Remonty / instalacje">Remonty / instalacje</button><button type="button" data-demo-industry="Beauty / wizyty">Beauty / wizyty</button><button type="button" data-demo-industry="Inna firma usługowa">Inna firma usługowa</button></div><button class="assistant-back" type="button" data-demo-back="goal">← Wróć</button></div>
      <div class="assistant-step" data-demo-step="form" hidden><div class="user-message" data-demo-industry-label></div><p>Zostaw kontakt. Zgłoszenie trafi do Zielonej Marki.</p>
        <form class="assistant-lead-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
          <input type="hidden" name="action" value="zm_send_brief"><?php wp_nonce_field('zm_send_brief', 'zm_brief_nonce'); ?>
          <input type="hidden" name="assistantGoal" data-demo-goal-input><input type="hidden" name="assistantIndustry" data-demo-industry-input>
          <label>Imię<input name="name" required autocomplete="name"></label><label>E-mail<input name="email" required type="email" autocomplete="email"></label><label>Firma <span>(opcjonalnie)</span><input name="company" autocomplete="organization"></label><label>Telefon <span>(opcjonalnie)</span><input name="phone" type="tel" autocomplete="tel"></label>
          <label class="assistant-form-wide">Co jest dziś największym problemem?<textarea name="message" rows="3"></textarea></label>
          <label class="assistant-consent assistant-form-wide"><input type="checkbox" name="consent" value="yes" required><span>Akceptuję <a href="<?php echo esc_url(home_url('/polityka-prywatnosci')); ?>">politykę prywatności</a> i proszę o kontakt.</span></label>
          <button class="button assistant-form-wide" type="submit">Wyślij zgłoszenie<span>↗</span></button>
        </form><button class="assistant-back" type="button" data-demo-back="industry">← Zmień branżę</button>
      </div>
      <div class="assistant-demo-links"><a href="<?php echo esc_url(home_url('/strony-dla-warsztatow')); ?>">Demo dla warsztatu</a><a href="<?php echo esc_url(home_url('/strony-dla-firm-uslugowych')); ?>">Demo dla wykonawcy</a><a href="<?php echo esc_url(home_url('/strony-dla-beauty')); ?>">Demo beauty</a></div>
    </div>
    <footer>To demonstracja scenariusza. Wdrożenie wymaga zatwierdzonej bazy wiedzy i kontaktu z człowiekiem.</footer>
  </section>
</div>

<a class="whatsapp-float" href="https://wa.me/48603806833?text=Dzień%20dobry%2C%20chcę%20porozmawiać%20o%20stronie%20dla%20mojej%20firmy." target="_blank" rel="noreferrer" aria-label="Napisz do Zielonej Marki na WhatsAppie"><span aria-hidden="true">◌</span><b>Napisz na WhatsApp</b><small>Szybka wiadomość</small><i aria-hidden="true">↗</i></a>

</main>
<?php wp_footer(); ?>
</body>
</html>