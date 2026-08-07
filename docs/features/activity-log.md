# Activity Log

Model changes are tracked with **spatie/laravel-activitylog** (v5). Loggable models opt in
via the `LogsActivity` trait and expose an activity-log configuration.

## Enabling logging on a model

```php
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Setting extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }
}
```

> **v5 namespaces** — note the imports moved in activitylog v5:
> `LogsActivity` is now `Spatie\Activitylog\Models\Concerns\LogsActivity` and
> `LogOptions` is now `Spatie\Activitylog\Support\LogOptions`.

Models currently logging: `User`, `Menu`, `MenuSub`, `Role`, `Permission`, `Setting`.

## Schema

The `activity_log` table is created by the migrations under `database/migrations/`:

- `..._create_activity_log_table.php`
- `..._add_event_column_to_activity_log_table.php`
- `..._add_batch_uuid_column_to_activity_log_table.php`
- `..._add_attribute_changes_column_to_activity_log_table.php` — **required by v5**, which
  records old/new values in a dedicated `attribute_changes` JSON column.

Configuration lives in `config/activitylog.php`.

## Reading activity

```php
use Spatie\Activitylog\Models\Activity;

Activity::all();                       // every logged event
$model->activities;                    // activity for a specific record
activity()->log('Custom message');     // manual entry
```

## Conventions

- Add the trait + `getActivitylogOptions()` to any model whose changes must be auditable.
- If you add a model with logging and see
  `table activity_log has no column ...`, your DB predates a schema migration — run
  `php artisan migrate`.
