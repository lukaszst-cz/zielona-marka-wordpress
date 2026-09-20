<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e('Przejdź do treści', 'zielona-marka'); ?></a>

<header class="site-header" data-header>
    <div class="wrap nav-wrap">
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Zielona Marka — strona główna">
            <span class="brand-leaf" aria-hidden="true">◌</span>
            <span class="brand-copy"><strong>ZIELONA MARKA</strong><small>STRONY WWW I SYSTEMY DLA FIRM</small></span>
        </a>

        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-menu">
            <span></span><span></span>
            <span class="screen-reader-text"><?php esc_html_e('Otwórz menu', 'zielona-marka'); ?></span>
        </button>

        <nav id="site-menu" class="site-menu" aria-label="<?php esc_attr_e('Menu główne', 'zielona-marka'); ?>">
            <?php if (has_nav_menu('primary')) :
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'items_wrap' => '<ul>%3$s</ul>',
                ]);
            else : ?>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/#mozliwosci')); ?>">Oferta</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#projekty')); ?>">Projekty</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#wspolpraca')); ?>">Współpraca</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#kontakt')); ?>">Kontakt</a></li>
                </ul>
            <?php endif; ?>
            <a class="nav-cta" href="<?php echo esc_url(home_url('/#kontakt')); ?>">Porozmawiajmy <span>↗</span></a>
        </nav>
    </div>
</header>
