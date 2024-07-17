<?php

namespace App\Livewire\Contracts;

interface FormCrudInterface
{
    public function getDetail($id);

    public function save();

    public function store();

    public function update();

    public function delete($id);
}
