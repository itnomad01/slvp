<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ShowUser extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.show-user');
    }
}
