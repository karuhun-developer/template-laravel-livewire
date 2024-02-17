<?php

namespace App\Livewire\Forms;

use App\Models\Room;
use App\Models\CheckInOutHistory;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormFrontDesk extends Form
{
    #[Validate('nullable|numeric')]
    public $id = '';

    #[Validate('required|string')]
    public $room_type = '';

    #[Validate('required|string')]
    public $no = '';

    #[Validate('required|string')]
    public $guest_name = '';

    #[Validate('nullable|numeric')]
    public $is_birthday = 0;


    // Get the data
    public function getDetail($id) {
        $data = Room::with('roomType')->find($id);

        $this->id = $id;
        $this->room_type = $data->roomType->name;
        $this->no = $data->no;
        $this->guest_name = $data->guest_name;
        $this->is_birthday = $data->is_birthday;
    }

    // Check In
    public function checkIn() {
        $this->validate();

        $room = Room::find($this->id);

        CheckInOutHistory::create([
            'user_id' => auth()->user()->id,
            'hotel_id' => $room->hotel_id,
            'room_id' => $this->id,
            'is_check_in' => 1,
            'is_check_out' => 0,
            'guest_name' => $this->guest_name,
        ]);

        $room->update([
            'guest_name' => $this->guest_name,
            'is_birthday' => $this->is_birthday,
        ]);
    }

    // Check Out
    public function checkOut() {
        $room = Room::find($this->id);

        CheckInOutHistory::create([
            'user_id' => auth()->user()->id,
            'hotel_id' => $room->hotel_id,
            'room_id' => $this->id,
            'is_check_in' => 0,
            'is_check_out' => 1,
            'guest_name' => $room->guest_name,
        ]);

        $room->update([
            'guest_name' => null,
            'is_birthday' => 0,
        ]);
    }
}
