<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
  <nav class="nav shell" aria-label="Główna nawigacja">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Zielona Marka, strona główna">
      <span class="brand-signature" role="img" aria-label="Zielona Marka">
        <img class="brand-apple" src="https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/logo-zielona-marka-transparent-v1.png" alt="">
        <span class="brand-wordmark"><b>ZIELONA</b><b>MARKA</b><small>STRONY WWW I SYSTEMY DLA FIRM</small></span>
      </span>
    </a>
    <div class="nav-links">
      <a href="<?php echo esc_url(home_url('/oferta')); ?>">Oferta</a>
      <a href="<?php echo esc_url(home_url('/#dla-kogo')); ?>">Dla branż</a>
      <a href="<?php echo esc_url(home_url('/modernizacja-strony')); ?>">Modernizacja</a>
      <a href="<?php echo esc_url(home_url('/realizacje')); ?>">Realizacje</a>
      <a href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">Mały CRM</a>
      <a href="<?php echo esc_url(home_url('/usprawnienia-firmy')); ?>">Usprawnienia</a>
      <a href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Jak pracuję</a>
      <a href="<?php echo esc_url(home_url('/kontakt')); ?>">Kontakt</a>
    </div>
    <div class="language-switch" aria-label="Wybór języka">
      <a class="active" href="<?php echo esc_url(home_url('/')); ?>" lang="pl">🇵🇱 <span>PL</span></a>
      <a href="<?php echo esc_url(home_url('/en')); ?>" lang="en">🇬🇧 <span>EN</span></a>
    </div>
    <a class="button button-small" href="<?php echo esc_url(home_url('/kontakt')); ?>">Wyceń projekt</a>
    <details class="mobile-menu">
      <summary>Menu <span aria-hidden="true">+</span></summary>
      <div>
        <a href="<?php echo esc_url(home_url('/oferta')); ?>">Oferta</a>
        <a href="<?php echo esc_url(home_url('/#dla-kogo')); ?>">Dla branż</a>
        <a href="<?php echo esc_url(home_url('/modernizacja-strony')); ?>">Modernizacja</a>
        <a href="<?php echo esc_url(home_url('/realizacje')); ?>">Realizacje</a>
        <a href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">Mały CRM</a>
        <a href="<?php echo esc_url(home_url('/usprawnienia-firmy')); ?>">Usprawnienia</a>
        <a href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Jak pracuję</a>
        <a href="<?php echo esc_url(home_url('/kontakt')); ?>">Kontakt i wycena</a>
        <a href="<?php echo esc_url(home_url('/status')); ?>">Strefa klienta</a>
      </div>
    </details>
  </nav>
</header>
