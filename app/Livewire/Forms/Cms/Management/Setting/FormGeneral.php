<?php

namespace App\Livewire\Forms\Cms\Management\Setting;

use App\Models\Setting;
use Livewire\Attributes\Validate;
use App\Traits\WithSaveFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class FormGeneral extends Form
{
    use WithSaveFile;

    #[Validate('required')]
    public $name;

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $logo;

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $favicon;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|numeric')]
    public $phone;

    #[Validate('nullable')]
    public $address;

    #[Validate('nullable')]
    public $about;

    #[Validate('nullable')]
    public $vision;

    #[Validate('nullable')]
    public $mission;

    public $old_data;

    public function getData() {
        $data = Setting::first();

        $this->old_data = $data;
        $this->name = $data->name;
        $this->logo = $data->logo;
        $this->favicon = $data->favicon;
        $this->email = $data->email;
        $this->phone = $data->phone;
        $this->address = $data->address;
        $this->about = $data->about;
        $this->vision = $data->vision;
        $this->mission = $data->mission;
    }

    public function save() {
        $this->validate();

        $save_path = Setting::$FILE_PATH;

        // Save logo
        if($this->logo instanceof TemporaryUploadedFile) {
            $this->logo = $this->saveFile($this->logo, $save_path, $save_path)['filename'];
        } else {
            $this->logo = $this->old_data->logo;
        }

        // Save favicon
        if($this->favicon instanceof TemporaryUploadedFile) {
            $this->favicon = $this->saveFile($this->favicon, $save_path, $save_path)['filename'];
        } else {
            $this->favicon = $this->old_data->favicon;
        }

        // Save data
        Setting::first()->update($this->all());

        $this->getData();
    }
}
