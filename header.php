<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main-content">Przejdź do treści</a>
<header class="site-header">
  <nav class="nav shell" aria-label="Główna nawigacja">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Zielona Marka, strona główna">
      <span class="brand-signature" role="img" aria-label="Zielona Marka">
        <img class="brand-apple" src="https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/logo-zielona-marka-transparent-v1.png" alt="">
        <span class="brand-wordmark"><b>ZIELONA</b><b>MARKA</b><small>STRONY WWW I SYSTEMY DLA FIRM</small></span>
      </span>
    </a>

    <div class="nav-links">
      <details class="nav-offer">
        <summary>Oferta <span aria-hidden="true">⌄</span></summary>
        <div class="nav-offer-panel">
          <a href="<?php echo esc_url(home_url('/oferta')); ?>">Strony WWW</a>
          <a href="<?php echo esc_url(home_url('/modernizacja-strony')); ?>">Modernizacja strony</a>
          <a href="<?php echo esc_url(home_url('/maly-crm-dla-firm')); ?>">CRM i obsługa klientów</a>
          <a href="<?php echo esc_url(home_url('/usprawnienia-firmy')); ?>">Usprawnienia i automatyzacje</a>
          <a href="<?php echo esc_url(home_url('/strony-dla-firm-uslugowych')); ?>">Firmy usługowe</a>
          <a href="<?php echo esc_url(home_url('/strony-dla-beauty')); ?>">Beauty</a>
          <a href="<?php echo esc_url(home_url('/strony-dla-warsztatow')); ?>">Warsztaty</a>
          <a href="<?php echo esc_url(home_url('/asystent-zapytan')); ?>">Asystent zapytań</a>
          <a href="<?php echo esc_url(home_url('/asystent-zapytan')); ?>">Chatbot dla firmy</a>
          <a href="<?php echo esc_url(home_url('/strony-internetowe/targowek')); ?>">Warszawa · Targówek</a>
        </div>
      </details>
      <a href="<?php echo esc_url(home_url('/realizacje')); ?>">Projekty</a>
      <a href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Współpraca</a>
      <a href="<?php echo esc_url(home_url('/kontakt')); ?>">Kontakt</a>
      <a href="<?php echo esc_url(home_url('/status')); ?>">Strefa klienta</a>
    </div>

    <div class="language-switch" aria-label="Wybór języka">
      <a class="active" href="<?php echo esc_url(home_url('/')); ?>" lang="pl" aria-label="Polska wersja językowa">🇵🇱 <span>PL</span></a>
      <a href="<?php echo esc_url(home_url('/en')); ?>" lang="en" aria-label="English version">🇬🇧 <span>EN</span></a>
    </div>

    <details class="mobile-menu">
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
        <a href="<?php echo esc_url(home_url('/strony-internetowe/targowek')); ?>">Warszawa · Targówek</a>
        <a href="<?php echo esc_url(home_url('/realizacje')); ?>">Projekty</a>
        <a href="<?php echo esc_url(home_url('/jak-pracuje')); ?>">Współpraca</a>
        <a href="<?php echo esc_url(home_url('/kontakt')); ?>">Kontakt</a>
        <a href="<?php echo esc_url(home_url('/status')); ?>">Strefa klienta</a>
        <a href="tel:+48450458466">+48 450 458 466</a>
      </div>
    </details>
  </nav>
</header>
