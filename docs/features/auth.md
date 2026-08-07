# Authentication

Authentication is powered by **Laravel Fortify** (the frontend-agnostic auth backend),
with a Livewire/Flux UI for the web and a versioned JSON API for programmatic access.

## Web (session) auth

- **Backend:** Fortify registers login, registration, password reset, email verification,
  password confirmation, and two-factor routes. Configuration lives in
  `config/fortify.php`; wiring in `app/Providers/FortifyServiceProvider.php`.
- **User creation / profile / password** logic lives in `app/Actions/Fortify/`
  (`CreateNewUser`, `ResetUserPassword`, `PasswordValidationRules`).
- **UI:** Livewire MFC components under `resources/views/components/setting/**` (profile,
  password, appearance, delete-user-form, two-factor + recovery codes) and the auth pages
  under `resources/views/pages/`.

### Two-factor authentication (2FA)

TOTP-based 2FA with QR codes and recovery codes is provided by Fortify and surfaced in
`resources/views/components/setting/⚡two-factor/` and the `⚡recovery-codes` component.
Enable/disable, confirmation, and recovery-code regeneration are covered by
`tests/Feature/Settings/TwoFactorAuthenticationTest.php` and the component test.

## API (token) auth — `routes/api/v1/auth.php`

Sanctum tokens back a versioned auth API under `/api/v1`. Actions live in
`app/Actions/Api/V1/Auth/`, DTOs in `app/DTOs/Api/V1/Auth/`, controllers in
`app/Http/Controllers/Api/V1/Auth/`, and validation in `app/Http/Requests/Api/V1/Auth/`.

| Concern              | Action                        | DTO                        |
| -------------------- | ----------------------------- | -------------------------- |
| Register             | `StoreRegisterAction`         | `StoreRegisterData`        |
| Login (issue token)  | `StoreAuthenticatedAction`    | `StoreAuthenticatedData`   |
| Update profile       | `UpdateAuthenticatedAction`   | `UpdateAuthenticatedData`  |
| Logout / revoke      | `DeleteAuthenticatedAction`   | —                          |
| Resend verification  | `ResendAuthenticatedAction`   | —                          |
| Reset password       | `ResetPasswordAction`         | `ResetPasswordData`        |

API responses are normalised through the `WithReturnResponse` trait (consistent JSON
envelope + status codes). The `ForceJsonResponse` middleware guarantees JSON error output.

## Tests

- `tests/Feature/Auth/*` — authentication, registration, email verification, password
  reset, password confirmation, two-factor challenge.
- `tests/Feature/Settings/*` — profile & password updates, 2FA management.

Run just the auth suite:

```bash
php artisan test --compact --filter=Auth
```

## Conventions

- Never put auth logic in components/controllers — delegate to the `Fortify` / `Api\V1\Auth`
  Actions and wrap input in the matching DTO.
- Password rules are centralised in `PasswordValidationRules`; reuse it rather than
  redefining `min:8` inline.
