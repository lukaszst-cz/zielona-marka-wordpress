<?php
if (!isset($concept) || !is_array($concept)) { return; }
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class('concept-page'); ?> style="--concept:<?php echo esc_attr($concept['accent']); ?>">
<?php wp_body_open(); ?>
<main class="concept-page">
<nav class="nav shell"><a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><span class="brand-signature"><img class="brand-apple" src="https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/logo-zielona-marka-transparent-v1.png" alt=""><span class="brand-wordmark"><b>ZIELONA</b><b>MARKA</b><small>STRONY WWW I SYSTEMY DLA FIRM</small></span></span></a><div class="concept-return-links"><a class="text-link" href="<?php echo esc_url(home_url('/#realizacje')); ?>">← Wszystkie realizacje</a><a class="text-link" href="<?php echo esc_url(home_url('/')); ?>">Strona główna</a></div></nav>
<header class="concept-hero shell"><div><span class="section-no">PROJEKT KONCEPCYJNY / <?php echo esc_html($concept['category']); ?></span><h1><?php echo esc_html($concept['name']); ?></h1><p><?php echo esc_html($concept['headline']); ?></p></div><figure><img src="<?php echo esc_url($concept['image']); ?>" alt="Koncepcyjny wizerunek marki <?php echo esc_attr($concept['name']); ?>"></figure></header>
<section class="concept-intro shell"><article><small>WYZWANIE</small><h2><?php echo esc_html($concept['challenge']); ?></h2></article><article><small>ROZWIĄZANIE</small><p><?php echo esc_html($concept['solution']); ?></p></article></section>
<section class="concept-screen shell"><div class="concept-browser"><span>● ● ●</span><div><small><?php echo esc_html($concept['category']); ?></small><h2><?php echo esc_html($concept['headline']); ?></h2><button>Umów rozmowę →</button></div></div><aside><span class="section-no">ZAKRES I TECHNOLOGIE</span><?php foreach($concept['stack'] as $i=>$item): ?><div><b><?php echo str_pad((string)($i+1),2,'0',STR_PAD_LEFT); ?></b><span><?php echo esc_html($item); ?></span></div><?php endforeach; ?></aside></section>
<section class="concept-cta"><div class="shell"><span class="section-no">STRONA + ZAPLECZE PROCESOWE</span><h2>Zobacz pełny efekt oraz sposób pracy firmy od środka.</h2><div class="concept-actions"><a class="button" href="<?php echo esc_url(home_url($concept['website'])); ?>">Otwórz pełną stronę <span>↗</span></a><a class="button" href="<?php echo esc_url(home_url($concept['demo'])); ?>">Uruchom demo zaplecza <span>↗</span></a><a class="text-link" href="<?php echo esc_url(home_url('/#kontakt')); ?>">Porozmawiajmy o wdrożeniu</a></div></div></section>
</main>
<?php wp_footer(); ?>
</body>
</html>