# Implementation Plan: GitHub Pages Migration

## Overview

Convert the LIT Academy PHP website (11 pages) into a fully static HTML site deployable on GitHub Pages. The work proceeds in this order: security cleanup → infrastructure files → test setup → homepage → inner pages → property-based tests → final validation. All PHP server-side includes are flattened inline; inner pages use `../` prefixes on all asset paths; the contact form is replaced with a Google Form iframe placeholder; the newsletter section, preloader delay, and Google+ link are removed.

## Tasks

- [x] 1. Security cleanup — delete sensitive files and create `.gitignore`
  - Delete `error_log` from the repository root
  - Delete `app.yaml` from the repository root
  - Delete `contactForm.php` from the repository root
  - Delete `advantage - Copy.php` from the repository root
  - Create `.gitignore` at the repository root with rules ignoring `error_log`, `*.log`, `app.yaml`, `*.yaml`, `*.php`, `*Form.php`, `* - Copy.*`, `.DS_Store`, `Thumbs.db`, `.env`, `*.env`
  - Verify the `CNAME` file is NOT matched by any `.gitignore` rule
  - _Requirements: 1.1, 1.2, 1.3, 1.4, 1.5, 1.6, 10.3_

- [x] 2. Create infrastructure files — `CNAME` and `MIGRATION.md`
  - [x] 2.1 Create `CNAME` file at repository root containing exactly `lit.academy` (single line, no trailing whitespace)
    - _Requirements: 10.1, 10.2_

  - [x] 2.2 Create `MIGRATION.md` at repository root documenting the GoDaddy DNS cutover procedure
    - Include the four GitHub Pages A-record IPs: `185.199.108.153`, `185.199.109.153`, `185.199.110.153`, `185.199.111.153`
    - Include CNAME record for `www` pointing to `<github-username>.github.io`
    - Include step to remove/replace existing Wasmer A/CNAME records (not duplicate them)
    - Note DNS propagation up to 48 hours and HTTPS provisioning up to 24 hours after propagation
    - Include step to enable "Enforce HTTPS" in GitHub Pages settings after domain is verified
    - _Requirements: 11.1, 11.2, 11.3, 11.4, 11.5, 11.6_

- [x] 3. Set up test infrastructure
  - Create `package.json` at the repository root with `devDependencies` for `fast-check`, `cheerio`, `glob`, `typescript`, `ts-node`, and `jest` (with `ts-jest` and `@types/jest`)
  - Create `tsconfig.json` configured for `ts-node` test execution (target ES2020, module CommonJS, strict mode)
  - Create `tests/` directory with a `helpers.ts` module that exports: `getAllHtmlFiles()` (uses `glob` to enumerate all `**/*.html` files), `parseHtml(filePath)` (returns a cheerio root), and `isInnerPage(filePath)` (returns true when the file is inside a subdirectory slug)
  - _Requirements: 13.1 (test infrastructure prerequisite)_

