# Laravel + Livewire Starter Template

[![PHP Version](https://img.shields.io/badge/PHP-8.4-777BB4?logo=php&logoColor=white)](https://php.net)
[![Laravel Framework](https://img.shields.io/badge/Laravel-13.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-4.x-FB70A9?logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Flux UI](https://img.shields.io/badge/Flux_UI-2.x-161C28)](https://fluxui.dev)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4-38B2AC?logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Pest Testing](https://img.shields.io/badge/Pest-v5-F5781E)](https://pestphp.com)

A batteries-included, production-grade starter template for modern Laravel applications. Built with **Laravel 13**, **Livewire 4**, **Flux UI**, **Laravel Folio**, and the high-precision **HydroBento Precision System** design language.

Engineered with an opinionated, strict architecture (DTOs, Action classes, strict types, and mandatory Pest test coverage) so every feature you build stays robust, maintainable, and scalable. Ready to be published directly as a GitHub Template repository.

---

## ✨ Features at a Glance

- 📐 **HydroBento Precision Design System**: Asymmetric bento grid layout (`7:5`, `8:4`), Deep Navy Slate (`#161c28`), Cobalt Teal (`#1e667f`), and high-luminescence Electric Mint (`#00e29d`) telemetry accents. Designed after surgical instrumentation and tactical dashboards with pure non-gradient canvases (`#f8f9fb` light / `#080e1a` dark). Fully documented in [`DESIGN.md`](DESIGN.md).
- 🧭 **Reference Design Alignment**: Built to mirror the live operational telemetry at [Laundry Karuhun Developer Live Reference](https://laundry.karuhundeveloper.com/pesanan/LDR-20260917-00000007?signature=967845d46045777b37186c180206b2b567a2404ee7fe0f2b3ea3f8cacc47699d).
- 🔤 **Technical Typography Pairing**: `Space Grotesk` for sharp geometric display headlines, KPI telemetry, and micro-data caps; `Hanken Grotesk` for ergonomic body reading and forms.
- 💊 **Tactile Pill Actions & Bento Cards**: Global pill-shaped interactive triggers (`rounded-full`) contrasting against rigid `1.5rem` (`rounded-3xl`) bento enclosures with hairline 1px borders.
- 📋 **Standardized PRD Starter Template**: Jumpstart your project specifications with [`PRD.md`](PRD.md), a battle-tested product requirements document modeled after high-scale operational platforms.
- ⚡ **Livewire 4 + Flux UI**: Reactive single-file components, dynamic loading states, accessible modal dialogues, and toast notifications.
- 🗂️ **Laravel Folio**: Page-based routing in `resources/views/pages/` with middleware and route model binding.
- 🔒 **Laravel Fortify Auth**: Complete authentication backend supporting Login, Registration, Password Resets, 2FA/TOTP challenges, and Profile management.
- 🛡️ **Role-Based Access Control (RBAC)**: Powered by `spatie/laravel-permission` with a pre-built CMS for managing users, roles, and granular permissions.
- 🧭 **Dynamic Navigation Menu Management**: Fully customizable sidebar navigation stored in database and managed through CMS.
- 📜 **Audit Trails & Media Library**: `spatie/laravel-activitylog` for tracking privileged actions and `spatie/laravel-medialibrary` for file/image attachments.
- 📊 **Monitoring & Observability**: Integrated Laravel Pulse (`/pulse`) and Log Viewer (`/logs`) accessible to Superadmin.
- 🧪 **Comprehensive Test Suite**: Pre-configured with Pest 5 and Test Impact Analysis (TIA) with 85+ baseline feature tests passing.

---

## 📚 Essential Documentation

| Document                                                         | Description                                                                                                            |
| :--------------------------------------------------------------- | :--------------------------------------------------------------------------------------------------------------------- |
| **[`DESIGN.md`](DESIGN.md)**                                     | Full specification for the HydroBento Precision System, color tokens, typography, bento matrix, and component recipes. |
| **[`PRD.md`](PRD.md)**                                           | Production-ready Product Requirements Document template for scoping your new application.                              |
| **[`docs/architecture.md`](docs/architecture.md)**               | Strict architectural standards: DTOs, Actions, Form Requests, and testing contracts.                                   |
| **[`docs/features/auth.md`](docs/features/auth.md)**             | Authentication configuration, guards, and custom responses.                                                            |
| **[`docs/features/rbac.md`](docs/features/rbac.md)**             | Role and permission management guidelines.                                                                             |
| **[`docs/features/management.md`](docs/features/management.md)** | CMS management module details.                                                                                         |
| **[`CHANGELOG.md`](CHANGELOG.md)**                               | Release notes and project changelog.                                                                                   |

---

## 🚀 Quickstart & Installation

### Requirements

- **PHP** >= 8.4
- **Composer** 2.x
- **Node.js** >= 20 & **npm**

### Step-by-Step Setup

```bash
# 1. Clone repository (or create repository from template)
git clone <your-repo-url>
cd template-laravel-livewire

# 2. Setup environment configuration
cp .env.example .env

# 3. Install PHP dependencies
composer install

# 4. Generate app encryption key
php artisan key:generate

# 5. Create storage symlink
php artisan storage:link

# 6. Run database migrations and seeders
php artisan migrate --seed

# 7. Install frontend dependencies & compile assets
npm install
npm run build

# 8. Boost Install
php artisan boost:install
```

### Run Local Development Stack

Start the server, Vite development server, and background workers in a single unified command:

```bash
composer run dev
```

Visit the application at: `http://localhost:8000`

---

## 🔑 Default Credentials (from Seeders)

After running `php artisan migrate --seed`, the following accounts are available:

| Role             | Email                       | Password   | Access Scope                                     |
| :--------------- | :-------------------------- | :--------- | :----------------------------------------------- |
| **Super Admin**  | `superadmin@superadmin.com` | `password` | Full CMS, Pulse (`/pulse`), Logs (`/logs`), RBAC |
| **Regular User** | `user@user.com`             | `password` | Standard user dashboard                          |

---

## 🧪 Testing & Code Quality

Maintain high code standards with our automated toolchain:

```bash
# Run full test suite with Pint formatting and config clear
composer test

# Run Pest tests with compact output
php artisan test --compact

# Run Test Impact Analysis (re-tests only affected files)
vendor/bin/pest --tia

# Format code with Laravel Pint
vendor/bin/pint --format agent

# Run static analysis (Larastan / PHPStan)
vendor/bin/phpstan analyse
```

---

## 🎨 Design System & Theming

The theme is declared in `resources/css/app.css` using Tailwind CSS v4 `@theme` and `@layer base`:

```css
@theme {
    --font-sans: "Hanken Grotesk", ui-sans-serif, system-ui, sans-serif;
    --font-display: "Space Grotesk", ui-sans-serif, system-ui, sans-serif;

    --color-brand-700: #161c28; /* Deep Navy Slate */
    --color-brand-600: #1e667f; /* Cobalt Teal */
    --color-mint-accent: #00e29d; /* High-Luminescence Electric Mint */
    --color-canvas: #f8f9fb; /* Clean Slate Base */
    --color-surface: #ffffff; /* Pure Surface */
    --color-surface-blue: #edf5fa; /* Soft Telemetry Tint */
    --color-line: #e2e8ed; /* Hairline Architectural Boundary */
}
```

Dark mode automatically swaps the canvas to `#080e1a`, card surfaces to `#121824`, and borders to `#222c3d` while keeping all text and indicator contrasts at WCAG AAA levels.

---

## 📦 Packages & Ecosystem

- [Laravel Framework 13](https://laravel.com)
- [Livewire 4](https://livewire.laravel.com)
- [Livewire Flux](https://fluxui.dev)
- [Laravel Folio](https://laravel.com/docs/13.x/folio)
- [Laravel Fortify](https://laravel.com/docs/13.x/fortify)
- [Laravel Pulse](https://laravel.com/docs/13.x/pulse)
- [Spatie Permissions](https://spatie.be/docs/laravel-permission/v8/introduction)
- [Spatie Activity Log](https://spatie.be/docs/laravel-activitylog/v5/introduction)
- [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary/v11/introduction)
- [Opcodes Log Viewer](https://github.com/opcodesio/log-viewer)
- [Jodit Text Editor](https://github.com/Mantix/livewire-jodit-text-editor)

---

## 📄 License

This starter template is open-sourced software licensed under the [MIT license](LICENSE).
