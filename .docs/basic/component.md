# Component

## acc-input.blade.php

For input field like text, number, textarea, select etc.

Example use, see [source](https://github.com/karuhun-developer/template-laravel-livewire/blob/main/resources/views/components/acc-input.blade.php)

```php
<x-acc-input model="form.name" placeholder="Name" icon="fa fa-cog" />

<x-acc-input type="select" model="form.on" icon="fa fa-toggle-on">
    <option value="">--Select Type--</option>
    <option value="cms">Cms</option>
    <option value="web">Web</option>
</x-acc-input>
```

## acc-trix-editor.blade.php

For input WYSIWYG text

Example use, see [source](https://github.com/karuhun-developer/template-laravel-livewire/blob/main/resources/views/components/acc-trix-editor.blade.php)

```php
<x-acc-trix-editor
    model_name="trixQuestion"
    :model="$trixQuestion"
/>
```

## acc-input-file.blade.php

For input File input

Example use, see [source](https://github.com/karuhun-developer/template-laravel-livewire/blob/main/resources/views/components/acc-input-file.blade.php)

```php
<x-acc-image-preview :image="$form->logo" :form_image="$form->old_data->getFirstMediaUrl('logo')"  />
<x-acc-input-file model="form.logo" accept="image/*" :$imageIttr />
```

## Other Component

Other available Component you can see [here](https://github.com/karuhun-developer/template-laravel-livewire/tree/main/resources/views/components)
