<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class ShowPost extends Component
{
    public Post $post;

    public function delete() {
        $this->post->delete();
    }

    public function render()
    {
        return view('livewire.show-post');
    }
}
