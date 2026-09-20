# Zielona Marka — motyw WordPress v2

Autorski motyw WordPress rozwijany jako odpowiednik serwisu **zielona-marka.pl**.

## Kierunek v2

- spokojniejszy, zielono-kremowy system wizualny zgodny z aktualnym kierunkiem marki;
- strona główna prowadzona jako proces: **strona → zapytanie → kolejny krok**;
- sekcje dla stron WWW, formularzy, małego sklepu/płatności, CRM i kontaktu po usłudze;
- projekty demonstracyjne z typem treści **Realizacje**;
- sekcja współpracy, opieki po publikacji i rozbudowany formularz briefu;
- responsywność, dostępność, ograniczenie ruchu przez `prefers-reduced-motion`;
- bez zewnętrznego buildera i bez obowiązkowych płatnych wtyczek.

## Instalacja

1. Pobierz repozytorium lub przygotuj ZIP z katalogu motywu.
2. W WordPressie: **Wygląd → Motywy → Dodaj nowy → Wyślij motyw na serwer**.
3. Aktywuj motyw **Zielona Marka Studio**.
4. Ustaw menu główne i stronę prywatności.
5. Sprawdź dane kontaktowe w konfiguracji motywu.
6. Skonfiguruj SMTP przed produkcyjnym użyciem formularza.
7. Zapisz ponownie **Ustawienia → Bezpośrednie odnośniki**.

## Rozwój

Gałąź `rebuild-current-site-v2` zawiera przebudowę pod aktualny serwis. `main` pozostaje punktem odniesienia do czasu akceptacji i scalenia.

## Repozytorium

Kod motywu: PHP + CSS + JavaScript. WordPress core, baza danych, dane logowania i sekrety nie powinny trafiać do GitHuba.
