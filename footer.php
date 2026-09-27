<div class="demo-kontakt" data-demo-assistant>
  <button class="demo-kontakt-trigger" type="button" data-demo-toggle aria-expanded="false" aria-controls="demo-kontakt-panel">
    <span aria-hidden="true">✦</span><b>Wypróbuj asystenta</b><small>demonstracja ZM</small>
  </button>
  <section class="demo-kontakt-panel" id="demo-kontakt-panel" role="dialog" aria-label="Demonstracyjny asystent Zielonej Marki" hidden>
    <header><div><span>DEMO · ZIELONA MARKA</span><b>Asystent zapytań</b></div><button type="button" data-demo-close aria-label="Zamknij asystenta">×</button></header>
    <div class="demo-kontakt-body" aria-live="polite">
      <div class="bot-message"><b>Cześć!</b><p>Jestem demonstracyjnym asystentem działającym według przygotowanego scenariusza. Pomogę określić, czego potrzebuje Twoja firma.</p><small>Demonstracja nie podaje wiążącej wyceny.</small></div>
      <div class="kontakt-step" data-demo-step="goal">
        <p>Co chcesz poprawić?</p>
        <div class="kontakt-options">
          <button type="button" data-demo-goal="Nowa strona">Nowa strona</button>
          <button type="button" data-demo-goal="Modernizacja strony">Modernizacja strony</button>
          <button type="button" data-demo-goal="Formularz wyceny">Formularz wyceny</button>
          <button type="button" data-demo-goal="Mały CRM">Mały CRM</button>
          <button type="button" data-demo-goal="Asystent">Asystent</button>
          <button type="button" data-demo-goal="Ceny i terminy">Ceny i terminy</button>
        </div>
      </div>
      <div class="kontakt-step" data-demo-step="industry" hidden>
        <div class="user-message" data-demo-goal-label></div>
        <p>W jakiej branży działasz?</p>
        <div class="kontakt-options">
          <button type="button" data-demo-industry="Warsztat / detailing">Warsztat / detailing</button>
          <button type="button" data-demo-industry="Remonty / instalacje">Remonty / instalacje</button>
          <button type="button" data-demo-industry="Beauty / wizyty">Beauty / wizyty</button>
          <button type="button" data-demo-industry="Inna firma usługowa">Inna firma usługowa</button>
        </div>
        <button class="kontakt-back" type="button" data-demo-back="goal">← Wróć</button>
      </div>
      <div class="kontakt-step" data-demo-step="form" hidden>
        <div class="user-message" data-demo-industry-label></div>
        <p>Zostaw kontakt. Zgłoszenie trafi do Zielonej Marki.</p>
        <form class="kontakt-lead-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" data-demo-form>
          <input type="hidden" name="action" value="zm_send_brief">
          <?php wp_nonce_field('zm_send_brief', 'zm_brief_nonce'); ?>
          <input type="hidden" name="assistantGoal" value="" data-demo-goal-input>
          <input type="hidden" name="assistantIndustry" value="" data-demo-industry-input>
          <label>Imię<input name="name" required autocomplete="name"></label>
          <label>E-mail<input name="email" required type="email" autocomplete="email"></label>
          <label>Firma <span>(opcjonalnie)</span><input name="company" autocomplete="organization"></label>
          <label>Telefon <span>(opcjonalnie)</span><input name="phone" type="tel" autocomplete="tel"></label>
          <label class="kontakt-form-wide">Co jest dziś największym problemem?<textarea name="message" rows="3"></textarea></label>
          <label class="kontakt-consent kontakt-form-wide"><input type="checkbox" name="consent" value="yes" required> <span>Akceptuję <a href="<?php echo esc_url(home_url('/polityka-prywatnosci')); ?>">politykę prywatności</a> i proszę o kontakt.</span></label>
          <button class="button kontakt-form-wide" type="submit">Wyślij zgłoszenie<span>↗</span></button>
        </form>
        <button class="kontakt-back" type="button" data-demo-back="industry">← Zmień branżę</button>
      </div>
    </div>
  </section>
</div>

<a class="whatsapp-float" href="https://wa.me/48450458466" target="_blank" rel="noreferrer" aria-label="Napisz do Zielonej Marki na WhatsApp">
  <span aria-hidden="true">◌</span><b>Napisz na WhatsApp</b><small>Szybka wiadomość</small><i aria-hidden="true">↗</i>
</a>

<footer class="site-footer">
  <div class="shell footer-live-grid">
    <div class="footer-brand-block">
      <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
        <span class="brand-signature" role="img" aria-label="Zielona Marka">
          <img class="brand-apple" src="https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/logo-zielona-marka-transparent-v1.png" alt="">
          <span class="brand-wordmark"><b>ZIELONA</b><b>MARKA</b><small>STRONY WWW I SYSTEMY DLA FIRM</small></span>
        </span>
      </a>
      <p>Strony WWW i systemy dla firm.</p>
      <p>Warszawa, Targówek i okolice. Zdalnie w całej Polsce.</p>
    </div>

    <div class="footer-column">
      <h2>Poznaj ofertę</h2>
      <a href="<?php echo esc_url(home_url('/oferta')); ?>">Oferta</a>
      <a href="<?php echo esc_url(home_url('/realizacje')); ?>">Projekty</a>
      <a href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Współpraca</a>
      <a href="<?php echo esc_url(home_url('/status')); ?>">Strefa klienta</a>
    </div>

    <div class="footer-column">
      <h2>Porozmawiajmy</h2>
      <a href="tel:+48450458466">+48 450 458 466</a>
      <a href="mailto:kontakt@zielona-marka.pl">kontakt@zielona-marka.pl</a>
      <a href="https://www.facebook.com/StudioGraficzneZielonaMarka" target="_blank" rel="noreferrer">Facebook ↗</a>
      <a href="https://www.instagram.com/zielona.marka.pl/" target="_blank" rel="noreferrer">Instagram ↗</a>
      <a href="https://github.com/lukaszst-cz" target="_blank" rel="noreferrer">GitHub ↗</a>
    </div>

    <div class="footer-column footer-local">
      <h2>Warszawa · Targówek i okolice</h2>
      <a href="<?php echo esc_url(home_url('/strony-internetowe/targowek')); ?>">Targówek</a>
      <a href="<?php echo esc_url(home_url('/strony-internetowe/warszawa')); ?>">Warszawa</a>
      <a href="<?php echo esc_url(home_url('/strony-internetowe/zabki')); ?>">Ząbki</a>
      <a href="<?php echo esc_url(home_url('/strony-internetowe/zielonka')); ?>">Zielonka</a>
      <a href="<?php echo esc_url(home_url('/strony-internetowe/kobylka')); ?>">Kobyłka</a>
      <a href="<?php echo esc_url(home_url('/strony-internetowe/wolomin')); ?>">Wołomin</a>
      <a href="<?php echo esc_url(home_url('/strony-internetowe/radzymin')); ?>">Radzymin</a>
      <a href="<?php echo esc_url(home_url('/strony-internetowe/bialoleka')); ?>">Białołęka</a>
      <a href="<?php echo esc_url(home_url('/strony-internetowe-marki')); ?>">Marki</a>
    </div>
  </div>
  <div class="shell footer-bottom">
    <small>© <?php echo esc_html(wp_date('Y')); ?> Zielona Marka</small>
    <a href="<?php echo esc_url(home_url('/polityka-prywatnosci')); ?>">Polityka prywatności</a>
    <a href="<?php echo esc_url(home_url('/en')); ?>">English</a>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
