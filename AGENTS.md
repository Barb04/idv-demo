# AGENTS.md

## Project identity
- **Name**: idv-demo — Jumio identity verification (KYC/KYB) demo app
- **Stack**: vanilla PHP (no framework, no Composer), nginx + PHP-FPM
- **Owner**: customer-engineering / Sechpoint

## Repo setup
- **Git remote**: `https://git.sechpoint.app/customer-engineering/idv-demo.git`
- **Credentials**: source `~/bin/.gitenv` for `GIT_USER_NAME`, `GIT_USER_EMAIL`, `GIT_TOKEN`
- **Default branch**: `main`
- **Commit prefix convention**: `chore:`

## Architecture (non-obvious)

```
html/           → web root (deploys as /var/www/html/public — see nginx config)
  index.php     → single entry point (front controller)
  class/        → core: config.php, site.php (session init), functions.php
  app/
    controler/  → routing: start.php (GET pages), request.php (POST actions)
    model/      → Jumio API calls: M01.php, M04.php, docv.php, retrival_1.php, retrival_2.php, success.php
    view/       → .phtml templates (header, footer, pages 00–04, loader, results)
  cdn/          → static assets (JS includes iovation/IGLOO blackbox)
  lng/          → language strings: en/ (default), de/
nginx/           → nginx site config (serves from /var/www/html/public, PHP-FPM via socket)
```

- **No build tools, no tests, no CI/CD, no package manager** — it's raw PHP.
- Routing: URL segments drive pages (`$PARAMS[1]` in start.php); POST/GET `do` parameter drives actions (request.php).
- Jumio workflow: M01 (ID verification) → docv (document verification) → retrival → results.

## Dev mode
- Hostname starting with `dev` sets `DEBUG = TRUE` (`html/class/config.php` line 28).
- When DEBUG is true, `debug_log()` writes to `html/log/YYYYMM.log`. The `log/` directory must exist and be writable.

## Secrets warning
- `html/class/config.php` contains hardcoded Jumio API credentials. **Do not commit to public repos.**

## Nginx
- Active config: `nginx/default.conf`
- PHP-FPM socket: `unix:/run/php-fpm.sock`
- Clean URLs via `try_files $uri $uri/ /index.php?$args`
- Stale backup files in `nginx/`: `default_old.conf`, `default.conf.bak`, `default.bak.3.conf`

## Gotchas
- Filename `retrival` is intentionally misspelled (not "retrieval") — used consistently in `retrival_1.php`, `retrival_2.php`, and session keys.
- `html/` contains `.DS_Store` (macOS artifact) — should be gitignored.
