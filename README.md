# Zielona Marka, motyw WordPress

**Problem:** mała firma potrzebuje strony, którą może później samodzielnie uzupełniać, a która nadal wygląda indywidualnie i prowadzi klienta do kontaktu.

**Rozwiązanie:** autorski motyw WordPress dla firmy usługowej lub portfolio, bez gotowego, przypadkowego szablonu.

[Otwórz statyczny podgląd motywu](https://lukaszst-cz.github.io/zielona-marka-wordpress/preview/)

## Roboczy podgląd migracji 1:1

[Uruchom aktualną gałąź w WordPress Playground](https://playground.wordpress.net/?blueprint-url=https%3A%2F%2Fraw.githubusercontent.com%2Flukaszst-cz%2Fzielona-marka-wordpress%2Fsync-live-1to1-2026-09-27%2Fblueprint-preview.json)

Podgląd instaluje i aktywuje bezpośrednio gałąź `sync-live-1to1-2026-09-27`, więc pokazuje bieżące zmiany przed scaleniem do `main`.\n\n**Demo Strefy klienta:** po uruchomieniu podglądu wpisz kod `ZM-DEMO-2026` na stronie `/status`. Blueprint tworzy wyłącznie przykładowy projekt demonstracyjny.

## Co zawiera

- własne szablony PHP i konfigurację `theme.json`;
- typ treści **Realizacje** z polami klienta i zakresu;
- stronę główną, archiwum realizacji, formularz kontaktowy i widok mobilny;
- semantyczną strukturę, podstawy SEO i lekkie zasoby bez zewnętrznych fontów.

## Wartość dla firmy

- możliwość samodzielnego dodawania realizacji;
- strona dopasowana do marki zamiast kolejnej kopii szablonu;
- prosta ścieżka od wejścia na stronę do kontaktu;
- baza do dalszej rozbudowy o SEO, blog lub dodatkowe usługi.

## Instalacja

1. W WordPressie wybierz **Wygląd → Motywy → Dodaj nowy → Wyślij motyw na serwer**.
2. Wgraj `zielona-marka-wordpress.zip`, zainstaluj i aktywuj.
3. W **Wygląd → Dostosuj → Zielona Marka, kontakt** wpisz prawdziwy e-mail, telefon i Instagram.
4. W **Ustawienia → Bezpośrednie odnośniki** kliknij „Zapisz zmiany”.

Formularz korzysta z `wp_mail()`; przed publikacją warto skonfigurować SMTP i wysłać wiadomość testową.