- [x] 4. Create `index.html` — homepage (from `index.php`)
  - Resolve `header.php` with `$pageTitle = 'LIT Academy'` and `$page = "home"`:
    - `<title>LIT Academy</title>`
    - `<body id="home">` and `<header id="mainHeader">`
    - Single-page nav with anchor links (`#home`, `#aboutUs`, `#whyUs`, `#advantage`, `#howWeWork`, `#derivatives`, `#contact`)
    - All asset paths bare (no `../` prefix): `css/bootstrap.min.css`, `img/logo.png`, `js/bootstrap.min.js`, `favicon/…`, etc.
    - `navbar-brand` logo link points to `index.html` or `/`
  - Inline all body content from `index.php` verbatim
  - Update internal `href` links in body: `aboutus.php` → `about/`, `whyus.php` → `why-us/`, `advantage.php` → `advantage/`, `advantage.php#students` → `advantage/#students`, `advantage.php#faculty` → `advantage/#faculty`, `advantage.php#institution` → `advantage/#institution`, `how_we_work.php` → `how-we-work/`, `derivates.php` → `derivatives/`
  - Remove the entire `#newsletter` `<section>` block (including the `<form action="#">`)
  - Remove the `formCheck()` JavaScript function
  - Replace the `<form action="contactForm.php">` in `#contact` with the Google Form iframe placeholder (width 100%, height 600, loading="lazy", comment above)
  - Add `loading="lazy"` to the Google Maps `<iframe>` in `#map`
  - Inline `footer.php` content:
    - Remove the Google+ `<li>` (the `plus.google.com` link and `fa-google-plus` icon)
    - Update all footer `href` links: `index.php` → `/`, `aboutus.php` → `about/`, `whyus.php` → `why-us/`, `advantage.php` → `advantage/`, `how_we_work.php` → `how-we-work/`, `derivates.php` → `derivatives/`, `contactus.php` → `contact/`, `derivates.php#presenter` → `derivatives/#presenter`, `derivates.php#designer` → `derivatives/#designer`, `derivates.php#technologist` → `derivatives/#technologist`, `derivates.php#entrepreneur` → `derivatives/#entrepreneur`, `derivates.php#innovator` → `derivatives/#innovator`, `derivates.php#inclusive` → `derivatives/#inclusive`, `social_industrial_advantages.php` → `social-advantage/`
    - Retain phone numbers, email, and physical address exactly
  - In the `$(window).load` script, remove both `delay(2000)` calls: `$('#status').fadeOut()` and `$('#preloader').fadeOut('slow')`
  - _Requirements: 2.1, 2.3, 2.4, 3.1, 3.4, 3.5, 4.1, 4.2, 4.3, 4.4, 4.5, 4.6, 4.7, 4.8, 4.9, 4.10, 5.1, 5.2, 5.3, 6.2, 6.4, 6.5, 6.6, 7.1, 7.3, 8.1, 8.2, 8.3, 8.4, 9.1, 9.2, 12.1, 12.2, 12.3, 13.2, 13.4_

- [x] 5. Create `about/index.html` (from `aboutus.php`)
  - Resolve `header.php` with `$pageTitle = 'About us | LIT Academy'`, `$currentPage = 'aboutus'`, no `$page`:
    - `<body>` with no `id`, `<header>` with no `id`
    - Multi-page nav; `aboutus` nav item gets `class="active"`
    - All asset paths prefixed with `../`: `../css/bootstrap.min.css`, `../img/logo.png`, `../js/bootstrap.min.js`, `../favicon/…`, etc.
    - `navbar-brand` logo link: `../`
    - Nav links: `../` (Home), `../about/` (About us — active), `../why-us/`, `../advantage/`, `../how-we-work/`, `../derivatives/`, `../contact/`
  - Inline body content from `aboutus.php` verbatim; update `img/` src paths to `../img/`
  - Inline `footer.php` with `../` prefixes on all asset paths and nav/footer links (same link mapping as homepage footer, but with `../` prefix)
  - Remove Google+ link from footer; retain Facebook and Twitter links
  - _Requirements: 2.2, 2.3, 2.4, 3.1, 3.3, 3.5, 4.1, 4.2, 4.8, 4.9, 4.10, 8.1, 8.2, 8.3, 8.4, 12.1, 12.2, 12.3, 13.2, 13.4_

- [x] 6. Create `why-us/index.html` (from `whyus.php`)
  - Resolve `header.php` with `$pageTitle = 'Why us | LIT Academy'`, `$currentPage = 'whyus'`
  - Apply same `../` prefix pattern as task 5; `whyus` nav item gets `class="active"`
  - Inline body content from `whyus.php`; update `img/` src paths to `../img/`
  - Inline footer with `../` prefixes; remove Google+ link
  - _Requirements: 2.2, 2.3, 2.4, 3.1, 3.3, 3.5, 8.1, 8.2, 12.1, 12.2, 12.3, 13.2, 13.4_

- [x] 7. Create `advantage/index.html` (from `advantage.php`)
  - Resolve `header.php` with `$pageTitle = 'Advantages | LIT Academy'`, `$currentPage = 'advantages'`
  - Apply `../` prefix pattern; `advantages` nav item gets `class="active"`
  - Inline body content from `advantage.php`; update `img/` src paths to `../img/`
  - Verify Bootstrap tab targets `#students`, `#faculty`, `#institution` all have matching `id` attributes in the same file
  - Inline footer with `../` prefixes; remove Google+ link
  - _Requirements: 2.2, 2.3, 2.4, 3.1, 3.3, 3.5, 8.1, 8.2, 12.1, 12.2, 12.3, 13.2, 13.3, 13.4_

