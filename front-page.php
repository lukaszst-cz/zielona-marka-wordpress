<?php
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<button class="motion-toggle" type="button" data-motion-toggle aria-pressed="false"><span aria-hidden="true">Ⅱ</span><span>Zatrzymaj tło</span></button>
<main id="main-content" class="live-home">
  <section class="live-hero section-dark">
    <div class="live-shell live-hero-grid">
      <div class="live-hero-copy">
        <p class="live-kicker">STRONY WWW I SYSTEMY DLA FIRM</p>
        <h1>Masz dobrą firmę.<br><em>Pokażmy ją z dobrej strony.</em></h1>
        <p class="live-lead">Projektuję strony WWW dla firm usługowych. Pomagam też uporządkować zapytania, sprzedaż i obsługę klientów.</p>
        <p class="live-links"><a href="#formularze">Formularze</a> · <a href="#sklep">Sklepy i płatności</a> · <a href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">Systemy CRM</a></p>
        <div class="live-actions">
          <a class="live-button live-button-light" href="#mozliwosci">Zobacz możliwości ↓</a>
          <a class="live-text-link" href="#kontakt">Porozmawiajmy ↗</a>
        </div>
        <div class="live-proof">
          <span>Od pierwszej rozmowy pracujesz bezpośrednio ze mną.</span>
          <span>Gotową stronę oglądasz i zatwierdzasz przed publikacją.</span>
        </div>
      </div>
      <div class="live-hero-art" aria-hidden="true">
        <span>TWÓJ POMYSŁ.</span>
        <b>WSPÓLNY KIERUNEK.</b>
        <strong>Dobry grunt<br>dla Twoich<br>pomysłów.</strong>
      </div>
    </div>
  </section>

  <section class="live-intro section-light" id="mozliwosci">
    <div class="live-shell">
      <p class="live-kicker dark">Z CHAOSU DO PORZĄDKU</p>
      <h2>Wszystko zaczyna<br>się łączyć.</h2>
      <div class="live-intro-grid">
        <div>
          <p class="live-lead dark">Strona. Zapytanie. Kolejny krok.</p>
          <p>Przewiń i zobacz, jak tworzą całość.</p>
        </div>
        <div class="live-process-preview">
          <article><span>01 / TWOJA STRONA</span><b>Dobra firma.<br>Dobry początek.</b><small>Oferta · Kontakt ↗</small></article>
          <article><span>02 / ZAPYTANIE</span><b>Nowy kontakt ✓</b><small>Potrzeba · Termin · Szczegóły</small></article>
          <article><span>03 / KOLEJNY KROK</span><b>Wszystko na swoim miejscu.</b><small>Zapytanie → Wycena → Realizacja</small></article>
        </div>
      </div>
    </div>
  </section>

  <section class="live-story" aria-label="Przykładowy proces dla Twojej firmy">
    <article class="live-story-row section-sage">
      <div class="live-shell live-two-col">
        <div>
          <p class="live-step">01 / TWOJA STRONA</p>
          <h2>Strona, na której<br>łatwo Cię zrozumieć.</h2>
          <p>Klient widzi, co oferujesz, dla kogo pracujesz i jak się z Tobą skontaktować. Układam treść, zdjęcia i nawigację tak, żeby tworzyły spójną opowieść o Twojej firmie.</p>
          <p><strong>Wybieramy to, czego potrzebujesz.</strong><br>Od samej strony po połączone z nią narzędzia.</p>
          <a class="live-text-link dark" href="<?php echo esc_url(home_url('/oferta')); ?>">Co obejmuje strona WWW ↗</a>
        </div>
        <div class="live-demo-card beauty-demo">
          <small>Przykładowa strona dla branży beauty · demonstracja</small>
          <div class="demo-nav"><b>✳ Natura Studio</b><span>O nas</span><span>Oferta</span><span>Kontakt</span></div>
          <p>CHWILA DLA SIEBIE</p>
          <h3>Spokojniej.<br>Bliżej siebie.</h3>
          <p>Pielęgnacja. Relaks. Naturalne piękno.</p>
          <a href="<?php echo esc_url(home_url('/demo/natura-strona')); ?>">Poznaj zabiegi ↗</a>
        </div>
      </div>
    </article>

    <article class="live-story-row section-cream" id="formularze">
      <div class="live-shell live-two-col reverse">
        <div>
          <p class="live-step">02 / FORMULARZE</p>
          <h2>Mniej dopytywania.<br>Więcej konkretów.</h2>
          <p>Usługa, preferowany termin, kilka zdań o potrzebie. Dobrze dobrany formularz pomaga klientowi opisać sprawę, a Tobie przygotować rozmowę lub wycenę.</p>
          <p class="live-quote">WIĘCEJ MIEJSCA<br>NA DOBRĄ ROZMOWĘ.</p>
        </div>
        <div class="live-demo-card form-demo">
          <small>PRZYKŁADOWY FORMULARZ USŁUGOWY</small>
          <h3>Zapytaj o usługę</h3>
          <label>Usługa<select><option>Wybierz usługę</option></select></label>
          <label>Termin<input type="text" placeholder="Preferowany termin"></label>
          <label>Opis<textarea rows="4" placeholder="Opisz krótko sprawę…"></textarea></label>
          <button type="button">Wyślij zapytanie →</button>
        </div>
      </div>
    </article>

    <article class="live-story-row section-pink" id="sklep">
      <div class="live-shell live-two-col">
        <div>
          <p class="live-step">03 / SKLEP I PŁATNOŚCI</p>
          <h2>Twoja oferta sięga<br>dalej niż wizyta.</h2>
          <p>Kosmetyk polecony po zabiegu. Voucher dla kogoś bliskiego. Produkt, po który klient chce wrócić. Łączę stronę ze sklepem i płatnościami online, żeby można było kupić go także z domu.</p>
          <a class="live-text-link dark" href="<?php echo esc_url(home_url('/oferta#mini-sklep')); ?>">Co obejmuje sklep z płatnościami ↗</a>
        </div>
        <div class="live-demo-card voucher-demo">
          <small>NATURA STUDIO</small>
          <p>Chwila<br>dla Ciebie.</p>
          <b>VOUCHER PODARUNKOWY</b>
          <h3>Pomysł<br>na prezent.</h3>
          <p>Produkt → Koszyk → Płatność</p>
          <small>Demonstracja zakupu vouchera.</small>
        </div>
      </div>
    </article>

    <article class="live-story-row section-darkgreen">
      <div class="live-shell live-two-col reverse">
        <div>
          <p class="live-step">04 / CRM I OBSŁUGA ZLECEŃ</p>
          <h2>Zapytanie przyszło.<br>Wiadomo, co dalej.</h2>
          <p>Gdy ustalenia mają swoje miejsce, łatwiej zaplanować dzień. CRM to system, w którym łączę kontakty, wyceny, terminy i statusy zleceń. Wiesz, komu odpowiedzieć i co jest już zrobione.</p>
          <a class="live-text-link" href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">Zobacz, jak działa CRM ↗</a>
        </div>
        <div class="live-demo-card crm-demo">
          <div><b>✉ Nowe zapytanie</b><span>→</span><b>▤ Wycena</b><span>→</span><b>✓ Realizacja</b></div>
          <small>Przykładowy przebieg obsługi w systemie.</small>
        </div>
      </div>
    </article>

    <article class="live-story-row section-sage">
      <div class="live-shell live-two-col">
        <div>
          <p class="live-step">05 / KONTAKT PO USŁUDZE</p>
          <h2>Dobre relacje<br>warto pielęgnować.</h2>
          <p>Po wykonanej usłudze zostaje miejsce na pytanie, czy wszystko w porządku, prośbę o opinię albo przypomnienie o kolejnym terminie. Pomagam zaplanować taki kontakt i połączyć go z obsługą zleceń.</p>
        </div>
        <div class="live-demo-card aftercare-demo">
          <div><b>✓ Zakończenie</b><span>→</span><b>☏ Kontakt po usłudze</b><span>→</span><b>▦ Kolejny krok</b></div>
          <small>Przykład opieki nad klientem po realizacji.</small>
        </div>
      </div>
    </article>
  </section>

  <section class="live-projects section-light">
    <div class="live-shell">
      <div class="live-section-head">
        <div><p class="live-kicker dark">PROJEKTY DEMONSTRACYJNE</p><h2>Zobacz, zanim zdecydujesz.</h2></div>
        <a class="live-text-link dark" href="<?php echo esc_url(home_url('/realizacje')); ?>">Obejrzyj projekty ↗</a>
      </div>
      <p class="live-lead dark">Sprawdź, jak strona pomaga wybrać usługę, zaplanować wizytę albo znaleźć mieszkanie. Każdy przykład odpowiada na inną potrzebę.</p>
      <div class="live-project-grid">
        <a href="<?php echo esc_url(home_url('/demo/natura-strona')); ?>"><small>DEMONSTRACJA / BEAUTY</small><h3>Natura Studio</h3><p>Wybór zabiegu zaczyna się od jasnego opisu. Strona pokazuje usługi, ceny i drogę do umówienia wizyty.</p><b>Obejrzyj stronę studia ↗</b></a>
        <a href="<?php echo esc_url(home_url('/demo/bistro-strona')); ?>"><small>DEMONSTRACJA / GASTRONOMIA</small><h3>Bistro Forma</h3><p>Gość chce poczuć klimat miejsca i zaplanować wizytę. Strona łączy menu z informacją o rezerwacji.</p><b>Obejrzyj stronę restauracji ↗</b></a>
        <a href="<?php echo esc_url(home_url('/demo/dom-strona')); ?>"><small>DEMONSTRACJA / NIERUCHOMOŚCI</small><h3>Dom Dobry</h3><p>Mieszkania i dostępność pokazane w prostym układzie.</p><b>Obejrzyj projekt ↗</b></a>
        <a href="<?php echo esc_url(home_url('/realizacje/transportflow')); ?>"><small>DEMONSTRACJA / TRANSPORT</small><h3>RouteFlow</h3><p>Strona firmy transportowej połączona z uporządkowaną ścieżką kontaktu.</p><b>Obejrzyj projekt ↗</b></a>
      </div>
      <p class="live-disclaimer">Autorskie demonstracje możliwości. Nie są realizacjami dla klientów.</p>
    </div>
  </section>

  <section class="live-about section-cream">
    <div class="live-shell live-two-col">
      <div>
        <p class="live-kicker dark">WSPÓŁPRACA Z ZIELONĄ MARKĄ</p>
        <h2>Spokojny proces.<br>Wspólny kierunek.</h2>
        <p>Mam na imię Łukasz. Tworzę strony i proste narzędzia, które ułatwiają kontakt z klientami i codzienną pracę firmy. Zaczynam od rozmowy o tym, czego potrzebujesz, a potem proponuję rozwiązanie i zakres prac. Rozmawiasz bezpośrednio ze mną i wiesz, co przygotowujemy oraz co będziesz zatwierdzać.</p>
        <a class="live-text-link dark" href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Przeczytaj zasady współpracy ↗</a>
      </div>
      <ol class="live-steps-list">
        <li><span>01</span><div><h3>Ustalamy zakres</h3><p>Wybieramy potrzebne funkcje i uzgadniamy zakres przed rozpoczęciem prac.</p></div></li>
        <li><span>02</span><div><h3>Przygotowuję projekt</h3><p>Układam treści, wygląd i narzędzia. Ty oglądasz gotową propozycję.</p></div></li>
        <li><span>03</span><div><h3>Ty zatwierdzasz</h3><p>Sprawdzam działanie strony. Publikacja następuje po Twojej akceptacji.</p></div></li>
      </ol>
    </div>
  </section>

  <section class="live-care section-dark">
    <div class="live-shell live-two-col">
      <div>
        <p class="live-kicker">PO PUBLIKACJI / OPIEKA NAD STRONĄ</p>
        <h2>Rozwój w rytmie<br>Twojej firmy.</h2>
      </div>
      <div>
        <p>Nowa usługa, pomysł na sprzedaż, wygodniejszy sposób obsługi. Stronę można rozbudować, gdy pojawi się taka potrzeba. Dalszą opiekę i nowe funkcje ustalamy osobno, w zakresie dopasowanym do Twojej firmy.</p>
        <div class="live-chip-row"><a href="<?php echo esc_url(home_url('/oferta')); ?>">Opieka ↗</a><a href="<?php echo esc_url(home_url('/usprawnienia-firmy')); ?>">Usprawnienia ↗</a><a href="<?php echo esc_url(home_url('/usprawnienia-firmy')); ?>">Rozwój ↗</a></div>
      </div>
    </div>
  </section>

  <section class="live-contact section-light" id="kontakt">
    <div class="live-shell">
      <div class="live-contact-head">
        <div>
          <p class="live-kicker dark">ZACZNIJMY OD ROZMOWY</p>
          <h2>Zróbmy miejsce<br>na dobrą zmianę.</h2>
          <p>Opowiedz, czym zajmuje się Twoja firma i co chcesz ułatwić sobie lub klientom. Wystarczy kilka zdań. Pomogę Ci wybrać kierunek i ustalić, od czego warto zacząć.</p>
          <p><a class="live-button" href="tel:+48450458466">Porozmawiajmy ↗</a> <strong>+48 450 458 466</strong></p>
        </div>
        <div class="live-contact-box">
          <h3>Kilka zdań na dobry początek.</h3>
          <p>Opisz swoją firmę i to, co chcesz zmienić. Szczegóły możemy ustalić w rozmowie.</p>
          <?php zm_render_contact_form(false); ?>
        </div>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
