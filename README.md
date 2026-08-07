# Laravel + Livewire Starter Template

A batteries-included starter template for Laravel applications: authentication, role-based access control, a CMS management area, activity logging, and media handling — all wired up and fully tested.

Built with a strict, opinionated architecture (DTOs, Action classes, strict types, and mandatory tests) so every feature you add stays consistent. See [`docs/architecture.md`](docs/architecture.md) before writing code.

## Tech Stack

- **PHP 8.4** · **Laravel 13**
- **Livewire 4** (MFC single-file components) · **Livewire Flux** (UI)
- **Laravel Folio** (file-based routing) · **Laravel Fortify** (auth backend)
- **Pest 5** (with the TIA test-impact engine) · **Pint** (strict-types enforced)
- **Tailwind CSS 4** · **Vite** · **npm**

## Requirements

- PHP >= 8.4
- Composer 2.x
- Node.js >= 20 with npm

## Installation

```bash
git clone <your-repo-url>
cd template-laravel-livewire
cp .env.example .env
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
npm install
npm run build
```

Then start the local dev stack (server, queue, logs, and Vite in one command):

```bash
composer run dev
```

`composer run dev` delegates to `php artisan dev`, which auto-detects your Node package manager from the lockfile (this template ships with `package-lock.json`, so it uses npm).

## Testing

```bash
composer test              # Pint + config:clear + full suite
php artisan test --compact # full suite only

vendor/bin/pest --tia            # re-run only tests affected by your changes
vendor/bin/pest --tia --fresh    # re-record the dependency graph baseline
```

## Documentation

- [Architecture & conventions](docs/architecture.md) — DTOs, Action classes, strict types, and the testing contract every feature must follow.
- [Authentication](docs/features/auth.md)
- [RBAC (roles & permissions)](docs/features/rbac.md)
- [CMS management](docs/features/management.md)
- [Activity log](docs/features/activity-log.md)
- [Media library](docs/features/media.md)
- [Changelog](CHANGELOG.md) — keep this updated as you build on top of the template.

## Enable Laravel Boost

Documentation: https://boost.laravel.com/installed

## Tweakflux Theming

```bash
./vendor/bin/tweakflux apply {theme?}
```

Docs: https://tweakflux.com

## Packages

- [Laravel Boost](https://boost.laravel.com/)
- [Laravel Folio](https://laravel.com/docs/13.x/folio)
- [Laravel Fortify](https://laravel.com/docs/13.x/fortify)
- [Livewire Flux](https://fluxui.dev/)
- [Tweakflux](https://github.com/joshcirre/tweakflux)
- [Spatie Permissions](https://spatie.be/docs/laravel-permission/v8/introduction)
- [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary/v11/introduction)
- [Spatie Activity Log](https://spatie.be/docs/laravel-activitylog/v5/introduction)
- [Livewire Jodit Editor](https://github.com/Mantix/livewire-jodit-text-editor)
