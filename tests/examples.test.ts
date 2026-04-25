import * as fs from 'fs';
import * as path from 'path';
import { getFileContent, parseHtml } from './helpers';

const ROOT = path.resolve(__dirname, '..');

describe('17.1 Homepage-specific behaviors', () => {
  const indexPath = path.join(ROOT, 'index.html');

  test('index.html does not contain delay(2000)', () => {
    const content = getFileContent(indexPath);
    expect(content).not.toContain('delay(2000)');
  });

  test('index.html homepage nav contains anchor links', () => {
    const content = getFileContent(indexPath);
    expect(content).toContain('href="#aboutUs"');
    expect(content).toContain('href="#whyUs"');
    expect(content).toContain('href="#advantage"');
    expect(content).toContain('href="#howWeWork"');
    expect(content).toContain('href="#derivatives"');
    expect(content).toContain('href="#contact"');
  });

  test('index.html does not contain the newsletter form', () => {
    const $ = parseHtml(indexPath);
    const newsletterForm = $('#newsletter form');
    expect(newsletterForm.length).toBe(0);
  });

  test('index.html contact section contains a Google Form iframe', () => {
    const $ = parseHtml(indexPath);
    const contactIframe = $('#contact iframe');
    expect(contactIframe.length).toBeGreaterThan(0);
  });

  test('index.html Google Maps iframe has loading="lazy"', () => {
    const $ = parseHtml(indexPath);
    const mapsIframe = $('#map iframe');
    expect(mapsIframe.length).toBeGreaterThan(0);
    expect(mapsIframe.attr('loading')).toBe('lazy');
  });

  test('index.html has body id="home"', () => {
    const $ = parseHtml(indexPath);
    expect($('body').attr('id')).toBe('home');
  });

  test('index.html has header id="mainHeader"', () => {
    const $ = parseHtml(indexPath);
    expect($('header').attr('id')).toBe('mainHeader');
  });
});

describe('17.2 Infrastructure files', () => {
  test('CNAME file exists and contains exactly lit.academy', () => {
    const cnamePath = path.join(ROOT, 'CNAME');
    expect(fs.existsSync(cnamePath)).toBe(true);
    const content = fs.readFileSync(cnamePath, 'utf8').trim();
    expect(content).toBe('lit.academy');
  });

  test('MIGRATION.md exists and contains all four GitHub Pages IP addresses', () => {
    const migrationPath = path.join(ROOT, 'MIGRATION.md');
    expect(fs.existsSync(migrationPath)).toBe(true);
    const content = fs.readFileSync(migrationPath, 'utf8');
    expect(content).toContain('185.199.108.153');
    expect(content).toContain('185.199.109.153');
    expect(content).toContain('185.199.110.153');
    expect(content).toContain('185.199.111.153');
  });

  test('.gitignore exists and contains required patterns', () => {
    const gitignorePath = path.join(ROOT, '.gitignore');
    expect(fs.existsSync(gitignorePath)).toBe(true);
    const content = fs.readFileSync(gitignorePath, 'utf8');
    expect(content).toContain('error_log');
    expect(content).toContain('*.php');
    expect(content).toContain('app.yaml');
    expect(content).toContain('.DS_Store');
  });

  test('.gitignore does not ignore CNAME', () => {
    const gitignorePath = path.join(ROOT, '.gitignore');
    const content = fs.readFileSync(gitignorePath, 'utf8');
    // CNAME should not be in gitignore
    const lines = content.split('\n').map(l => l.trim()).filter(l => l && !l.startsWith('#'));
    const wouldIgnoreCNAME = lines.some(line => {
      // Simple check: no line that would match CNAME exactly
      return line === 'CNAME' || line === 'CNAME*';
    });
    expect(wouldIgnoreCNAME).toBe(false);
  });
});

describe('17.3 Contact page Google Form iframe', () => {
  const contactPath = path.join(ROOT, 'contact', 'index.html');

  test('contact/index.html contains a Google Form iframe', () => {
    const $ = parseHtml(contactPath);
    const iframes = $('iframe');
    expect(iframes.length).toBeGreaterThan(0);
  });

  test('contact/index.html does not contain a form posting to contactForm.php', () => {
    const content = getFileContent(contactPath);
    expect(content).not.toContain('contactForm.php');
    expect(content).not.toContain('action="contactForm');
  });

  test('contact/index.html does not contain formCheck() function', () => {
    const content = getFileContent(contactPath);
    expect(content).not.toContain('function formCheck');
  });
});
