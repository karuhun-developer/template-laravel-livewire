<?php

namespace App\Livewire\Cms\Management;

use App\Livewire\Forms\Cms\Management\FormSetting;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use BaseComponent;

class Setting extends BaseComponent
{
    use WithFileUploads;

    public FormSetting $form;
    public $title = 'Setting';

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $logo;

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $favicon;

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $opengraph_image;

    public $isUpdate = true;

    public function mount() {
        $this->form->getData();
    }

    public function render()
    {
        return view('livewire.cms.management.setting')->title($this->title);
    }

    public function saveWithUpload() {
        $this->form->logo = $this->logo;
        $this->form->favicon = $this->favicon;
        $this->form->opengraph['image'] = $this->opengraph_image;

        $this->save();
    }
}