- [x] 8. Create `how-we-work/index.html` (from `how_we_work.php`)
  - Resolve `header.php` with `$pageTitle = 'How we work | LIT Academy'`, `$currentPage = 'howwework'`
  - Apply `../` prefix pattern; `howwework` nav item gets `class="active"`
  - Inline body content from `how_we_work.php`; update `img/` src paths to `../img/`
  - Verify Bootstrap tab targets `#modality`, `#governing`, `#participants`, `#topics`, `#methodology`, `#industries`, `#enhancement`, `#Social`, `#rd` all have matching `id` attributes in the same file
  - Inline footer with `../` prefixes; remove Google+ link
  - _Requirements: 2.2, 2.3, 2.4, 3.1, 3.3, 3.5, 8.1, 8.2, 12.1, 12.2, 12.3, 13.2, 13.3, 13.4_

- [x] 9. Create `derivatives/index.html` (from `derivates.php`)
  - Resolve `header.php` with `$pageTitle = 'Derivatives | LIT Academy'`, `$currentPage = 'derivatives'`
  - Apply `../` prefix pattern; `derivatives` nav item gets `class="active"`
  - Inline body content from `derivates.php`; update `img/` src paths to `../img/`
  - Verify Bootstrap tab targets `#presenter`, `#designer`, `#technologist`, `#entrepreneur`, `#innovator`, `#inclusive` all have matching `id` attributes in the same file
  - Inline footer with `../` prefixes; remove Google+ link
  - _Requirements: 2.2, 2.3, 2.4, 3.1, 3.3, 3.5, 8.1, 8.2, 12.1, 12.2, 12.3, 13.2, 13.3, 13.4_

- [x] 10. Create `who-we-are/index.html` (from `who_are_we.php`)
  - Resolve `header.php` with `$pageTitle = 'Who are we | LIT Academy'`, no `$currentPage`
  - Apply `../` prefix pattern; no nav item is active
  - Inline body content from `who_are_we.php`; update `img/` src paths to `../img/` (note: `img/saugata.png` → `../img/saugata.png`)
  - Verify Bootstrap tab targets `#saugata`, `#rajesh`, `#prasad` all have matching `id` attributes in the same file
  - Inline footer with `../` prefixes; remove Google+ link
  - _Requirements: 2.2, 2.3, 2.4, 3.1, 3.3, 3.5, 8.1, 8.2, 12.1, 12.2, 12.3, 13.2, 13.3, 13.4_

- [x] 11. Create `engagement/index.html` (from `engagement_cycle.php`)
  - Resolve `header.php` with `$pageTitle = 'Engagement cycle | LIT Academy'`, no `$currentPage`
  - Apply `../` prefix pattern; no nav item is active
  - Inline body content from `engagement_cycle.php`; update `img/` src paths to `../img/`
  - Inline footer with `../` prefixes; remove Google+ link
  - _Requirements: 2.2, 2.3, 2.4, 3.1, 3.3, 3.5, 8.1, 8.2, 12.1, 12.2, 12.3, 13.2, 13.4_

- [x] 12. Create `measurement/index.html` (from `measurement.php`)
  - Resolve `header.php` with `$pageTitle = 'Measurement | LIT Academy'`, no `$currentPage`
  - Apply `../` prefix pattern; no nav item is active
  - Inline body content from `measurement.php`; update `img/` src paths to `../img/`
  - Inline footer with `../` prefixes; remove Google+ link
  - _Requirements: 2.2, 2.3, 2.4, 3.1, 3.3, 3.5, 8.1, 8.2, 12.1, 12.2, 12.3, 13.2, 13.4_

