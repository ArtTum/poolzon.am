# POOLZON

POOLZON is a Laravel 12 application running on PHP 8.2+ with a Vue 2 admin UI built by Vite.

## Requirements

- PHP 8.2 or newer
- Composer 2
- MariaDB 10.4+ or MySQL 8+
- Node.js 20.19+ or 22.12+

## Local setup

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
```

Create the `poolzon_am` database and restore the current production SQL dump, then run:

```bash
php artisan migrate
npm run build
php artisan serve
```

For front-end development, use `npm run dev`. Ameriabank credentials and the reCAPTCHA secret belong in `.env`; never commit them.

## Verification

```bash
php artisan test
composer audit
npm audit --audit-level=moderate
```
