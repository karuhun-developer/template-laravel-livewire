# CMS Management

The CMS management area lives under `/cms` (Folio pages in
`resources/views/pages/cms/management/`) and provides CRUD for the core administrative
resources. Every resource follows the identical layered pattern from
[architecture.md](../architecture.md).

## Managed resources

| Resource        | Components (`resources/views/components/cms/management/`) | Actions (`app/Actions/Cms/Management/`) | DTOs (`app/DTOs/Cms/Management/`) |
| --------------- | -------------------------------------------------------- | --------------------------------------- | --------------------------------- |
| **Users**       | `user/⚡table`, `⚡create-update`, `⚡update-password`      | `User/` (Store, Update, Delete, UpdateUserPassword, ValidateUserEmail) | `User/` (Store, Update) |
| **Roles**       | `role/⚡table`, `⚡create-update`, `⚡permission`           | `Role/`, `RolePermission/`              | `Role/` (Store, Update)           |
| **Permissions** | `permission/⚡table`, `⚡create-update`                    | `Permission/` (Store, Update, Delete)   | `Permission/` (Store, Update)     |
| **Menus**       | `menu/⚡table`, `⚡create-update`                          | `Menu/` (Store, Update, Delete)         | `Menu/` (Store, Update)           |
| **Sub-menus**   | `menu/sub/⚡table`, `⚡create-update`                      | `MenuSub/` (Store, Update, Delete)      | `MenuSub/` (Store, Update)        |

## Standard component pattern

Each resource has a **table** component (list/filter/paginate/reorder) and a
**create-update** component (a modal form shared by create and edit). The create-update
`submit()` always:

1. `Gate::authorize((isUpdate ? 'update' : 'create').$modelInstance)`
2. `$this->validate([...])` — rules differ for create vs update (e.g. unique email ignores
   the current record on update; password is `required` on create, `nullable` on update).
3. Builds a DTO (`StoreXData::fromArray($this->all())` / `UpdateXData::fromArray(...)`) and
   calls the injected Action.
4. Dispatches a `toast`, fires `reset-parent-page`, and closes the Flux modal.

## Menus & navigation

Menus (`app/Models/Menu/Menu`) and sub-menus (`app/Models/Menu/MenuSub`) drive the sidebar
navigation. A menu `hasMany` sub-menus (ordered by `order`), and both `belongTo` a `Role`,
so navigation is role-scoped. Status is a `CommonStatusEnum` cast (`ACTIVE` / `INACTIVE`).
The `getMenus()` helper (`app/helpers.php`) and the `menuActive()` helper in
`resources/views/components/layouts/app/sidebar.blade.php` build the rendered menu.

Reordering rows uses the `WithChangeOrder` Livewire trait; filtered/paginated tables use
`WithGetFilterData`.

## Shared helpers & traits

- `WithGetFilterData` / `WithGetFilterDataApi` — search + paginate list data.
- `WithChangeOrder` — drag/reorder persistence.
- `WithSaveFile` / `WithMediaCollection` — file & media handling (see [media](media.md)).
- `WithReturnResponse` — consistent JSON envelope for API endpoints.
- `WithGenerateReference` — generate unique reference codes.

## Tests

Every management component has a co-located `*.test.php`. Run the management slice with:

```bash
php artisan test --compact --filter=management
```

## Adding a new managed resource

Follow the checklist in [architecture.md](../architecture.md#creating-a-new-managed-feature--checklist):
model + migration + factory → DTOs → Actions → table & create-update components → Folio
page → re-seed permissions → tests → Pint → update the [CHANGELOG](../../CHANGELOG.md).
