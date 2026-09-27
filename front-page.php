<?php
if (!defined('ABSPATH')) { exit; }
get_header();
$brief_status = sanitize_key(wp_unslash($_GET['brief'] ?? ''));
?>
<main id="main-content" class="live-home">

  <button class="motion-toggle" type="button" data-motion-toggle aria-pressed="false">
    <span aria-hidden="true">Ⅱ</span><span>Zatrzymaj tło</span>
  </button>

  <section class="live-hero">
    <div class="live-hero-bg" aria-hidden="true"></div>
    <div class="shell live-hero-grid">
      <div class="live-hero-copy">
        <span class="live-kicker">STRONY WWW I SYSTEMY DLA FIRM</span>
        <h1>Masz dobrą firmę.<br><em>Pokażmy ją z dobrej strony.</em></h1>
        <p>Projektuję strony WWW dla firm usługowych. Pomagam też uporządkować zapytania, sprzedaż i obsługę klientów.</p>
        <div class="live-topic-links">
          <a href="#formularze">Formularze</a><span>·</span>
          <a href="<?php echo esc_url(home_url('/oferta#mini-sklep')); ?>">Sklepy i płatności</a><span>·</span>
          <a href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">Systemy CRM</a>
        </div>
        <div class="live-hero-actions">
          <a class="live-button" href="#mozliwosci">Zobacz możliwości <span>↓</span></a>
          <a class="live-text-link" href="#kontakt">Porozmawiajmy <span>↗</span></a>
        </div>
        <div class="live-hero-notes">
          <span>Od pierwszej rozmowy pracujesz bezpośrednio ze mną.</span>
          <span>Gotową stronę oglądasz i zatwierdzasz przed publikacją.</span>
        </div>
      </div>

      <div class="live-hero-mark" aria-hidden="true">
        <span>TWÓJ POMYSŁ.</span>
        <b>WSPÓLNY KIERUNEK.</b>
        <div class="live-hero-statement">Dobry grunt<br>dla Twoich<br><em>pomysłów.</em></div>
      </div>
    </div>
  </section>

  <section class="live-connect" id="mozliwosci">
    <div class="shell">
      <span class="live-kicker">Z CHAOSU DO PORZĄDKU</span>
      <div class="live-section-intro">
        <h2>Wszystko zaczyna<br><em>się łączyć.</em></h2>
        <p>Strona. Zapytanie. Kolejny krok.<br>Przewiń i zobacz, jak tworzą całość.</p>
      </div>

      <div class="live-process-overview" aria-label="Przykładowy proces dla Twojej firmy">
        <article>
          <span>01 / TWOJA STRONA</span>
          <h3>Dobra firma.<br>Dobry początek.</h3>
          <a href="<?php echo esc_url(home_url('/oferta')); ?>">Oferta · Kontakt ↗</a>
        </article>
        <article>
          <span>02 / ZAPYTANIE</span>
          <div class="live-demo-notice"><b>Nowy kontakt</b><i>✓</i></div>
          <p>Potrzeba · Termin · Szczegóły</p>
        </article>
        <article>
          <span>03 / KOLEJNY KROK</span>
          <h3>Wszystko na swoim miejscu.</h3>
          <p>Zapytanie → Wycena → Realizacja</p>
        </article>
      </div>
      <p class="live-caption">PRZYKŁADOWY PROCES DLA TWOJEJ FIRMY</p>
    </div>
  </section>

  <section class="live-step live-step-website">
    <div class="shell live-step-grid">
      <div class="live-step-copy">
        <span class="live-step-no">01 / TWOJA STRONA</span>
        <h2>Strona, na której<br><em>łatwo Cię zrozumieć.</em></h2>
        <p>Klient widzi, co oferujesz, dla kogo pracujesz i jak się z Tobą skontaktować. Układam treść, zdjęcia i nawigację tak, żeby tworzyły spójną opowieść o Twojej firmie.</p>
        <div class="live-step-note"><b>Wybieramy to, czego potrzebujesz.</b><span>Od samej strony po połączone z nią narzędzia.</span></div>
        <a class="live-arrow-link" href="<?php echo esc_url(home_url('/oferta')); ?>">Co obejmuje strona WWW ↗</a>
      </div>
      <div class="live-demo-window natura-demo">
        <small>Przykładowa strona dla branży beauty · demonstracja</small>
        <div class="demo-browser">
          <header><b>✳ Natura Studio</b><nav>O nas&nbsp;&nbsp; Oferta&nbsp;&nbsp; Kontakt</nav></header>
          <div class="demo-browser-body">
            <span>CHWILA DLA SIEBIE</span>
            <h3>Spokojniej.<br><em>Bliżej siebie.</em></h3>
            <p>Pielęgnacja. Relaks. Naturalne piękno.</p>
            <a href="<?php echo esc_url(home_url('/demo/natura-strona')); ?>">Poznaj zabiegi ↗</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="live-step live-step-form" id="formularze">
    <div class="shell live-step-grid live-step-reverse">
      <div class="live-step-copy">
        <span class="live-step-no">02 / FORMULARZE</span>
        <h2>Mniej dopytywania.<br><em>Więcej konkretów.</em></h2>
        <p>Usługa, preferowany termin, kilka zdań o potrzebie. Dobrze dobrany formularz pomaga klientowi opisać sprawę, a Tobie przygotować rozmowę lub wycenę.</p>
        <blockquote>WIĘCEJ MIEJSCA<br>NA DOBRĄ ROZMOWĘ.</blockquote>
      </div>
      <div class="live-form-demo">
        <small>PRZYKŁADOWY FORMULARZ USŁUGOWY</small>
        <div class="live-form-card">
          <h3>Zapytaj o usługę</h3>
          <label>Usługa<select disabled><option>Wybierz usługę</option></select></label>
          <label>Termin<input disabled placeholder="Preferowany termin"></label>
          <label>Opis<textarea disabled placeholder="Opisz krótko sprawę…"></textarea></label>
          <button type="button" disabled>Wyślij zapytanie →</button>
        </div>
      </div>
    </div>
  </section>

  <section class="live-step live-step-shop">
    <div class="shell live-step-grid">
      <div class="live-step-copy">
        <span class="live-step-no">03 / SKLEP I PŁATNOŚCI</span>
        <h2>Twoja oferta sięga<br><em>dalej niż wizyta.</em></h2>
        <p>Kosmetyk polecony po zabiegu. Voucher dla kogoś bliskiego. Produkt, po który klient chce wrócić. Łączę stronę ze sklepem i płatnościami online, żeby można było kupić go także z domu.</p>
        <a class="live-arrow-link" href="<?php echo esc_url(home_url('/oferta#mini-sklep')); ?>">Co obejmuje sklep z płatnościami ↗</a>
      </div>
      <div class="live-voucher-demo">
        <span>NATURA STUDIO</span>
        <h3>Chwila<br>dla Ciebie.</h3>
        <b>VOUCHER PODARUNKOWY</b>
        <div><small>PRZYKŁADOWY ZAKUP</small><strong>Pomysł<br>na prezent.</strong><p>Produkt → Koszyk → Płatność</p><em>Demonstracja zakupu vouchera.</em></div>
      </div>
    </div>
  </section>

  <section class="live-step live-step-crm">
    <div class="shell live-step-grid live-step-reverse">
      <div class="live-step-copy">
        <span class="live-step-no">04 / CRM I OBSŁUGA ZLECEŃ</span>
        <h2>Zapytanie przyszło.<br><em>Wiadomo, co dalej.</em></h2>
        <p>Gdy ustalenia mają swoje miejsce, łatwiej zaplanować dzień. CRM to system, w którym łączę kontakty, wyceny, terminy i statusy zleceń. Wiesz, komu odpowiedzieć i co jest już zrobione.</p>
        <a class="live-arrow-link" href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">Zobacz, jak działa CRM ↗</a>
      </div>
      <div class="live-flow-demo" aria-label="Przykładowy przebieg obsługi w systemie">
        <span>✉<b>Nowe zapytanie</b></span><i>→</i>
        <span>▤<b>Wycena</b></span><i>→</i>
        <span>✓<b>Realizacja</b></span>
        <small>Przykładowy przebieg obsługi w systemie.</small>
      </div>
    </div>
  </section>

  <section class="live-step live-step-aftercare">
    <div class="shell live-step-grid">
      <div class="live-step-copy">
        <span class="live-step-no">05 / KONTAKT PO USŁUDZE</span>
        <h2>Dobre relacje<br><em>warto pielęgnować.</em></h2>
        <p>Po wykonanej usłudze zostaje miejsce na pytanie, czy wszystko w porządku, prośbę o opinię albo przypomnienie o kolejnym terminie. Pomagam zaplanować taki kontakt i połączyć go z obsługą zleceń.</p>
      </div>
      <div class="live-flow-demo">
        <span>✓<b>Zakończenie</b></span><i>→</i>
        <span>☏<b>Kontakt po usłudze</b></span><i>→</i>
        <span>▦<b>Kolejny krok</b></span>
        <small>Przykład opieki nad klientem po realizacji.</small>
      </div>
    </div>
    <div class="shell live-scroll-note">
      <span>Przewijaj, aby zobaczyć, jak łączą się kolejne etapy.</span>
      <span>STRONA · PROCES · RELACJA&nbsp;&nbsp; 01 / 05</span>
    </div>
  </section>

  <section class="live-projects">
    <div class="shell">
      <div class="live-projects-head">
        <div><span class="live-kicker">PROJEKTY DEMONSTRACYJNE</span><h2>Zobacz, zanim<br><em>zdecydujesz.</em></h2></div>
        <a class="live-arrow-link" href="<?php echo esc_url(home_url('/realizacje')); ?>">Obejrzyj projekty ↗</a>
      </div>
      <p class="live-projects-lead">Sprawdź, jak strona pomaga wybrać usługę, zaplanować wizytę albo znaleźć mieszkanie. Każdy przykład odpowiada na inną potrzebę.</p>
      <div class="live-project-grid">
        <a href="<?php echo esc_url(home_url('/demo/natura-strona')); ?>"><small>DEMONSTRACJA / BEAUTY</small><h3>Natura Studio</h3><p>Wybór zabiegu zaczyna się od jasnego opisu. Strona pokazuje usługi, ceny i drogę do umówienia wizyty.</p><b>Obejrzyj stronę studia ↗</b></a>
        <a href="<?php echo esc_url(home_url('/demo/bistro-strona')); ?>"><small>DEMONSTRACJA / GASTRONOMIA</small><h3>Bistro Forma</h3><p>Gość chce poczuć klimat miejsca i zaplanować wizytę. Strona łączy menu z informacją o rezerwacji.</p><b>Obejrzyj stronę restauracji ↗</b></a>
        <a href="<?php echo esc_url(home_url('/demo/dom-strona')); ?>"><small>DEMONSTRACJA / NIERUCHOMOŚCI</small><h3>Dom Dobry</h3><p>Mieszkania, standard i dostępność przedstawione w czytelny sposób.</p><b>Obejrzyj demonstrację ↗</b></a>
        <a href="<?php echo esc_url(home_url('/realizacje/transportflow')); ?>"><small>DEMONSTRACJA / TRANSPORT</small><h3>RouteFlow</h3><p>Strona firmy transportowej połączona z uporządkowaną obsługą zapytań.</p><b>Obejrzyj projekt ↗</b></a>
      </div>
      <p class="live-disclaimer">Autorskie demonstracje możliwości. Nie są realizacjami dla klientów.</p>
    </div>
  </section>

  <section class="live-cooperation">
    <div class="shell live-coop-grid">
      <div class="live-coop-copy">
        <span class="live-kicker">WSPÓŁPRACA Z ZIELONĄ MARKĄ</span>
        <h2>Spokojny proces.<br><em>Wspólny kierunek.</em></h2>
        <p>Mam na imię Łukasz. Tworzę strony i proste narzędzia, które ułatwiają kontakt z klientami i codzienną pracę firmy. Zaczynam od rozmowy o tym, czego potrzebujesz, a potem proponuję rozwiązanie i zakres prac. Rozmawiasz bezpośrednio ze mną i wiesz, co przygotowujemy oraz co będziesz zatwierdzać.</p>
      </div>
      <figure class="live-coop-photo">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/lukasz-zielona-marka-jak-pracuje-20260908.webp'); ?>" alt="Łukasz podczas pracy nad projektem Zielonej Marki" loading="lazy" decoding="async">
        <figcaption>Rozmawiasz bezpośrednio ze mną, od pomysłu po gotową stronę.</figcaption>
      </figure>
    </div>

    <div class="shell live-coop-steps">
      <article><span>01</span><h3>Ustalamy zakres</h3><p>Wybieramy potrzebne funkcje i uzgadniamy zakres przed rozpoczęciem prac.</p></article>
      <article><span>02</span><h3>Przygotowuję projekt</h3><p>Układam treści, wygląd i narzędzia. Ty oglądasz gotową propozycję.</p></article>
      <article><span>03</span><h3>Ty zatwierdzasz</h3><p>Sprawdzam działanie strony. Publikacja następuje po Twojej akceptacji.</p></article>
    </div>
    <div class="shell"><a class="live-arrow-link" href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Przeczytaj zasady współpracy ↗</a></div>
  </section>

  <section class="live-care">
    <div class="shell live-care-grid">
      <div><span class="live-kicker">PO PUBLIKACJI / OPIEKA NAD STRONĄ</span><h2>Rozwój w rytmie<br><em>Twojej firmy.</em></h2></div>
      <div><p>Nowa usługa, pomysł na sprzedaż, wygodniejszy sposób obsługi. Stronę można rozbudować, gdy pojawi się taka potrzeba. Dalszą opiekę i nowe funkcje ustalamy osobno, w zakresie dopasowanym do Twojej firmy.</p>
      <div class="live-care-links"><a href="<?php echo esc_url(home_url('/oferta')); ?>">Opieka ↗</a><a href="<?php echo esc_url(home_url('/usprawnienia-firmy')); ?>">Usprawnienia ↗</a><a href="<?php echo esc_url(home_url('/modernizacja-strony')); ?>">Rozwój ↗</a></div></div>
    </div>
    <div class="shell live-care-statement">Dobry pomysł.<br><em>Niech płynie dalej.</em></div>
  </section>

  <section class="live-contact" id="kontakt">
    <div class="shell">
      <span class="live-kicker">ZACZNIJMY OD ROZMOWY</span>
      <div class="live-contact-head">
        <h2>Zróbmy miejsce<br><em>na dobrą zmianę.</em></h2>
        <div>
          <p>Opowiedz, czym zajmuje się Twoja firma i co chcesz ułatwić sobie lub klientom. Wystarczy kilka zdań. Pomogę Ci wybrać kierunek i ustalić, od czego warto zacząć.</p>
          <div class="live-contact-direct">
            <a href="tel:+48450458466">Porozmawiajmy ↗<strong>+48 450 458 466</strong></a>
            <span>Wolisz napisać? Opisz swoją sprawę ↓</span>
          </div>
        </div>
      </div>

      <div class="live-contact-card">
        <div class="live-contact-card-intro"><h3>Kilka zdań na dobry początek.</h3><p>Opisz swoją firmę i to, co chcesz zmienić. Szczegóły możemy ustalić w rozmowie.</p></div>
        <?php if ($brief_status === 'sent') : ?>
          <div class="form-success" role="status"><b>Dziękuję, wiadomość została wysłana.</b><p>Odpowiem możliwie szybko.</p></div>
        <?php else : ?>
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="live-contact-form">
          <input type="hidden" name="action" value="zm_send_brief">
          <?php wp_nonce_field('zm_send_brief', 'zm_brief_nonce'); ?>
          <div class="live-form-row">
            <label>Imię<input required name="name" placeholder="Jak masz na imię?" autocomplete="name"></label>
            <label>E-mail<input required name="email" type="email" placeholder="twoj@email.pl" autocomplete="email"></label>
          </div>
          <label class="live-form-message">Co chcesz ułatwić w swojej firmie?<textarea required name="message" rows="5" placeholder="Opisz krótko swoją firmę i to, co chcesz zmienić."></textarea></label>
          <details class="live-form-more">
            <summary>Dodaj szczegóły, jeśli chcesz <span>+</span></summary>
            <div class="live-form-row">
              <label>Telefon (opcjonalnie)<input name="phone" type="tel" autocomplete="tel"></label>
              <label>Firma (opcjonalnie)<input name="company" autocomplete="organization"></label>
              <label>Obecna strona (opcjonalnie)<input name="website" type="url" placeholder="https://"></label>
              <label>Obszar (opcjonalnie)<select name="projectType"><option value="">Wybierz</option><option>Strona WWW</option><option>Modernizacja</option><option>Sklep / płatności</option><option>CRM / obsługa klientów</option><option>Automatyzacja</option><option>Inne</option></select></label>
              <label>Planowany termin (opcjonalnie)<input name="timeline" placeholder="Np. w ciągu 2 miesięcy"></label>
              <label>Orientacyjny budżet (opcjonalnie)<select name="budget"><option value="">Wybierz</option><option>do 2 500 zł</option><option>2 500–5 000 zł</option><option>5 000–10 000 zł</option><option>powyżej 10 000 zł</option><option>do ustalenia</option></select></label>
            </div>
          </details>
          <label class="live-consent"><input required type="checkbox" name="consent" value="yes"><span>Zapoznałem/-am się z <a href="<?php echo esc_url(home_url('/polityka-prywatnosci')); ?>">polityką prywatności</a> i proszę o kontakt.</span></label>
          <button class="live-button" type="submit">Wyślij wiadomość <span>↗</span></button>
          <?php if ($brief_status === 'error') : ?><p class="form-error" role="alert">Nie udało się wysłać wiadomości. Napisz na kontakt@zielona-marka.pl.</p><?php endif; ?>
        </form>
        <?php endif; ?>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>
