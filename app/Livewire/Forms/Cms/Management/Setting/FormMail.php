<?php

namespace App\Livewire\Forms\Cms\Management\Setting;

use App\Models\Setting;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormMail extends Form
{
    #[Validate('nullable')]
    public $mail_email_show;

    #[Validate('required')]
    public $mail_driver;

    #[Validate('required')]
    public $mail_host;

    #[Validate('required')]
    public $mail_port;

    #[Validate('required')]
    public $mail_encryption;

    #[Validate('required')]
    public $mail_username;

    #[Validate('required')]
    public $mail_password;

    #[Validate('required')]
    public $mail_from_address;

    #[Validate('required')]
    public $mail_from_name;

    public function getData() {
        $data = Setting::first();

        $this->mail_email_show = $data->mail_email_show;
        $this->mail_driver = $data->mail_driver;
        $this->mail_host = $data->mail_host;
        $this->mail_port = $data->mail_port;
        $this->mail_encryption = $data->mail_encryption;
        $this->mail_username = $data->mail_username;
        $this->mail_password = $data->mail_password;
        $this->mail_from_address = $data->mail_from_address;
        $this->mail_from_name = $data->mail_from_name;
    }

    public function save() {
        $this->validate();

        Setting::first()->update($this->all());
    }
}
