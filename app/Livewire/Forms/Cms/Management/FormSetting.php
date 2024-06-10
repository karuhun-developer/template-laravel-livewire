<?php

namespace App\Livewire\Forms\Cms\Management;

use App\Models\Setting;
use Livewire\Attributes\Validate;
use App\Traits\WithSaveFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class FormSetting extends Form
{
    use WithSaveFile;

    #[Validate('required')]
    public $name = '';

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $logo;

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $favicon;

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|numeric')]
    public $phone = '';

    #[Validate('nullable')]
    public $address = '';

    #[Validate('nullable')]
    public $about = '';

    #[Validate('nullable')]
    public $vision = '';

    #[Validate('nullable')]
    public $mission = '';

    #[Validate('nullable')]
    public $author = '';

    #[Validate('nullable')]
    public $description = '';

    #[Validate('nullable')]
    public $keywords = '';

    #[Validate('nullable')]
    public $opengraph = [];

    #[Validate('nullable')]
    public $dulbincore = [];

    #[Validate('nullable')]
    public $google_analytics = '';

    public $old_data;
    public $opengraph_image;

    public function getData() {
        $data = Setting::first();

        // Old data
        $data->opengraph = json_decode($data->opengraph, true);
        $data->dulbincore = json_decode($data->dulbincore, true);

        $this->old_data = $data;
        $this->opengraph_image = $data->opengraph['image'];

        $this->name = $data->name;
        $this->logo = $data->logo;
        $this->favicon = $data->favicon;
        $this->email = $data->email;
        $this->phone = $data->phone;
        $this->address = $data->address;
        $this->about = $data->about;
        $this->vision = $data->vision;
        $this->mission = $data->mission;
        $this->author = $data->author;
        $this->description = $data->description;
        $this->keywords = $data->keywords;
        $this->opengraph = $data->opengraph;
        $this->dulbincore = $data->dulbincore;
        $this->google_analytics = $data->google_analytics;
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

        // Save open graph image
        if($this->opengraph['image'] instanceof TemporaryUploadedFile) {
            $this->opengraph['image'] = $this->saveFile($this->opengraph['image'], $save_path, $save_path)['filename'];
        } else {
            $this->opengraph['image'] = json_decode($this->old_data->opengraph, true)['image'];
        }

        $this->opengraph = json_encode($this->opengraph);
        $this->dulbincore = json_encode($this->dulbincore);

        // Save data
        Setting::first()->update($this->all());

        $this->getData();
    }
}
