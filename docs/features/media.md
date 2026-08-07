# Media & File Handling

File uploads are handled either through **spatie/laravel-medialibrary** (v11) for
model-associated media with conversions, or through the lightweight `WithSaveFile` trait
for simple disk storage.

## Media Library (model-associated files)

Attach files to an Eloquent model by implementing `HasMedia` and using the
`InteractsWithMedia` trait, then define collections/conversions:

```php
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Foo extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }
}
```

The `media` table migration is under `database/migrations/`, and configuration lives in
`config/media-library.php`.

### `WithMediaCollection` trait

`app/Traits/WithMediaCollection.php` wraps common media operations (save to a collection,
optionally replacing older media) so components don't repeat the boilerplate. Prefer it
over calling the media library directly from components.

## Simple file storage — `WithSaveFile`

For files that don't need conversions/collections, `app/Traits/WithSaveFile.php` stores an
uploaded file to a disk and returns the stored path:

```php
$path = $this->saveFile($file, 'uploads/foo', 'my-file-name');
// returns string path, or false when $file is null
```

## Conventions

- Use **Media Library** when files belong to a model and need collections, conversions, or
  responsive images.
- Use **`WithSaveFile`** for one-off uploads where a plain stored path is enough.
- Keep upload/validation in the component, but delegate the actual save to the trait.
- Run `php artisan storage:link` so stored files are publicly served (already in the
  install steps).
