<?php

namespace App\Livewire\Cms\Management\Setting;

use App\Livewire\Forms\Cms\Management\Setting\FormGeneral;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use BaseComponent;

class General extends BaseComponent
{
    use WithFileUploads;

    public FormGeneral $form;
    public $title = 'Setting';

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $logo;

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $favicon;

    public $isUpdate = true;

    public function mount() {
        $this->form->getData();
    }

    public function render()
    {
        return view('livewire.cms.management.setting.general')->title($this->title);
    }

    public function saveWithUpload() {
        $this->form->logo = $this->logo;
        $this->form->favicon = $this->favicon;

        $this->save();

        $this->logo = null;
        $this->favicon = null;
    }
}