- [x] 13. Create `social-advantage/index.html` (from `social_industrial_advantages.php`)
  - Resolve `header.php` with `$pageTitle = 'Social industrial advantages | LIT Academy'`, no `$currentPage`
  - Apply `../` prefix pattern; no nav item is active
  - Inline body content from `social_industrial_advantages.php`; update `img/` src paths to `../img/`
  - Inline footer with `../` prefixes; remove Google+ link
  - _Requirements: 2.2, 2.3, 2.4, 3.1, 3.3, 3.5, 8.1, 8.2, 12.1, 12.2, 12.3, 13.2, 13.4_

- [x] 14. Create `contact/index.html` (from `contactus.php`)
  - Resolve `header.php` with `$pageTitle = 'Contact us | LIT Academy'`, `$currentPage = 'contactus'`
  - Apply `../` prefix pattern; `contactus` nav item gets `class="active"`
  - Inline body content from `contactus.php`; update `img/` src paths to `../img/`
  - Remove the `formCheck()` JavaScript function
  - Replace the `<form action="contactForm.php">` with the Google Form iframe placeholder (width 100%, height 600, loading="lazy", comment above)
  - Inline footer with `../` prefixes; remove Google+ link
  - _Requirements: 2.2, 2.3, 2.4, 3.1, 3.3, 3.5, 6.1, 6.3, 6.5, 6.6, 8.1, 8.2, 12.1, 12.2, 12.3, 13.2, 13.4_

- [x] 15. Checkpoint — verify all pages exist and spot-check paths
  - Confirm all 11 HTML files exist: `index.html` plus the 10 slug directories
  - Spot-check that no file contains `<?php`, `.php` in any href/src/action, `plus.google.com`, or `fa-google-plus`
  - Spot-check that inner pages use `../css/`, `../js/`, `../img/`, `../favicon/` prefixes
  - Ensure all tests pass, ask the user if questions arise.

- [x] 16. Write property-based tests
  - [x] 16.1 Write property test for Property 1 — no sensitive files in output tree
    - Use `fc.constantFrom(...getAllHtmlFiles())` to enumerate files; also check the directory listing for `error_log`, `app.yaml`, `contactForm.php`, `advantage - Copy.php`
    - **Property 1: No Sensitive Files in Output**
    - **Validates: Requirements 1.1, 1.2, 1.3, 1.4**

  - [ ]* 16.2 Write property test for Property 2 — no PHP references in any HTML file
    - For each HTML file, assert content does not contain `<?php`, `include(`, `require(`; parse with cheerio and assert no `href`/`src`/`action`/`data-*` attribute ends in `.php`
    - **Property 2: No PHP References in Any HTML File**
    - **Validates: Requirements 2.4, 3.1, 6.1, 6.2, 13.2**

  - [ ]* 16.3 Write property test for Property 3 — all sitemap pages exist
    - Assert `index.html` exists; assert each of the 10 slug `index.html` files exists (`about`, `why-us`, `advantage`, `how-we-work`, `derivatives`, `who-we-are`, `engagement`, `measurement`, `social-advantage`, `contact`)
    - **Property 3: All Sitemap Pages Exist**
    - **Validates: Requirements 2.1, 2.2**

  - [ ]* 16.4 Write property test for Property 4 — required asset link tags present in every HTML file
    - For each HTML file, parse `<head>` and assert presence of links/scripts for `bootstrap.min.css`, `bootstrap-theme.min.css`, `default.css`, `nivo-slider.css`, `style.css`, `TweenMax.min.js`, Google Fonts URL, Font Awesome 4.6.3 CDN URL; assert inner pages use `../` prefix
    - **Property 4: Required Asset Link Tags Present in Every HTML File**
    - **Validates: Requirements 4.1, 4.2, 4.9, 4.10**

  - [ ]* 16.5 Write property test for Property 5 — no Google+ references in any HTML file
    - For each HTML file, assert content does not contain `plus.google.com` or `fa-google-plus`
    - **Property 5: No Google+ References in Any HTML File**
    - **Validates: Requirements 8.1, 8.2**

  - [ ]* 16.6 Write property test for Property 6 — all iframes have `loading="lazy"`
    - For each HTML file, parse all `<iframe>` elements with cheerio and assert each has `loading="lazy"`
    - **Property 6: All Iframes Have loading="lazy"**
    - **Validates: Requirements 6.6, 9.1**

  - [ ]* 16.7 Write property test for Property 7 — each page has the correct title
    - Use a map of expected titles keyed by file path; for each entry assert `$('title').text()` equals the expected string exactly
    - Expected titles: `index.html` → `LIT Academy`; `about/index.html` → `About us | LIT Academy`; `why-us/index.html` → `Why us | LIT Academy`; `advantage/index.html` → `Advantages | LIT Academy`; `how-we-work/index.html` → `How we work | LIT Academy`; `derivatives/index.html` → `Derivatives | LIT Academy`; `who-we-are/index.html` → `Who are we | LIT Academy`; `engagement/index.html` → `Engagement cycle | LIT Academy`; `measurement/index.html` → `Measurement | LIT Academy`; `social-advantage/index.html` → `Social industrial advantages | LIT Academy`; `contact/index.html` → `Contact us | LIT Academy`
    - **Property 7: Each Page Has the Correct Title**
    - **Validates: Requirement 13.4**

  - [ ]* 16.8 Write property test for Property 8 — inner page asset paths use `../` prefix
    - For each inner page (any file at `{slug}/index.html`), parse all `href` and `src` attributes referencing local assets; assert each begins with `../`; assert `navbar-brand` href is `../`
    - **Property 8: Inner Page Asset Paths Use `../` Prefix**
    - **Validates: Requirements 3.3, 3.5**

  - [ ]* 16.9 Write property test for Property 9 — footer contact information preserved in every HTML file
    - For each HTML file, assert content contains `+91 44 4744 7053`, `+91 98400 23191`, `saugata@lit.academy`, and `SIPCOT, Siruseri`
    - **Property 9: Footer Contact Information Preserved in Every HTML File**
    - **Validates: Requirements 12.1, 12.2, 12.3**

  - [ ]* 16.10 Write property test for Property 10 — Bootstrap tab targets are self-contained
    - For each HTML file containing `data-toggle="tab"` links, parse each `href="#X"` value; assert an element with `id="X"` exists in the same file
    - **Property 10: Bootstrap Tab Targets Are Self-Contained**
    - **Validates: Requirement 13.3**

