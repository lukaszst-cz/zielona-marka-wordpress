<?php get_header(); ?>
<main class="shell not-found">
  <span class="section-no">BŁĄD 404</span>
  <h1>Ta strona nie istnieje lub została przeniesiona.</h1>
  <p>Wróć do strony głównej albo zobacz projekty demonstracyjne.</p>
  <div class="hero-actions">
    <a class="button" href="<?php echo esc_url(home_url('/')); ?>">Strona główna <span>↗</span></a>
    <a class="text-link" href="<?php echo esc_url(home_url('/realizacje')); ?>">Realizacje <span>↗</span></a>
  </div>
</main>
<?php get_footer(); ?>
