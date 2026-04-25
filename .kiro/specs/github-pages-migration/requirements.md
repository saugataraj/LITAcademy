# Requirements Document

## Introduction

LIT Academy is a consultancy that establishes Innovation Labs within educational institutions. Its marketing website is currently hosted on Wasmer (PHP shared hosting) and built with PHP server-side includes, Bootstrap 3, jQuery, GreenSock TweenMax animations, superscrollorama scroll animations, and a Nivo Slider image carousel.

This migration converts the site to a fully static HTML website suitable for GitHub Pages (free static hosting). The conversion involves flattening PHP templates into standalone HTML files, replacing the PHP mail handler with an embedded Google Form, removing sensitive files from the repository, and re-pointing the GoDaddy-managed custom domain to GitHub Pages after deployment.

The visual appearance, all animations, and all content must be preserved exactly. No new features are introduced; this is a hosting platform change only.

---

## Glossary

- **Site**: The LIT Academy marketing website at lit.academy.
- **Static_Site**: The output of this migration — a collection of plain HTML, CSS, JS, and asset files with no server-side code.
- **GitHub_Pages**: GitHub's free static-site hosting service, serving files from a repository branch.
- **PHP_Template**: The existing `header.php` / `footer.php` include system used to share navigation and footer markup across pages.
- **Flat_HTML**: A standalone `.html` file that contains the full page markup (head, header, body, footer) without any server-side includes.
- **Clean_URL**: A URL pattern where `/about/` is served by `about/index.html`, avoiding `.html` extensions in the address bar.
- **Google_Form**: An embedded Google Forms iframe used to replace the PHP mail handler for contact submissions.
- **Newsletter_Form**: The "Subscribe & Follow" email input form currently present on the homepage with no backend wired up.
- **Preloader**: The full-screen white overlay with a spinner GIF shown on page load, currently delayed by a hardcoded 2-second `setTimeout`.
- **Sticky_Nav**: The navigation bar that becomes fixed at the top of the viewport after the user scrolls past 400 px on the homepage.
- **GreenSock**: The TweenMax / TweenLite animation library used for scroll-triggered entrance animations on the homepage.
- **Superscrollorama**: The jQuery scroll-animation controller plugin (`jquery.superscrollorama.js`) that triggers GreenSock tweens on scroll position.
- **Nivo_Slider**: The jQuery image-slider plugin (`jquery.nivo.slider.js`) used for the homepage banner.
- **Sensitive_File**: Any file that exposes server credentials, hosting account details, internal paths, or a functional PHP mail handler — specifically `error_log`, `app.yaml`, `contactForm.php`, and `advantage - Copy.php`.
- **CNAME_File**: A plain-text file named `CNAME` placed at the repository root, containing the custom domain name, required by GitHub Pages for custom domain routing.
- **GoDaddy_DNS**: The DNS management panel at GoDaddy where A records and CNAME records for the lit.academy domain are configured.
- **Wasmer**: The current PHP hosting provider being decommissioned after the migration.

---

## Requirements

### Requirement 1: Remove Sensitive Files Before First Commit

**User Story:** As the site owner, I want sensitive server files removed from the repository before it is made public, so that hosting credentials, server paths, and the PHP mail handler are never exposed in the public Git history.

#### Acceptance Criteria

1. THE Static_Site repository SHALL NOT contain `error_log` at any path.
2. THE Static_Site repository SHALL NOT contain `app.yaml` at any path.
3. THE Static_Site repository SHALL NOT contain `contactForm.php` at any path.
4. THE Static_Site repository SHALL NOT contain `advantage - Copy.php` at any path.
5. THE Static_Site repository SHALL contain a `.gitignore` file at the repository root.
6. WHEN a file matching `error_log`, `*.yaml`, `*Form.php`, or `* - Copy.*` is staged for commit, THE `.gitignore` SHALL cause Git to ignore it automatically.

---

### Requirement 2: Flatten PHP Templates to Static HTML

**User Story:** As a developer, I want every PHP page converted to a self-contained HTML file, so that the site can be served by GitHub Pages without any server-side processing.

#### Acceptance Criteria

1. THE Static_Site SHALL contain an `index.html` file at the repository root that is equivalent in markup and content to the current `index.php` after PHP includes are resolved.
2. FOR EACH page listed in the sitemap (about, why-us, advantage, how-we-work, derivatives, who-we-are, engagement, measurement, social-advantage, contact), THE Static_Site SHALL contain a corresponding `{page-slug}/index.html` file.
3. THE Flat_HTML for each page SHALL include the full contents of `header.php` and `footer.php` inline, with all PHP variable interpolations (`$pageTitle`, `$currentPage`, `$page`) replaced by their correct static values for that page.
4. THE Flat_HTML for each page SHALL NOT contain any `<?php` tags, `include()` calls, or other server-side directives.
5. WHEN a browser requests `/about/`, THE GitHub_Pages server SHALL serve `about/index.html` without requiring a `.html` extension in the URL.

---

### Requirement 3: Update All Internal Links to Static Paths

