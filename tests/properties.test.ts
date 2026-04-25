import * as fs from 'fs';
import * as path from 'path';
import * as fc from 'fast-check';
import { getAllHtmlFiles, parseHtml, isInnerPage, getFileContent } from './helpers';

const ROOT = path.resolve(__dirname, '..');

const SITEMAP_SLUGS = [
  'about', 'why-us', 'advantage', 'how-we-work', 'derivatives',
  'who-we-are', 'engagement', 'measurement', 'social-advantage', 'contact'
];

const SENSITIVE_FILES = ['error_log', 'app.yaml', 'contactForm.php'];

const EXPECTED_TITLES: Record<string, string> = {
  'index.html': 'LIT Academy',
  'about/index.html': 'About us | LIT Academy',
  'why-us/index.html': 'Why us | LIT Academy',
  'advantage/index.html': 'Advantages | LIT Academy',
  'how-we-work/index.html': 'How we work | LIT Academy',
  'derivatives/index.html': 'Derivatives | LIT Academy',
  'who-we-are/index.html': 'Who are we | LIT Academy',
  'engagement/index.html': 'Engagement cycle | LIT Academy',
  'measurement/index.html': 'Measurement | LIT Academy',
  'social-advantage/index.html': 'Social industrial advantages | LIT Academy',
  'contact/index.html': 'Contact us | LIT Academy',
};

const LOCAL_ASSET_PATTERNS = [
  /^css\//,
  /^js\//,
  /^img\//,
  /^favicon\//,
];

describe('Property 1: No Sensitive Files in Output', () => {
  // Feature: github-pages-migration, Property 1: No sensitive files in output tree
  test('sensitive files do not exist in the repository', () => {
    for (const filename of SENSITIVE_FILES) {
      const filePath = path.join(ROOT, filename);
      expect(fs.existsSync(filePath)).toBe(false);
    }
    // Also check for advantage - Copy.php
    const copyFile = path.join(ROOT, 'advantage - Copy.php');
    expect(fs.existsSync(copyFile)).toBe(false);
  });
});

describe('Property 2: No PHP References in Any HTML File', () => {
  // Feature: github-pages-migration, Property 2: No PHP references in any HTML file
  test('no HTML file contains PHP tags or .php references', () => {
    const htmlFiles = getAllHtmlFiles();
    expect(htmlFiles.length).toBeGreaterThan(0);

    fc.assert(
      fc.property(fc.constantFrom(...htmlFiles), (filePath) => {
        const content = getFileContent(filePath);
        const $ = parseHtml(filePath);

        // No PHP tags
        expect(content).not.toContain('<?php');
        expect(content).not.toContain('include(');
        expect(content).not.toContain('require(');

        // No .php in href, src, action attributes
        $('[href]').each((_: number, el: any) => {
          const href = $(el).attr('href') || '';
          if (!href.startsWith('http') && !href.startsWith('//') && !href.startsWith('#') && !href.startsWith('mailto:')) {
            expect(href).not.toMatch(/\.php$/);
          }
        });

        $('[src]').each((_: number, el: any) => {
          const src = $(el).attr('src') || '';
          if (!src.startsWith('http') && !src.startsWith('//')) {
            expect(src).not.toMatch(/\.php$/);
          }
        });

        $('[action]').each((_: number, el: any) => {
          const action = $(el).attr('action') || '';
          expect(action).not.toMatch(/\.php$/);
        });

        return true;
      }),
      { numRuns: 100 }
    );
  });
});

describe('Property 3: All Sitemap Pages Exist', () => {
  // Feature: github-pages-migration, Property 3: All sitemap pages exist
  test('index.html exists at root', () => {
    expect(fs.existsSync(path.join(ROOT, 'index.html'))).toBe(true);
  });

  test('all inner page index.html files exist', () => {
    fc.assert(
      fc.property(fc.constantFrom(...SITEMAP_SLUGS), (slug) => {
        const filePath = path.join(ROOT, slug, 'index.html');
        expect(fs.existsSync(filePath)).toBe(true);
        return true;
      }),
      { numRuns: 100 }
    );
  });
});

describe('Property 4: Required Asset Link Tags Present in Every HTML File', () => {
  // Feature: github-pages-migration, Property 4: Required asset link tags present in every HTML file
  test('every HTML file has required CSS and JS references', () => {
    const htmlFiles = getAllHtmlFiles();

    fc.assert(
      fc.property(fc.constantFrom(...htmlFiles), (filePath) => {
        const content = getFileContent(filePath);
        const inner = isInnerPage(filePath);
        const prefix = inner ? '../' : '';

        expect(content).toContain(`${prefix}css/bootstrap.min.css`);
        expect(content).toContain(`${prefix}css/bootstrap-theme.min.css`);
        expect(content).toContain(`${prefix}css/default.css`);
        expect(content).toContain(`${prefix}css/nivo-slider.css`);
        expect(content).toContain(`${prefix}css/style.css`);
        expect(content).toContain(`${prefix}js/greensock/TweenMax.min.js`);
        expect(content).toContain('fonts.googleapis.com');
        expect(content).toContain('font-awesome/4.6.3');

        return true;
      }),
      { numRuns: 100 }
    );
  });
});

