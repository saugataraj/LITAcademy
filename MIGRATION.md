# Migration Guide: Wasmer → GitHub Pages

This document describes the steps to move the LIT Academy website from Wasmer hosting to GitHub Pages, and to update the GoDaddy DNS records so that `lit.academy` points to the new host.

---

## Step 1: Prepare the GitHub Repository

1. Create a new public GitHub repository (e.g. `lit-academy-website`) under your GitHub account.
2. Push the static site files to the `main` branch (or a dedicated `gh-pages` branch — your choice).
3. Confirm the `CNAME` file exists at the repository root containing exactly `lit.academy`.

---

## Step 2: Enable GitHub Pages

1. Go to the repository on GitHub.
2. Click **Settings** → **Pages** (in the left sidebar).
3. Under **Source**, select the branch you pushed to (e.g. `main`) and set the folder to `/ (root)`.
4. Click **Save**.
5. GitHub will display a URL like `https://<github-username>.github.io/<repo-name>/` — this confirms Pages is active.
6. Under **Custom domain**, enter `lit.academy` and click **Save**.
   - GitHub will create or verify the `CNAME` file automatically.
   - Do **not** enable "Enforce HTTPS" yet — wait until DNS propagation is complete.

---

## Step 3: Update GoDaddy DNS Records

Log in to GoDaddy → **My Products** → **DNS** for `lit.academy`.

### 3.1 Add A Records for the Apex Domain (`@`)

Add **four** A records pointing the root domain to GitHub Pages:

| Type | Name | Value            | TTL  |
|------|------|------------------|------|
| A    | @    | 185.199.108.153  | 600  |
| A    | @    | 185.199.109.153  | 600  |
| A    | @    | 185.199.110.153  | 600  |
| A    | @    | 185.199.111.153  | 600  |

### 3.2 Add a CNAME Record for `www`

| Type  | Name | Value                    | TTL  |
|-------|------|--------------------------|------|
| CNAME | www  | `saugataraj.github.io`   | 600  |

**Important:** Use `saugataraj.github.io` — do NOT include the repository path (`/LITAcademy/`). GitHub Pages maps the custom domain directly to the repo content, so the subdirectory path is not needed here.

### 3.3 Remove or Replace Existing Wasmer Records

> ⚠️ **Do NOT duplicate records.** Remove or overwrite the existing A record(s) and/or CNAME record(s) that currently point to Wasmer. Leaving both sets active will cause unpredictable routing.

Typical Wasmer DNS entries to remove:
- Any A record for `@` pointing to a Wasmer IP address
- Any CNAME record for `www` pointing to a Wasmer hostname

---

## Step 4: Wait for DNS Propagation

- DNS changes can take **up to 48 hours** to propagate globally, though most resolvers update within 1–4 hours.
- You can check propagation status at [https://dnschecker.org](https://dnschecker.org) — search for `lit.academy` (A record) and `www.lit.academy` (CNAME).
- During propagation, some visitors may still reach the old Wasmer site. **Do not decommission Wasmer until propagation is confirmed complete worldwide.**

---

## Step 5: Enable HTTPS

1. After DNS propagation is confirmed, return to **GitHub Settings → Pages**.
2. GitHub Pages automatically provisions a free Let's Encrypt TLS certificate. This can take **up to 24 hours** after DNS propagation.
3. Once the certificate is provisioned, the "Enforce HTTPS" checkbox will become available.
4. Check **Enforce HTTPS** and click **Save**.
   - This redirects all `http://` traffic to `https://` automatically.

---

## Step 6: Verify the Live Site

After HTTPS is active, verify the following:

- [ ] `https://lit.academy` loads the homepage correctly
- [ ] `https://www.lit.academy` redirects to `https://lit.academy`
- [ ] All inner pages load (e.g. `https://lit.academy/about/`)
- [ ] Animations, slider, and sticky nav work as expected
- [ ] Google Form iframe is visible in the contact section
- [ ] No browser console errors for missing assets

---

## Step 7: Decommission Wasmer

Only after Step 6 is fully verified:

1. Log in to Wasmer and delete or suspend the `litacademy` app deployment.
2. Optionally cancel the Wasmer account if no longer needed.

---

## Google Form Setup (Contact Form)

The contact form on the site uses a Google Form iframe placeholder. Before going live:

1. Create a Google Form in your Google Workspace account with fields: Name, Email, Mobile, Subject, Message.
2. In Google Forms, click **Send** → **Embed** (`<>` icon) and copy the `src` URL from the iframe code.
3. In `index.html` and `contact/index.html`, replace the placeholder:
   ```
   REPLACE_WITH_YOUR_FORM_ID
   ```
   with your actual form ID from the embed URL.
4. In Google Forms → **Responses** → **Settings**, enable email notifications so submissions are delivered to the company inbox.

---

## Troubleshooting

| Issue | Likely cause | Fix |
|---|---|---|
| Site shows old Wasmer content | DNS not yet propagated | Wait and recheck with dnschecker.org |
| "Not secure" warning | HTTPS certificate not yet provisioned | Wait up to 24h after DNS propagation |
| Pages return 404 | Wrong branch selected in GitHub Pages settings | Re-check Settings → Pages → Source |
| Assets missing (unstyled pages) | Wrong branch or missing files | Confirm all CSS/JS/img files are committed |
| Custom domain not verified | CNAME file missing or wrong content | Confirm `CNAME` file contains exactly `lit.academy` |
