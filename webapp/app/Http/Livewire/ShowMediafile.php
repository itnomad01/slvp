<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mediafile;

class ShowMediafile extends Component
{

    public Mediafile $mediafile;

    public function delete() {
        $this->mediafile->delete();
    }

    public function render()
    {
        return view('livewire.show-mediafile');
    }
}