describe('Property 5: No Google+ References in Any HTML File', () => {
  // Feature: github-pages-migration, Property 5: No Google+ references in any HTML file
  test('no HTML file contains Google+ links or icons', () => {
    const htmlFiles = getAllHtmlFiles();

    fc.assert(
      fc.property(fc.constantFrom(...htmlFiles), (filePath) => {
        const content = getFileContent(filePath);
        expect(content).not.toContain('plus.google.com');
        expect(content).not.toContain('fa-google-plus');
        return true;
      }),
      { numRuns: 100 }
    );
  });
});

describe('Property 6: All Iframes Have loading="lazy"', () => {
  // Feature: github-pages-migration, Property 6: All iframes have loading="lazy"
  test('every iframe in every HTML file has loading="lazy"', () => {
    const htmlFiles = getAllHtmlFiles();

    fc.assert(
      fc.property(fc.constantFrom(...htmlFiles), (filePath) => {
        const $ = parseHtml(filePath);
        $('iframe').each((_: number, el: any) => {
          const loading = $(el).attr('loading');
          expect(loading).toBe('lazy');
        });
        return true;
      }),
      { numRuns: 100 }
    );
  });
});

describe('Property 7: Each Page Has the Correct Title', () => {
  // Feature: github-pages-migration, Property 7: Each page has the correct title
  test('every HTML file has the expected page title', () => {
    for (const [relPath, expectedTitle] of Object.entries(EXPECTED_TITLES)) {
      const filePath = path.join(ROOT, relPath);
      if (fs.existsSync(filePath)) {
        const $ = parseHtml(filePath);
        const actualTitle = $('title').text().trim();
        expect(actualTitle).toBe(expectedTitle);
      }
    }
  });
});

describe('Property 8: Inner Page Asset Paths Use ../ Prefix', () => {
  // Feature: github-pages-migration, Property 8: Inner page asset paths use ../ prefix
  test('all inner pages use ../ prefix for local assets', () => {
    const htmlFiles = getAllHtmlFiles().filter(isInnerPage);
    expect(htmlFiles.length).toBeGreaterThan(0);

    fc.assert(
      fc.property(fc.constantFrom(...htmlFiles), (filePath) => {
        const $ = parseHtml(filePath);

        // Check logo link
        const brandHref = $('a.navbar-brand').attr('href');
        expect(brandHref).toBe('../');

        // Check CSS links
        $('link[rel="stylesheet"]').each((_: number, el: any) => {
          const href = $(el).attr('href') || '';
          if (!href.startsWith('http') && !href.startsWith('//')) {
            expect(href).toMatch(/^\.\.\//);
          }
        });

        // Check local JS scripts
        $('script[src]').each((_: number, el: any) => {
          const src = $(el).attr('src') || '';
          if (!src.startsWith('http') && !src.startsWith('//')) {
            expect(src).toMatch(/^\.\.\//);
          }
        });

        return true;
      }),
      { numRuns: 100 }
    );
  });
});

describe('Property 9: Footer Contact Information Preserved in Every HTML File', () => {
  // Feature: github-pages-migration, Property 9: Footer contact information preserved in every HTML file
  test('every HTML file contains required contact information', () => {
    const htmlFiles = getAllHtmlFiles();

    fc.assert(
      fc.property(fc.constantFrom(...htmlFiles), (filePath) => {
        const content = getFileContent(filePath);
        expect(content).toContain('+91 44 4744 7053');
        expect(content).toContain('+91 98400 23191');
        expect(content).toContain('saugata@lit.academy');
        expect(content).toContain('SIPCOT, Siruseri');
        return true;
      }),
      { numRuns: 100 }
    );
  });
});

describe('Property 10: Bootstrap Tab Targets Are Self-Contained', () => {
  // Feature: github-pages-migration, Property 10: Bootstrap tab targets are self-contained
  test('every Bootstrap tab link has a matching id in the same file', () => {
    const htmlFiles = getAllHtmlFiles();

    fc.assert(
      fc.property(fc.constantFrom(...htmlFiles), (filePath) => {
        const $ = parseHtml(filePath);
        $('[data-toggle="tab"]').each((_: number, el: any) => {
          const href = $(el).attr('href') || '';
          if (href.startsWith('#')) {
            const targetId = href.slice(1);
            const target = $(`#${targetId}`);
            expect(target.length).toBeGreaterThan(0);
          }
        });
        return true;
      }),
      { numRuns: 100 }
    );
  });
});
