import * as fs from 'fs';
import * as path from 'path';
import { load } from 'cheerio';
import { glob } from 'glob';

const ROOT = path.resolve(__dirname, '..');

export function getAllHtmlFiles(): string[] {
  return glob.sync('**/*.html', {
    cwd: ROOT,
    ignore: ['node_modules/**', 'dist/**', '.kiro/**', 'js/**']
  }).map(f => path.join(ROOT, f));
}

export function parseHtml(filePath: string): ReturnType<typeof load> {
  const content = fs.readFileSync(filePath, 'utf8');
  return load(content);
}

export function isInnerPage(filePath: string): boolean {
  const rel = path.relative(ROOT, filePath);
  return rel.includes(path.sep) && !rel.startsWith('node_modules');
}

export function getFileContent(filePath: string): string {
  return fs.readFileSync(filePath, 'utf8');
}
