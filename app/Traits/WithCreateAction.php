<?php

namespace App\Traits;

trait WithCreateAction {
    public function create($navigate = true) {
        $this->redirectRoute($this->originRoute . '.manage', navigate: $navigate);
    }
}
