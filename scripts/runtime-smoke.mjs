import { runCLI } from '@wp-playground/cli';

const demoProjectPhp = `<?php
require_once '/wordpress/wp-load.php';
update_option('permalink_structure', '/%postname%/');
if (function_exists('zm_create_required_pages')) {
    zm_create_required_pages();
}

$existing = get_posts([
    'post_type' => 'zm_client_project',
    'post_status' => 'any',
    'meta_key' => 'zm_public_code',
    'meta_value' => 'ZM-DEMO-2026',
    'posts_per_page' => 1,
]);

if (!$existing) {
    $project_id = wp_insert_post([
        'post_type' => 'zm_client_project',
        'post_status' => 'publish',
        'post_title' => 'Przykładowa strona usługowa',
    ]);

    if (!is_wp_error($project_id)) {
        $meta = [
            'zm_public_code' => 'ZM-DEMO-2026',
            'zm_client_name' => 'Klient demonstracyjny',
            'zm_client_company' => 'Firma demonstracyjna',
            'zm_client_email' => 'demo@example.com',
            'zm_status' => 'Wdrożenie',
            'zm_progress' => '68',
            'zm_deadline' => '2026-10-16',
            'zm_start_date' => '2026-09-28',
            'zm_price' => '4490',
            'zm_contract_status' => 'Do akceptacji',
            'zm_contract_number' => 'ZM/DEMO/2026',
            'zm_next_step' => 'Akceptacja wersji mobilnej i treści formularza',
            'zm_scope' => "Strona usługowa do 6 podstron\nFormularz kwalifikujący\nPodstawy lokalnej widoczności\nKontrola jakości przed publikacją",
            'zm_client_note' => 'Projekt demonstracyjny dla testów CI.',
            'zm_provider_name' => 'Zielona Marka - Łukasz Staniewicz',
            'zm_qa_mobile' => 'Gotowe',
            'zm_qa_forms' => 'Gotowe',
            'zm_qa_links' => 'W trakcie',
            'zm_qa_speed' => 'Do wykonania',
        ];
        foreach ($meta as $key => $value) {
            update_post_meta($project_id, $key, $value);
        }
    }
}
flush_rewrite_rules(false);
?>`;

const cli = await runCLI({
  command: 'server',
  php: '8.3',
  wp: 'latest',
  port: 9400,
  login: false,
  mount: [
    {
      hostPath: '.',
      vfsPath: '/wordpress/wp-content/themes/zielona-marka',
    },
  ],
  blueprint: {
    preferredVersions: { php: '8.3', wp: 'latest' },
    siteOptions: {
      blogname: 'Zielona Marka — CI',
      blogdescription: 'Runtime smoke tests',
      permalink_structure: '/%postname%/',
    },
    steps: [
      { step: 'defineSiteUrl', siteUrl: 'http://127.0.0.1:9400' },
      { step: 'activateTheme', themeFolderName: 'zielona-marka' },
      { step: 'runPHP', code: demoProjectPhp },
    ],
  },
});

async function requestRoute(path, options = {}) {
  const url = new URL(path, cli.serverUrl);
  console.log('CHECK', path, '->', url.href);
  return fetch(url, { signal: AbortSignal.timeout(12000), ...options });
}

async function check200(path, marker) {
  const response = await requestRoute(path);
  const html = await response.text();
  if (response.status !== 200) {
    throw new Error(`Expected final 200 for ${path}, got ${response.status} at ${response.url}\n${html.slice(0, 1000)}`);
  }
  if (!html.includes(marker)) {
    throw new Error(`Marker not found for ${path}: ${marker}`);
  }
}

async function checkStatus(path, allowed) {
  const response = await requestRoute(path, { redirect: 'manual' });
  if (!allowed.includes(response.status)) {
    throw new Error(`Expected ${allowed.join('/')} for ${path}, got ${response.status}`);
  }
}

try {
  await check200('/', 'Masz dobrą firmę.');
  await check200('/oferta/', 'ZM Start');
  await check200('/kontakt/', 'KONTAKT I WYCENA');
  await check200('/maly-crm-dla-firm/', 'Każdy klient ma status.');
  await check200('/jak-pracuje/', 'JAK PRACUJĘ');
  await check200('/realizacje/', 'REALIZACJE I DEMONSTRACJE');
  await check200('/strony-internetowe/targowek/', 'TARGÓWEK');
  await check200('/strony-internetowe/warszawa/', 'WARSZAWA');
  await check200('/demo/natura/', 'NATURA STUDIO');
  await check200('/demo/transport/', 'ZIELONY TRANSPORT');
  await check200('/en/', 'You have a good business.');
  await check200('/status/', 'STREFA KLIENTA');
  await check200('/status/ZM-DEMO-2026/', 'Przykładowa strona usługowa');
  await check200('/status/ZM-DEMO-2026/qa/', 'Kontrola jakości');
  await check200('/status/ZM-DEMO-2026/umowa/', 'Umowa o wykonanie projektu');

  await checkStatus('/chatbot-dla-firm/', [301]);
  await checkStatus('/studio/', [302]);
  await checkStatus('/nie-istnieje-zielona-marka/', [404]);

  console.log('Runtime WordPress smoke tests passed:', cli.serverUrl);
} finally {
  await cli.server.close();
}
