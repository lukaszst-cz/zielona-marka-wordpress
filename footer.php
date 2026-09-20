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
