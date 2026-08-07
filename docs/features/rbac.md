# RBAC — Roles & Permissions

Role-based access control is built on **spatie/laravel-permission** (v8) using the `api`
guard. Roles and permissions are managed through the CMS and enforced with Laravel Gates.

## How permissions are generated

`database/seeders/PermissionSeeder.php` auto-generates permissions for **every model** in
`app/Models`. For each model it creates one permission per action prefix:

```
view, show, create, update, delete, restore, forceDelete, export, import, validate
```

The permission name is `{prefix}{ModelFQCN}`, e.g. `createApp\Models\User`,
`updateApp\Models\Menu\Menu`. This means **adding a new model automatically gives it a full
permission set** the next time the seeder runs — no manual permission wiring.

### Default roles

| Role         | Permissions                                                        |
| ------------ | ------------------------------------------------------------------ |
| `superadmin` | All permissions (minus anything in `$superAdminExcludePermission`) |
| `user`       | `viewApp\Models\User`, `updateApp\Models\User`                     |

Adjust the role grants by editing `$userPermissions` / `$superAdminExcludePermission` in
the seeder, then re-run `php artisan db:seed --class=PermissionSeeder`.

## Enforcing access

Authorization is checked with Gates before any Action runs. Spatie maps permission names
to Gate abilities, so a component authorizes like this:

```php
// $this->modelInstance = User::class;
Gate::authorize('create'.$this->modelInstance);   // "createApp\Models\User"
Gate::authorize('update'.$this->modelInstance);
Gate::authorize('show'.$this->modelInstance);
```

The super-admin check has a convenience helper on the `User` model:

```php
$user->isSuperAdmin(); // hasRole('superadmin')
$user->isUser();       // hasRole('user')
```

`app/Providers/AppServiceProvider.php` also defines the `viewPulse` gate (superadmin-only).

## Managing roles & permissions in the CMS

- **Roles:** `resources/views/components/cms/management/role/**`
  (`⚡table`, `⚡create-update`, `⚡permission`) with Actions in
  `app/Actions/Cms/Management/Role/` and `RolePermission/UpdateRolePermissionsAction`.
- **Permissions:** `resources/views/components/cms/management/permission/**` with Actions in
  `app/Actions/Cms/Management/Permission/`.

Assigning permissions to a role goes through `UpdateRolePermissionsAction`, keeping the
sync logic out of the component.

## Conventions

- Always authorize in the component/controller **before** invoking an Action.
- Use the `{prefix}{Model}::class` gate-name pattern; don't hardcode permission strings.
- New models get permissions for free — just re-seed after adding one.