**User Story:** As a visitor, I want all navigation links and footer links to work correctly on the static site, so that I can browse between pages without encountering broken links.

#### Acceptance Criteria

1. THE Static_Site SHALL NOT contain any hyperlink `href` attribute whose value ends in `.php`.
2. WHEN a navigation link points to an inner-page section (e.g. `advantage.php#students`), THE Static_Site SHALL update that link to the equivalent clean URL (e.g. `../advantage/#students` or `/advantage/#students`).
3. THE footer navigation in every Flat_HTML file SHALL use relative or root-relative paths that resolve correctly from the file's folder-based location.
4. THE homepage `index.html` single-page navigation links (e.g. `href="#aboutUs"`) SHALL remain as anchor links and SHALL NOT be changed to external page links.
5. THE `navbar-brand` logo link in every Flat_HTML file SHALL point to `/` or `../` (resolving to the homepage) rather than `index.php`.

---

### Requirement 4: Preserve All Visual Appearance and Animations

**User Story:** As the site owner, I want the migrated site to look and behave identically to the current PHP site, so that visitors notice no difference after the hosting change.

#### Acceptance Criteria

1. THE Static_Site SHALL include all existing CSS files (`bootstrap.min.css`, `bootstrap-theme.min.css`, `default.css`, `nivo-slider.css`, `style.css`) without modification.
2. THE Static_Site SHALL include all existing JavaScript files (`TweenMax.min.js`, `jquery.superscrollorama.js`, `jquery.nivo.slider.js`, `singlePageNav.js`, `custom.js`, `bootstrap.min.js`) without modification.
3. THE Static_Site SHALL include all existing image assets in the `img/` directory without modification.
4. WHEN a visitor loads the homepage, THE Nivo_Slider SHALL display the banner image and operate as it does on the current site.
5. WHEN a visitor scrolls the homepage, THE Superscrollorama SHALL trigger GreenSock entrance animations for each section (`#aboutUs`, `#whyUs`, `#advantage`, `#howWeWork`, `#derivatives`, `#contact`) as they do on the current site.
6. WHEN a visitor scrolls past 400 px on the homepage, THE Sticky_Nav SHALL animate into view and remain fixed at the top of the viewport.
7. THE Static_Site SHALL preserve all hover effects defined in `style.css`, including the `hvr-overline-from-center` link underline animation and the advantage-card 3D flip animation.
8. THE Static_Site SHALL preserve all favicon link tags and the `favicon/` directory without modification.
9. THE Static_Site SHALL preserve all Google Fonts stylesheet links in the `<head>` of every page.
10. THE Static_Site SHALL preserve the Font Awesome 4.6.3 CDN stylesheet link in the `<head>` of every page.

---

### Requirement 5: Remove the Hardcoded Preloader Delay

**User Story:** As a visitor, I want the loading spinner to disappear as soon as the page assets are ready, so that I am not forced to wait an unnecessary 2 seconds before seeing the homepage content.

#### Acceptance Criteria

1. THE `index.html` homepage SHALL NOT contain the `$('#status').delay(2000).fadeOut()` call.
2. THE `index.html` homepage SHALL NOT contain the `$('#preloader').delay(2000).fadeOut('slow')` call.
3. WHEN the browser fires the `window.load` event on the homepage, THE Preloader SHALL begin fading out immediately (delay of 0 ms or no delay argument).

---

### Requirement 6: Replace PHP Contact Form with Google Form Embed

**User Story:** As a visitor, I want to be able to submit an enquiry through the contact page, so that I can reach LIT Academy without the site requiring a PHP mail handler.

#### Acceptance Criteria

1. THE `contact/index.html` page SHALL NOT contain an HTML `<form>` element that posts to `contactForm.php` or any other server-side endpoint.
2. THE `index.html` homepage contact section SHALL NOT contain an HTML `<form>` element that posts to `contactForm.php`.
3. THE `contact/index.html` page SHALL contain a Google_Form `<iframe>` embed in place of the removed PHP-backed form.
4. THE `index.html` homepage contact section SHALL contain a Google_Form `<iframe>` embed in place of the removed PHP-backed form.
5. THE Google_Form iframe SHALL have `width="100%"` and a minimum `height` of 600 px to be usable on desktop and mobile viewports.
6. THE Google_Form iframe SHALL include the `loading="lazy"` attribute.
7. WHEN a visitor submits the Google_Form, THE form SHALL deliver the submission to the site owner's email address via Google Forms' built-in notification mechanism (no server-side code required).

---

### Requirement 7: Handle the Newsletter Form

**User Story:** As the site owner, I want the newsletter subscription form either connected to a real service or cleanly removed, so that visitors are not presented with a non-functional UI element.

#### Acceptance Criteria

1. THE `index.html` homepage SHALL NOT contain the `#newsletter` section's `<form>` element with `action="#"` and no backend integration, unless it is replaced with a functional embed.
2. WHERE a newsletter service (e.g. Mailchimp, ConvertKit) is configured, THE Static_Site SHALL replace the existing form markup with the service's embed code.
3. IF no newsletter service is configured, THEN THE Static_Site SHALL remove the entire `#newsletter` section from `index.html` rather than leaving a non-functional form.

