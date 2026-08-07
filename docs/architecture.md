# Architecture & Conventions

This template is intentionally opinionated. Every feature follows the same layered
flow so the codebase stays predictable as it grows. **Read this before writing code**,
and keep new features consistent with the rules below.

## The golden rules

1. **Every PHP file declares `declare(strict_types=1);`** — enforced project-wide by
   Pint (`pint.json` has the `declare_strict_types` rule). Run `vendor/bin/pint` before
   committing.
2. **Everything is fully typed** — parameters, return types, properties, and array-shape
   PHPDocs (`@return array{...}`, `@param array<string, mixed>`). Eloquent relations use
   generics (`BelongsTo<Role, $this>`, `HasMany<MenuSub, $this>`).
3. **Business logic lives in Action classes, never in components or controllers.**
4. **Data crossing a boundary is wrapped in a DTO** — never pass raw request arrays into
   Actions.
5. **Every change ships with a test.** No feature is "done" until a Pest test proves it.
6. **Authorization happens in the component/controller via Gates** before any Action runs.

## Request lifecycle

```
Folio page (resources/views/pages/**)          <- routing (file-based)
        │  renders
        ▼
Livewire MFC component (resources/views/components/**/⚡*/)
        │  1. Gate::authorize(...)
        │  2. $this->validate([...])
        │  3. build DTO via SomeData::fromArray(...)
        ▼
Action class (app/Actions/**)                   <- business logic, one public handle()
        │  consumes the DTO
        ▼
Eloquent model (app/Models/**)                  <- persistence, relations, activity log
```

The API surface follows the same flow with `Http/Controllers → FormRequest → DTO → Action → Model`.

## Layers in detail

### DTOs — `app/DTOs/`

A DTO is an immutable, fully-typed value object that carries data into an Action.

- `final readonly class` with **constructor property promotion**.
- A static `fromArray(array $data): self` factory (`@param array<string, mixed> $data`).
- A `toArray(): array` with an **array-shape return** matching the model's fillable columns.

```php
final readonly class StoreUserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $role,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            role: $data['role'],
        );
    }

    /** @return array{name: string, email: string, password: string} */
    public function toArray(): array
    {
        return ['name' => $this->name, 'email' => $this->email, 'password' => $this->password];
    }
}
```

### Action classes — `app/Actions/`

One responsibility per class, exposed through a single `handle()` method. Actions are
resolved from the container (constructor-injectable) and receive a DTO, returning a model
or a typed result. They never read from the request or the `$this` of a component.

```php
class StoreUserAction
{
    public function handle(StoreUserData $data): User
    {
        $user = User::create($data->toArray());
        $user->syncRoles([$data->role]);

        return $user;
    }
}
```

Mirror the domain in the namespace: `App\Actions\Cms\Management\User\StoreUserAction`,
`App\Actions\Api\V1\Auth\StoreRegisterAction`.

### Livewire components — `resources/views/components/**/⚡*/`

Components use the **MFC (multi-file component)** format: a `⚡`-prefixed folder holding a
`*.php` class (`new class extends Component`), a `*.blade.php` view, and a co-located
`*.test.php`. A component's `submit()` method must:

1. `Gate::authorize(...)` first.
2. `$this->validate([...])`.
3. Build the DTO and hand it to the injected Action.
4. Dispatch a `toast` and refresh the parent.

Business logic beyond validation/authorization belongs in the Action, not the component.

### Models — `app/Models/`

- Fully typed relationships with generics.
- `$fillable` / `$casts` present; enums cast to backed-enum classes (`CommonStatusEnum`).
- Loggable models use the Spatie `LogsActivity` trait — see [activity-log](features/activity-log.md).

### Enums — `app/Enums/`

Backed enums with `TitleCase` cases (`ACTIVE`, `INACTIVE`) and helper methods
(`label()`, `color()`).

### Traits — `app/Traits/`

Reusable, fully-typed cross-cutting helpers: `WithSaveFile`, `WithMediaCollection`,
`WithReturnResponse` (JSON API responses), `WithGetFilterData` / `WithGetFilterDataApi`
(paginated filtering), `WithChangeOrder`, `WithGenerateReference`.

## Testing contract

- **Framework:** Pest 5. Tests live in `tests/` (feature/unit) and co-located
  `*.test.php` files next to each Livewire component.
- Feature tests use `RefreshDatabase` and model factories.
- Run the suite: `php artisan test --compact` or `composer test`.
- Use the **TIA engine** while iterating: `vendor/bin/pest --tia` re-runs only the tests
  affected by your changes; `vendor/bin/pest --tia --fresh` re-records the baseline graph.
- A new Action, DTO transformation, or component branch **must** have a test covering it.

## Creating a new managed feature — checklist

1. `php artisan make:model Foo/Bar -mf` (model + migration + factory).
2. Add the DTOs: `Store{Model}Data`, `Update{Model}Data` under `app/DTOs/...`.
3. Add the Actions: `Store`, `Update`, `Delete` under `app/Actions/...`.
4. Build the Livewire components under `resources/views/components/...⚡.../`
   (table + create-update), authorizing via Gates and delegating to Actions.
5. Add the Folio page under `resources/views/pages/...` with `declare(strict_types=1);`.
6. Permissions are auto-generated per model by the `PermissionSeeder` — see
   [RBAC](features/rbac.md).
7. Write tests (component `*.test.php` + any feature/unit tests).
8. `vendor/bin/pint` → `php artisan test --compact` → update [CHANGELOG](../CHANGELOG.md).
