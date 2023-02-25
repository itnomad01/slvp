<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Mediafile;
use App\Models\Post;
use App\Jobs\StartRec;
use App\Jobs\StopRec;
use App\Jobs\StopRTMP;

class PostController extends Controller
{

    public function show($id = 0)
    {
        if ($id > 0) {
            return view('post', ['edit' => 0, 'posts' => [Post::findOrFail($id)]]);
        } else {
            return view('post', ['edit' => 0, 'posts' => Post::orderByDesc('id')->paginate(10)]);
        }
    }

    public function index()
    {
        $lp = Post::select('id')->orderByDesc('id')->take(1)->get();
        if (isset($lp[0])) { $lpid = $lp[0]['id']; } else { $lpid = 0; }
        return view('home', [
            'posts' => Post::orderByDesc('id')->paginate(32),
            'postsfuture' => Post::where('dt_begin', '>', now())->orderByDesc('id')->paginate(32),
            'postspast' => Post::where('dt_end', '<', now())->orderByDesc('id')->paginate(32),
            'postsnow' => Post::where('dt_end', '>', now())->where('dt_begin', '<', now())->orderByDesc('id')->paginate(32),
            'lpid' => $lpid
        ]);
    }

    public function edit($id = 0)
    {
        if (($id > 0) && (in_array(Auth::user()->access_level, [1, 3, 4]))) {
            return view('post', ['edit' => 1, 'post' => Post::findOrFail($id)]);
        } elseif (in_array(Auth::user()->access_level, [1, 3, 4])) {
            return view('post', ['edit' => 2]);
        }
    }

    public function rtmp_on(Request $request) {
        // Storage::put('rq.txt', $request);
        $ar = [
            'stream_name' => $request->input('name'),
            'stream_token' => $request->input('token')
        ];
        $post = Post::where($ar)->firstOr(function () { return false; });
        if ($post) {
            $post->rtmp_status = true;
            $post->rtmp_ip_sender = $request->input('addr');
            $post->save();
            if (($post->autorecord == true) && ($post->record == false)) {
                StartRec::dispatch($post);
            }
            return response()->noContent(); // allow
        } else {
            return response(null, 403); // forbidden
        }
    }

    public function rtmp_off(Request $request) {
        $ar = [
            'stream_name' => $request->input('name'),
            'rtmp_ip_sender' => $request->input('addr')
        ];
        $post = Post::where($ar)->firstOr(function () { return false; });
        if ($post) {
            $post->rtmp_status = false;
            $post->save();
            if ($post->record == true) {
                StopRec::dispatch($post);
            }
        }
        return response()->noContent();
    }

    public function rtmp_update(Request $request) {
        $ar = [
            'stream_name' => $request->input('name'),
            'stream_token' => $request->input('token')
        ];
        $post = Post::where($ar)->firstOr(function () { return false; });
        if ($post) {
            $post->rtmp_status = true;
            $post->rtmp_ip_sender = $request->input('addr');
            $post->timepass = $request->input('time');
            $post->save();
            return response()->noContent(); // allow
        } else {
            return response(null, 403); // forbidden
        }
    }
}
