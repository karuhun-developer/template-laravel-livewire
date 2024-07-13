<?php

namespace App\Traits;

trait WithEditAction {
    public function edit($id, $navigate = true) {
        $this->redirectRoute($this->originRoute . '.manage', [
            'id' => $id,
        ], navigate: $navigate);
    }
}
