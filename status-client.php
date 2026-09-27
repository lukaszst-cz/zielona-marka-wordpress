<?php
if (!defined('ABSPATH')) { exit; }
$code = strtoupper((string) get_query_var('zm_status_code'));
$project = zm_get_client_project_by_code($code);
if (!$project) { status_header(404); exit; }

$stages = ['Planowanie','Treści','Projekt graficzny','Wdrożenie','Testy','Opublikowany','Opieka'];
$status = zm_project_value($project, 'status', 'Planowanie');
$stage_index = array_search($status, $stages, true);
if ($stage_index === false) { $stage_index = 0; }
$display_stages = array_slice($stages, 0, 6);
$progress = zm_project_value($project, 'progress', '0');
$deadline = zm_project_value($project, 'deadline');
$deadline_label = $deadline ? wp_date('d.m.Y', strtotime($deadline)) : 'Do ustalenia';
$company = zm_project_value($project, 'client_company');
$client = zm_project_value($project, 'client_name');
$contract_status = zm_project_value($project, 'contract_status', 'Szkic');
$next_step = zm_project_value($project, 'next_step', 'Ustalenie kolejnego etapu');
$note = zm_project_value($project, 'client_note', 'Gdy pojawi się informacja potrzebna od Ciebie, zobaczysz ją właśnie tutaj.');
$scope = zm_project_value($project, 'scope', 'Zakres jest obecnie doprecyzowywany.');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width,initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class('client-status'); ?>><?php wp_body_open(); ?>
<main class="client-status">
<nav class="nav shell"><a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><span class="brand-signature"><img class="brand-apple" src="https://raw.githubusercontent.com/lukaszst-cz/zielona-marka-pl/main/public/logo-zielona-marka-transparent-v1.png" alt=""><span class="brand-wordmark"><b>ZIELONA</b><b>MARKA</b><small>STRONY WWW I SYSTEMY DLA FIRM</small></span></span></a><span>Strefa klienta</span></nav>
<div class="client-status-shell">
<header><span class="section-no">PROJEKT <?php echo esc_html($code); ?></span><h1><?php echo esc_html(get_the_title($project)); ?></h1><p><?php echo esc_html($company ?: $client); ?></p></header>

<section class="client-kpis">
<article><span>Aktualny etap</span><b><?php echo esc_html($status); ?></b></article>
<article><span>Postęp</span><b><?php echo esc_html($progress); ?>%</b></article>
<article><span>Planowany termin</span><b><?php echo esc_html($deadline_label); ?></b></article>
<article><span>Umowa</span><b><?php echo esc_html($contract_status); ?></b></article>
</section>

<section class="status-track" aria-label="Etapy projektu">
<?php foreach ($display_stages as $i => $stage): $done = $i <= (int) $stage_index; ?>
<div class="<?php echo $done ? 'done' : ''; ?>"><i><?php echo $i < (int) $stage_index ? '✓' : esc_html(sprintf('%02d', $i + 1)); ?></i><span><?php echo esc_html($stage); ?></span></div>
<?php endforeach; ?>
</section>

<section class="client-status-grid">
<article><span class="section-no">NASTĘPNY KROK</span><h2><?php echo esc_html($next_step); ?></h2><p><?php echo esc_html($note); ?></p></article>
<article><span class="section-no">ZAKRES PROJEKTU</span><p><?php echo nl2br(esc_html($scope)); ?></p></article>
</section>

<section class="client-documents"><div><span class="section-no">DOKUMENTY</span><h2>Umowa projektu</h2><p>Otwórz roboczy dokument, sprawdź dane, zapisz jako PDF lub wydrukuj. Podpisany skan odeślij na adres kontaktowy.</p></div><div><a class="button" href="<?php echo esc_url(home_url('/status/' . rawurlencode($code) . '/umowa')); ?>">Otwórz umowę <span>↗</span></a><a class="text-link" href="mailto:kontakt@zielona-marka.pl?subject=Podpisana%20umowa%20Zielona%20Marka">Odeślij podpisaną umowę e-mailem</a></div></section>

<section class="client-qa"><div><span class="section-no">STANDARD PRZED PUBLIKACJĄ</span><h2>QA oznacza kontrolę jakości.</h2><p>Po zakończeniu wdrożenia sprawdzamy projekt na uzgodnionych urządzeniach i w rzeczywistych ścieżkach klienta. Wyniki można otworzyć, wydrukować lub zapisać jako PDF.</p><a class="button" href="<?php echo esc_url(home_url('/status/' . rawurlencode($code) . '/qa')); ?>">Otwórz raport jakości <span>↗</span></a></div><ul><li>telefon i komputer</li><li>formularze i linki</li><li>szybkość oraz podstawowe SEO</li></ul></section>

<footer><p>Masz pytanie? Napisz: <a href="mailto:kontakt@zielona-marka.pl">kontakt@zielona-marka.pl</a></p></footer>
</div>
</main>
<?php wp_footer(); ?></body></html>
