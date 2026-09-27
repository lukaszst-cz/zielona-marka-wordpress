import { runCLI } from '@wp-playground/cli';
import { chromium } from 'playwright';
import fs from 'node:fs/promises';

const cli = await runCLI({
  command: 'server',
  php: '8.3',
  wp: 'latest',
  port: 9500,
  login: false,
  mount: [{ hostPath: '.', vfsPath: '/wordpress/wp-content/themes/zielona-marka' }],
  blueprint: {
    preferredVersions: { php: '8.3', wp: 'latest' },
    siteOptions: {
      blogname: 'Zielona Marka — Visual QA',
      blogdescription: 'Visual comparison',
      permalink_structure: '/%postname%/',
    },
    steps: [
      { step: 'defineSiteUrl', siteUrl: 'http://127.0.0.1:9500' },
      { step: 'activateTheme', themeFolderName: 'zielona-marka' },
      {
        step: 'runPHP',
        code: `<?php
          require_once '/wordpress/wp-load.php';
          update_option('permalink_structure', '/%postname%/');
          if (function_exists('zm_create_required_pages')) { zm_create_required_pages(); }
          flush_rewrite_rules(false);
        ?>`,
      },
    ],
  },
});

const browser = await chromium.launch({ headless: true });
const pages = [
  ['home', '/'],
  ['oferta', '/oferta/'],
  ['realizacje', '/realizacje/'],
  ['kontakt', '/kontakt/'],
  ['crm', '/maly-crm-dla-firm/'],
  ['en', '/en/'],
];
const viewports = [
  ['desktop', { width: 1440, height: 1000 }],
  ['mobile', { width: 390, height: 844 }],
];

await fs.rm('visual-qa', { recursive: true, force: true });
await fs.mkdir('visual-qa', { recursive: true });

const manifest = [];

async function capture(baseUrl, label, slug, path, viewportName, viewport) {
  const context = await browser.newContext({ viewport, deviceScaleFactor: 1 });
  const page = await context.newPage();
  await page.goto(new URL(path, baseUrl).href, { waitUntil: 'domcontentloaded', timeout: 30000 });
  await page.addStyleTag({
    content: `*,*::before,*::after{animation:none!important;transition:none!important;scroll-behavior:auto!important}`,
  });
  await page.evaluate(() => window.scrollTo(0, 0));
  await page.waitForTimeout(1200);
  const file = `visual-qa/${slug}-${viewportName}-${label}.png`;
  await page.screenshot({ path: file, fullPage: true });
  console.log('CAPTURED', viewportName, slug, label, page.url());
  manifest.push({ label, slug, path, viewport: viewportName, url: page.url(), screenshot: file });
  await context.close();
}

let exitCode = 0;
try {
  for (const [viewportName, viewport] of viewports) {
    for (const [slug, path] of pages) {
      console.log('VISUAL', viewportName, slug);
      await capture('https://zielona-marka.pl', 'production', slug, path, viewportName, viewport);
      await capture(cli.serverUrl, 'wordpress', slug, path, viewportName, viewport);
    }
  }
  await fs.writeFile('visual-qa/manifest.json', JSON.stringify(manifest, null, 2));
  console.log('Visual QA screenshots completed.');
} catch (error) {
  exitCode = 1;
  console.error(error);
} finally {
  await browser.close().catch(() => {});
  await Promise.race([
    cli.server.close(),
    new Promise((resolve) => setTimeout(resolve, 5000)),
  ]);
}

process.exit(exitCode);
