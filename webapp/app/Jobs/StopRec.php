<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Jobs\ProcessVideo;

class StopRec implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->post->record == true) {
            $this->post->record = false;
            $r = Http::get(env('APP_URL').":82/control/record/stop?rec=rec1&app=show&name={$this->post->stream_name}");
            $this->post->video->sha256checksum = hash_file('sha256', Storage::path($this->post->video->uri), true);
            $this->post->video->save();
            Post::where('stream_name', $this->post->stream_name)->update(['record' => false]);
            ProcessVideo::dispatch($this->post);
        }
    }
}
