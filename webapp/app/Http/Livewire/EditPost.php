<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Mediafile;
use App\Models\Post;
use App\Jobs\StartRec;
use App\Jobs\StopRec;
use App\Jobs\StopRTMP;

class EditPost extends Component
{
    use WithFileUploads;

    public Post $post;
    public $picturefile;
    public Mediafile $picture;
    public $edit;
    public $inputcolor;
    public $stream_token;
    public $startrec_dis = 'disabled';
    public $stoprec_dis = 'disabled';

    protected $rules = [
        'post.autorecord' => ['nullable', 'boolean'],
        'post.title1' => ['required', 'min:1'],
        'post.title2' => ['nullable', 'string'],
        'post.dt_begin' => ['required', 'date'],
        'post.dt_end' => ['required', 'date'],
        'post.price' => ['required', 'numeric'],
        'post.timeleft' => ['nullable', 'numeric'],
        'post.body' => ['nullable', 'string'],
        'inputcolor' => ['nullable', 'string', 'max:9', 'regex:/^#(?:[0-9a-fA-F]{3,4}){1,2}$/i'],
        'picturefile' => ['nullable', 'image', 'max:2048'],
    ];

    public function mount() {
        if ($this->edit == 2) {
            $this->post = new Post;
            $this->post->autorecord = false;
        }
        if ($this->edit == 1) {
            $this->stream_token = $this->post->stream_token;
        }
    }

    public function refreshbuttons() {
        if ($this->edit == 1) {
            if ($this->post->rtmp_status == true) {
                if ($this->post->record == true) {
                    $this->startrec_dis = 'disabled';
                    $this->stoprec_dis = '';
                } else {
                    $this->startrec_dis = '';
                    $this->stoprec_dis = 'disabled';
                }
            } else {
                $this->startrec_dis = 'disabled';
                $this->stoprec_dis = 'disabled';
            }
        }
    }

    public function save() {
        $this->validate();
        $this->post->color = substr($this->inputcolor, 1);
        if ($this->picturefile)
        {
            $tempuri = $this->picturefile->store('public');
            $temphash = hash_file('sha256', Storage::path($tempuri), true);
            $efile = Mediafile::where('sha256checksum', $temphash)->first();
            if ($efile) {
                $this->post->picture_id = $efile->id;
                Storage::delete($tempuri);
            } else {
                $this->picture = new Mediafile;
                $this->picture->uri = $tempuri;
                $this->picture->sha256checksum = $temphash;
                $this->picture->save();
                $this->post->picture_id = $this->picture->id;
            }
            $this->picturefile->delete();
        }
        if ($this->edit == 1) {
            $this->post->stream_token = $this->stream_token;
        }
        $this->post->save();
        if (($this->edit == 2) && ($this->post->id > 0)) {
            $this->stream_token = $this->post->stream_token;
            $this->edit = 1;
        }
    }

    public function gentoken() {
        $this->stream_token = Str::random(32);
    }

    public function startrec() {
        StartRec::dispatch($this->post);
        $this->startrec_dis = 'disabled';
        $this->stoprec_dis = '';
    }

    public function stoprec() {
        StopRec::dispatch($this->post);
        $this->startrec_dis = '';
        $this->stoprec_dis = 'disabled';
    }

    public function stop() {
        StopRTMP::dispatch($this->post);
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
