
<div class="demo-kontakt" data-demo-assistant>
  <button class="demo-kontakt-trigger" type="button" data-demo-toggle aria-expanded="false" aria-controls="demo-kontakt-panel">
    <span aria-hidden="true">✦</span><b>Wypróbuj asystenta</b><small>demonstracja ZM</small>
  </button>
  <section class="demo-kontakt-panel" id="demo-kontakt-panel" role="dialog" aria-label="Demonstracyjny asystent Zielonej Marki" hidden>
    <header><div><span>DEMO · ZIELONA MARKA</span><b>Asystent zapytań</b></div><button type="button" data-demo-close aria-label="Zamknij asystenta">×</button></header>
    <div class="demo-kontakt-body" aria-live="polite">
      <div class="bot-message"><b>Cześć!</b><p>Jestem demonstracyjnym asystentem działającym według przygotowanego scenariusza. Pomogę określić, czego potrzebuje Twoja firma.</p><small>Nie udaję człowieka i nie podaję wiążącej wyceny.</small></div>
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
        <div class="bot-message" data-demo-prices hidden><p><b>Orientacyjnie:</b> ZM Start od 2 490 zł / 7 dni, LeadFlow od 4 490 zł / 10–14 dni, Flow AI od 6 900 zł / 14–21 dni.</p><small>30% na start, 70% po odbiorze i QA, przed publikacją na serwerze klienta.</small></div>
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
      <div class="kontakt-demo-links"><a href="<?php echo esc_url(home_url('/strony-dla-warsztatow')); ?>">Demo dla warsztatu</a><a href="<?php echo esc_url(home_url('/strony-dla-firm-uslugowych')); ?>">Demo dla wykonawcy</a><a href="<?php echo esc_url(home_url('/strony-dla-beauty')); ?>">Demo beauty</a></div>
    </div>
    <footer>To demonstracja scenariusza. Wdrożenie AI wymaga zatwierdzonej bazy wiedzy i kontaktu z człowiekiem.</footer>
  </section>
</div>

<footer class="site-footer">
  <div class="shell footer-grid">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
      <span class="brand-signature" role="img" aria-label="Zielona Marka">
        <img class="brand-apple" src="https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/logo-zielona-marka-transparent-v1.png" alt="">
        <span class="brand-wordmark"><b>ZIELONA</b><b>MARKA</b><small>STRONY WWW I SYSTEMY DLA FIRM</small></span>
      </span>
    </a>
    <p>Strony WWW, formularze wyceny i systemy, które porządkują codzienną pracę firm.</p>
    <div>
      <a href="<?php echo esc_url(home_url('/oferta')); ?>">Oferta</a>
      <a href="<?php echo esc_url(home_url('/realizacje')); ?>">Realizacje</a>
      <a href="<?php echo esc_url(home_url('/status')); ?>">Status projektu</a>
      <a href="https://www.facebook.com/StudioGraficzneZielonaMarka" target="_blank" rel="noreferrer">Facebook ↗</a>
      <a href="https://www.instagram.com/zielona.marka.pl/" target="_blank" rel="noreferrer">Instagram ↗</a>
      <a href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Jak pracuję</a>
      <a href="<?php echo esc_url(home_url('/polityka-prywatnosci')); ?>">Prywatność</a>
    </div>
    <small>© <?php echo esc_html(wp_date('Y')); ?> Zielona Marka</small>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
