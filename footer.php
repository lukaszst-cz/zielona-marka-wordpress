<footer class="site-footer">
    <div class="wrap footer-grid">
        <div class="footer-brand">
            <a class="footer-mark" href="<?php echo esc_url(home_url('/')); ?>">ZIELONA MARKA</a>
            <p>Strony WWW i systemy dla firm usługowych. Projektowane tak, żeby ułatwiały klientowi kontakt, a firmie codzienną obsługę.</p>
        </div>

        <div>
            <span class="micro">POZNAJ OFERTĘ</span>
            <a href="<?php echo esc_url(home_url('/#mozliwosci')); ?>">Strony WWW</a>
            <a href="<?php echo esc_url(home_url('/#formularze')); ?>">Formularze</a>
            <a href="<?php echo esc_url(home_url('/#crm')); ?>">CRM i obsługa klientów</a>
            <a href="<?php echo esc_url(home_url('/#projekty')); ?>">Projekty</a>
        </div>

        <div>
            <span class="micro">POROZMAWIAJMY</span>
            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', get_theme_mod('zm_phone', '+48 450 458 466'))); ?>">
                <?php echo esc_html(get_theme_mod('zm_phone', '+48 450 458 466')); ?>
            </a>
            <a href="mailto:<?php echo esc_attr(get_theme_mod('zm_email', 'kontakt@zielona-marka.pl')); ?>">
                <?php echo esc_html(get_theme_mod('zm_email', 'kontakt@zielona-marka.pl')); ?>
            </a>
        </div>
    </div>

    <div class="wrap footer-bottom">
        <span>© <?php echo esc_html(wp_date('Y')); ?> Zielona Marka</span>
        <a href="<?php echo esc_url(get_privacy_policy_url()); ?>">Polityka prywatności</a>
        <span>Warszawa i zdalnie w całej Polsce</span>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
