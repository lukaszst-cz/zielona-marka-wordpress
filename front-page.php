<?php
get_header();

$brief_status = sanitize_key(wp_unslash($_GET['brief'] ?? ''));

$process = [
    ['01', 'Twoja strona', 'Oferta, treść i kontakt ułożone tak, żeby klient szybko zrozumiał, czym się zajmujesz.'],
    ['02', 'Zapytanie', 'Formularz zbiera potrzebę, termin i szczegóły zamiast zostawiać firmę z ogólną wiadomością.'],
    ['03', 'Kolejny krok', 'Zapytanie trafia do uporządkowanego procesu: wycena, realizacja, status i dalszy kontakt.'],
];

$capabilities = [
    ['01', 'Strona WWW', 'Czytelna oferta, dobra hierarchia treści i wygodny kontakt na telefonie oraz komputerze.'],
    ['02', 'Formularze', 'Mniej dopytywania i kompletne zgłoszenia: usługa, termin, opis i opcjonalne pliki.'],
    ['03', 'Sklep i płatności', 'Mały sklep, vouchery lub wybrane produkty połączone z bezpiecznym zakupem online.'],
    ['04', 'CRM i obsługa zleceń', 'Kontakty, wyceny, statusy i terminy w jednym miejscu zamiast w kilku kanałach.'],
    ['05', 'Kontakt po usłudze', 'Prośba o opinię, przypomnienie albo następny krok zaplanowany jako część procesu.'],
];

