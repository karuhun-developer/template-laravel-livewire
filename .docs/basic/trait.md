# Trait

## InteractWithModal.php

This trait related to modal action

Example use, see [source](https://github.com/karuhun-developer/template-laravel-livewire/blob/main/app/Traits/InteractWithModal.php)

```php
public function mount() {
    $this->addModal('modal-import');
}
function openModalImport() {
    $this->openModal('modal-import')
}
public function import() {
    $this->save();
    $this->closeModal('modal-import')
}
```

## WithGetFilterData.php

This trait related to paginate model data

Example use, see [source](https://github.com/karuhun-developer/template-laravel-livewire/blob/main/app/Traits/WithGetFilterData.php)

```php
$this->getDataWithFilter(
    model: new User,
    searchBy: [
        [
            'name' => 'Name',
            'field' => 'name',
        ],
    ],
)
```

## WithMediaCollection.php

This trait related to upload file

Example use, see [detail](https://github.com/karuhun-developer/template-laravel-livewire/blob/main/app/Traits/WithMediaCollection.php)

```php
$this->saveFile(
    model: new User,
    file: $file,
    collection: 'cover',
);
```

## Other Available Trait

Other available trait you can see [here](https://github.com/karuhun-developer/template-laravel-livewire/tree/main/app/Traits)