---

### Requirement 8: Remove Dead Google+ Social Link

**User Story:** As a visitor, I want the footer social links to point only to active platforms, so that I do not encounter a broken or dead link.

#### Acceptance Criteria

1. THE footer markup in every Flat_HTML file SHALL NOT contain a link to `plus.google.com`.
2. THE footer markup in every Flat_HTML file SHALL NOT contain the `<i class="fa fa-google-plus">` icon element.
3. THE footer markup SHALL retain the Facebook link (`https://www.facebook.com/LIT-Academy-1154447691296167/`) unchanged.
4. THE footer markup SHALL retain the Twitter link (`https://twitter.com/academy_lit`) unchanged.

---

### Requirement 9: Add `loading="lazy"` to the Google Maps Iframe

**User Story:** As a visitor on a slow connection, I want the Google Maps embed to load lazily, so that it does not block the initial page render.

#### Acceptance Criteria

1. THE Google Maps `<iframe>` in `index.html` SHALL include the attribute `loading="lazy"`.
2. THE Google Maps `<iframe>` SHALL retain all existing attributes (`src`, `width`, `height`, `frameborder`, `style`, `allowfullscreen`) unchanged.

---

### Requirement 10: Configure GitHub Pages Custom Domain

**User Story:** As the site owner, I want the GitHub Pages deployment to serve the site at the lit.academy custom domain, so that visitors continue to reach the site at the same URL after the hosting migration.

#### Acceptance Criteria

1. THE Static_Site repository root SHALL contain a file named `CNAME` with the single line `lit.academy` and no trailing whitespace or blank lines.
2. THE `CNAME` file SHALL be committed to the branch configured as the GitHub Pages source branch.
3. THE `.gitignore` SHALL NOT include a rule that would cause Git to ignore the `CNAME` file.

---

### Requirement 11: Document GoDaddy DNS Cutover Steps

**User Story:** As the site owner, I want clear written instructions for updating GoDaddy DNS after GitHub Pages is live, so that I can perform the domain cutover without making errors.

#### Acceptance Criteria

1. THE Static_Site repository SHALL contain a `MIGRATION.md` file at the repository root documenting the GoDaddy DNS cutover procedure.
2. THE `MIGRATION.md` SHALL specify that an A record for the apex domain (`@`) must be added pointing to each of the four GitHub Pages IP addresses: `185.199.108.153`, `185.199.109.153`, `185.199.110.153`, `185.199.111.153`.
3. THE `MIGRATION.md` SHALL specify that a CNAME record for `www` must be added pointing to `<github-username>.github.io`.
4. THE `MIGRATION.md` SHALL specify that the existing Wasmer A/CNAME records must be removed or replaced, not duplicated.
5. THE `MIGRATION.md` SHALL note that DNS propagation may take up to 48 hours and that HTTPS provisioning via Let's Encrypt on GitHub Pages may take up to 24 hours after DNS propagation.
6. THE `MIGRATION.md` SHALL include a step to enable "Enforce HTTPS" in the GitHub Pages repository settings after the custom domain is verified.

---

### Requirement 12: Preserve Intentional Public Contact Information

**User Story:** As a visitor, I want to see LIT Academy's phone number and email address in the footer, so that I can contact them directly without using the web form.

#### Acceptance Criteria

1. THE footer in every Flat_HTML file SHALL retain the phone numbers `+91 44 4744 7053` and `+91 98400 23191` exactly as they appear in the current `footer.php`.
2. THE footer in every Flat_HTML file SHALL retain the `mailto:saugata@lit.academy` email link exactly as it appears in the current `footer.php`.
3. THE footer in every Flat_HTML file SHALL retain the physical address (GA1, 407, Creation Genesis Apartment, SIPCOT, Siruseri, OMR, Chennai - 600 130) exactly as it appears in the current `footer.php`.

---

### Requirement 13: Validate Static Site Integrity

**User Story:** As a developer, I want to verify that the migrated static site has no broken internal links or missing assets, so that visitors do not encounter 404 errors after the migration.

#### Acceptance Criteria

1. WHEN the Static_Site is served locally (e.g. via `npx serve` or Python's `http.server`), THE browser SHALL load every page without any 404 errors in the browser console for local assets (CSS, JS, images, fonts from `favicon/`).
2. THE Static_Site SHALL NOT reference any file path ending in `.php` in any `href`, `src`, `action`, or `data-*` attribute across all HTML files.
3. FOR EACH tab-panel anchor link in `advantage/index.html`, `how-we-work/index.html`, `derivatives/index.html`, and `who-we-are/index.html`, THE corresponding `id` attribute SHALL exist in the same file so that Bootstrap tab navigation functions correctly.
4. THE `<title>` element of each Flat_HTML file SHALL contain the correct page-specific title (e.g. `About us | LIT Academy`, `How we work | LIT Academy`) matching the values previously set by `$pageTitle` in the PHP source.
