<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Mediafile;
use App\Models\Post;

class StartRec implements ShouldQueue
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
        if ($this->post->record == false) {
            $this->post->record = true;
            $r = Http::get(env('APP_URL').":82/control/record/start?rec=rec1&app=show&name={$this->post->stream_name}");
            $v = new Mediafile;
            $v->org_id = $this->post->org_id;
            $v->user_id = $this->post->user_id;
            $m = [0 => ""];
            preg_match('/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}-[0-9]+_rec.flv/i', $r, $m);
            $v->uri = 'public/rec/'.$m[0];
            $v->sha256checksum = hash('sha256', $v->uri, true);
            $v->save();
            $this->post->video_id = $v->id;
            Post::where('stream_name', $this->post->stream_name)->update(['video_id' => $v->id, 'record' => true]);
        }
    }
}
