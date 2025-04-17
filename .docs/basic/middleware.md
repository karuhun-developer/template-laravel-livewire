# Middleware

## AuthApiKey.php

This middleware to validate api key for the application

Example use, see [source](https://github.com/karuhun-developer/template-laravel-livewire/blob/main/app/Http/Middleware/AuthApiKey.php)

```php
Route::get('/test', function () {
    return response()->json([
        'Hello Word',
    ]);
})->middleware(['auth.api-key']);
```
