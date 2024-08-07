<?php

namespace App\Livewire\Forms\Cms\Management\Setting;

use App\Models\Setting;
use App\Traits\WithMediaCollection;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class FormGeneral extends Form
{
    use WithMediaCollection;

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

        // Save data
        $setting =Setting::first();

        // Save logo
        if($this->logo instanceof TemporaryUploadedFile) {
            $this->saveFile(
                model: $setting,
                file: $this->logo,
                collection: 'logo'
            );
        }

        // Save favicon
        if($this->favicon instanceof TemporaryUploadedFile) {
            $this->saveFile(
                model: $setting,
                file: $this->favicon,
                collection: 'favicon'
            );
        }

        $setting->update($this->only([
            'name',
            'email',
            'phone',
            'address',
            'about',
            'vision',
            'mission',
        ]));

        $this->getData();
    }
}