- [x] 17. Write example-based tests (Jest)
  - [x] 17.1 Write unit tests for specific homepage behaviors
    - Assert `index.html` does not contain `delay(2000)`
    - Assert `index.html` homepage nav contains `href="#aboutUs"` anchor links
    - Assert `index.html` does not contain the `#newsletter` `<form>` element
    - Assert `index.html` contact section contains a `<iframe>` (Google Form placeholder)
    - Assert `index.html` Google Maps `<iframe>` has `loading="lazy"`
    - _Requirements: 3.4, 5.1, 5.2, 6.4, 7.1, 9.1_

  - [ ]* 17.2 Write unit tests for infrastructure files
    - Assert `CNAME` file exists and contains exactly `lit.academy`
    - Assert `MIGRATION.md` exists and contains all four GitHub Pages IP addresses
    - Assert `.gitignore` exists and contains patterns for `error_log`, `*.php`, `app.yaml`, `.DS_Store`
    - _Requirements: 1.5, 1.6, 10.1, 11.1, 11.2_

  - [ ]* 17.3 Write unit test for contact page Google Form iframe
    - Assert `contact/index.html` contains a `<iframe>` in the contact section
    - Assert `contact/index.html` does not contain `<form` with `action="contactForm.php"`
    - _Requirements: 6.1, 6.3_

- [x] 18. Final checkpoint — run full test suite
  - Run `npx ts-node --project tsconfig.json node_modules/.bin/jest` (or equivalent) and confirm all tests pass
  - Ensure all tests pass, ask the user if questions arise.

## Notes

- Tasks marked with `*` are optional and can be skipped for faster MVP
- Each task references specific requirements for traceability
- Checkpoints ensure incremental validation
- Property tests validate universal correctness properties across all 11 HTML files
- Unit tests validate specific behaviors not covered by universal properties
- The Google Form iframe uses a placeholder URL — replace `REPLACE_WITH_YOUR_FORM_ID` with the real form ID before going live
- The `who-we-are` page references `img/saugata.png` which does not currently exist in the `img/` directory; create or source this image if needed
