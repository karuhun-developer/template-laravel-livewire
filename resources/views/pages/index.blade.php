<?php

use Illuminate\Http\RedirectResponse;

use function Laravel\Folio\name;
use function Laravel\Folio\render;

name('home');

render(function (): RedirectResponse {
    return to_route('cms.dashboard');
});

?>
