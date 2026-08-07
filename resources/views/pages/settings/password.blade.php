<?php

declare(strict_types=1);

use function Laravel\Folio\name;

name('user-password.edit');

?>

<x-layouts.app title="Change Password">
    <livewire:setting.password />
</x-layouts.app>
