<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Mediafile;

class ProcessVideo implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;
    public $uniqueFor = 60;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function uniqueId()
    {
        return $this->post->id;
    }

    public function handle()
    {
        $this->post->file_preparation = true;
        Post::where('id', $this->post->id)->update(['file_preparation' => true]);
        $source_file = Storage::path($this->post->video->uri);
        $dest_file = str_replace("_rec.flv", "_rec.mp4", $source_file);
        exec("ffmpeg -loglevel 8 -i $source_file -vcodec libx264 -acodec libmp3lame $dest_file");
        $v = new Mediafile;
        $v->uri = str_replace("_rec.flv", "_rec.mp4", $this->post->video->uri);
        $v->sha256checksum = hash_file('sha256', Storage::path($v->uri), true);
        $v->save();
        $this->post->file_preparation = false;
        $this->post->video_id = $v->id;
        $this->post->save();
    }
}