$steps = [
    ['01', 'Ustalamy zakres', 'Najpierw wybieramy problem do rozwiązania i funkcje, które naprawdę są potrzebne.'],
    ['02', 'Przygotowuję projekt', 'Układam treść, wygląd i ścieżkę użytkownika, a potem pokazuję spójną propozycję.'],
    ['03', 'Ty zatwierdzasz', 'Dopiero po testach i akceptacji przechodzimy do publikacji oraz dalszego rozwoju.'],
];
?>
<main id="main">
    <section class="hero">
        <div class="wrap hero-grid">
            <div class="hero-copy">
                <p class="eyebrow">STRONY WWW I SYSTEMY DLA FIRM</p>
                <h1>Masz dobrą firmę.<br><em>Pokażmy ją z dobrej strony.</em></h1>
                <p class="hero-lead">Projektuję strony dla firm usługowych i łączę je z formularzami, płatnościami oraz prostymi systemami obsługi klientów.</p>
                <div class="hero-actions">
                    <a class="button button-primary" href="#mozliwosci">Zobacz możliwości ↓</a>
                    <a class="text-link" href="#kontakt">Porozmawiajmy ↗</a>
                </div>
                <div class="hero-proof">
                    <span>Bezpośrednia współpraca</span>
                    <span>Podgląd przed publikacją</span>
                    <span>Mobile + SEO techniczne</span>
                </div>
            </div>

            <div class="hero-scene" aria-label="Schemat strony i obsługi klienta">
                <div class="scene-orbit"></div>
                <div class="scene-card scene-card-main">
                    <span class="scene-kicker">TWÓJ POMYSŁ</span>
                    <strong>Dobry grunt<br>dla pomysłów.</strong>
                    <small>STRONA · PROCES · RELACJA</small>
                </div>
                <div class="scene-chip chip-one">Nowe zapytanie ✓</div>
                <div class="scene-chip chip-two">Oferta → Kontakt ↗</div>
                <div class="scene-chip chip-three">Wycena → Realizacja</div>
            </div>
        </div>
    </section>

    <section class="flow-intro">
        <div class="wrap">
            <p class="eyebrow">Z CHAOSU DO PORZĄDKU</p>
            <div class="flow-heading">
                <h2>Wszystko zaczyna się łączyć.</h2>
                <p>Strona. Zapytanie. Kolejny krok. Jeden spójny proces zamiast przypadkowych narzędzi.</p>
            </div>

            <div class="flow-track">
                <?php foreach ($process as $item) : ?>
                    <article>
                        <span><?php echo esc_html($item[0]); ?> / <?php echo esc_html(mb_strtoupper($item[1])); ?></span>
                        <h3><?php echo esc_html($item[1]); ?></h3>
                        <p><?php echo esc_html($item[2]); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="mozliwosci" class="capabilities">
        <div class="wrap">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">PRZYKŁADOWY PROCES DLA TWOJEJ FIRMY</p>
                    <h2>Od pierwszego wejścia<br>do następnego kroku.</h2>
                </div>
                <p>Możesz zacząć od samej strony i formularza, a później rozbudować całość o sprzedaż, CRM i automatyzacje.</p>
            </div>

            <div class="capability-list">
                <?php foreach ($capabilities as $item) : ?>
                    <article class="capability-item" id="<?php echo esc_attr($item[0] === '02' ? 'formularze' : ($item[0] === '04' ? 'crm' : '')); ?>">
                        <span class="cap-number"><?php echo esc_html($item[0]); ?></span>
                        <div>
                            <h3><?php echo esc_html($item[1]); ?></h3>
                            <p><?php echo esc_html($item[2]); ?></p>
                        </div>
                        <div class="cap-demo" aria-hidden="true">
                            <?php if ($item[0] === '01') : ?>
                                <span class="mini-nav">Oferta · Kontakt ↗</span><strong>Dobra firma.<br>Dobry początek.</strong>
                            <?php elseif ($item[0] === '02') : ?>
                                <span class="mini-field">Usługa</span><span class="mini-field">Preferowany termin</span><span class="mini-field wide">Krótki opis sprawy…</span>
                            <?php elseif ($item[0] === '03') : ?>
                                <strong>Voucher</strong><span>Produkt → Koszyk → Płatność</span>
                            <?php elseif ($item[0] === '04') : ?>
                                <span>✉ Nowe</span><b>→</b><span>▤ Wycena</span><b>→</b><span>✓ Realizacja</span>
                            <?php else : ?>
                                <span>✓ Zakończenie</span><b>→</b><span>☏ Kontakt</span><b>→</b><span>▦ Kolejny krok</span>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="projekty" class="projects section-pad">
        <div class="wrap">
            <div class="section-heading compact">
                <div>
                    <p class="eyebrow">PROJEKTY DEMONSTRACYJNE</p>
                    <h2>Zobacz, zanim zdecydujesz.</h2>
                </div>
                <p>Przykłady pokazują sposób myślenia o branży, formularzach i obsłudze klienta. Nie udają wdrożeń dla prawdziwych klientów.</p>
            </div>

            <div class="project-grid">
                <?php
                $projects = new WP_Query(['post_type' => 'realizacja', 'posts_per_page' => 4]);
                if ($projects->have_posts()) :
                    while ($projects->have_posts()) : $projects->the_post(); ?>
                        <article class="project-card">
                            <a href="<?php the_permalink(); ?>">
                                <div class="project-visual">
                                    <?php if (has_post_thumbnail()) { the_post_thumbnail('zm-project'); } else { ?><span class="project-placeholder">ZM</span><?php } ?>
                                </div>
                                <div class="project-meta">
                                    <span>PROJEKT</span>
                                    <h3><?php the_title(); ?></h3>
                                    <small><?php echo esc_html(get_post_meta(get_the_ID(), 'zakres', true) ?: 'Strona i proces klienta'); ?></small>
                                </div>
                            </a>
                        </article>
                    <?php endwhile;
                    wp_reset_postdata();
                else :
                    $demo = [
                        ['Natura Studio', 'Beauty i rezerwacje', 'Pielęgnacja · Rezerwacja · Sprzedaż'],
                        ['Bistro Forma', 'Gastronomia', 'Menu · Klimat · Rezerwacja'],
                        ['Dom Dobry', 'Nieruchomości', 'Oferta · Dostępność · Kontakt'],
                        ['TransportFlow', 'Transport i logistyka', 'Zlecenia · Kierowcy · Wyniki'],
                    ];
                    foreach ($demo as $i => $item) : ?>
                        <article class="project-card demo-<?php echo esc_attr((string)($i + 1)); ?>">
                            <div class="project-visual"><span class="project-placeholder"><?php echo esc_html(substr($item[0], 0, 2)); ?></span></div>
                            <div class="project-meta"><span>DEMONSTRACJA</span><h3><?php echo esc_html($item[0]); ?></h3><small><?php echo esc_html($item[2]); ?></small></div>
                        </article>
                    <?php endforeach;
                endif; ?>
            </div>
        </div>
    </section>

    <section id="wspolpraca" class="collaboration section-pad">
        <div class="wrap">
            <div class="section-heading compact">
                <div>
                    <p class="eyebrow">WSPÓŁPRACA Z ZIELONĄ MARKĄ</p>
                    <h2>Spokojny proces.<br>Wspólny kierunek.</h2>
                </div>
                <p>Rozmawiasz bezpośrednio ze mną. Najpierw ustalamy cel, potem przygotowuję rozwiązanie, a publikacja następuje dopiero po testach i akceptacji.</p>
            </div>

            <div class="steps">
                <?php foreach ($steps as $step) : ?>
                    <article><span><?php echo esc_html($step[0]); ?></span><h3><?php echo esc_html($step[1]); ?></h3><p><?php echo esc_html($step[2]); ?></p></article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="aftercare">
        <div class="wrap aftercare-grid">
            <div>
                <p class="eyebrow">PO PUBLIKACJI / OPIEKA NAD STRONĄ</p>
                <h2>Rozwój w rytmie Twojej firmy.</h2>
            </div>
            <p>Nowa usługa, wygodniejsza obsługa, kampania albo automatyzacja nie wymagają budowania wszystkiego od początku. Stronę rozwijamy wtedy, gdy pojawia się realna potrzeba.</p>
            <div class="aftercare-tags"><span>Opieka</span><span>Usprawnienia</span><span>Rozwój</span></div>
        </div>
    </section>

    <section id="kontakt" class="contact section-pad">
        <div class="wrap contact-grid">
            <div class="contact-copy">
                <p class="eyebrow">ZACZNIJMY OD ROZMOWY</p>
                <h2>Zróbmy miejsce<br>na dobrą zmianę.</h2>
                <p>Opisz firmę i to, co chcesz ułatwić sobie albo klientom. Wystarczy kilka zdań — szczegóły możemy ustalić później.</p>
                <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', get_theme_mod('zm_phone', '+48 450 458 466'))); ?>"><?php echo esc_html(get_theme_mod('zm_phone', '+48 450 458 466')); ?></a>
                <a href="mailto:<?php echo esc_attr(get_theme_mod('zm_email', 'kontakt@zielona-marka.pl')); ?>"><?php echo esc_html(get_theme_mod('zm_email', 'kontakt@zielona-marka.pl')); ?></a>
            </div>

            <form class="brief-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <input type="hidden" name="action" value="zm_send_brief">
                <?php wp_nonce_field('zm_send_brief', 'zm_brief_nonce'); ?>

                <?php if ($brief_status === 'sent') : ?><div class="form-message success" role="status">Dziękuję. Wiadomość została wysłana.</div><?php endif; ?>
                <?php if ($brief_status === 'error') : ?><div class="form-message error" role="alert">Nie udało się wysłać formularza. Sprawdź dane lub napisz e-mail.</div><?php endif; ?>

                <div class="field-row">
                    <label><span>Imię</span><input name="name" required autocomplete="name" placeholder="Jak masz na imię?"></label>
                    <label><span>E-mail</span><input name="email" required type="email" autocomplete="email" placeholder="twoj@email.pl"></label>
                </div>
                <div class="field-row">
                    <label><span>Firma</span><input name="company" autocomplete="organization" placeholder="Nazwa firmy"></label>
                    <label><span>Orientacyjny budżet</span>
                        <select name="budget"><option value="">Opcjonalnie</option><option>2–5 tys. zł</option><option>5–10 tys. zł</option><option>10–20 tys. zł</option><option>powyżej 20 tys. zł</option></select>
                    </label>
                </div>
                <label><span>Co chcesz ułatwić w swojej firmie?</span><textarea name="message" required rows="5" placeholder="Napisz kilka zdań o potrzebie, problemie lub pomyśle…"></textarea></label>
                <label class="consent"><input type="checkbox" required><span>Akceptuję <a href="<?php echo esc_url(get_privacy_policy_url()); ?>">politykę prywatności</a> i proszę o kontakt w sprawie zapytania.</span></label>
                <button class="submit-button" type="submit"><span>Wyślij wiadomość</span><b>↗</b></button>
            </form>
        </div>
    </section>
</main>
<?php get_footer(); ?>
