<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Mediafile;

class MediafileController extends Controller
{

    public function show($id = 0)
    {
        if (in_array(Auth::user()->access_level, [1, 3, 4])) {
            if ($id > 0) {
                return view('mediafile', ['edit' => 0, 'mediafiles' => [Mediafile::findOrFail($id)]]);
            } else {
                return view('mediafile', ['edit' => 0, 'mediafiles' => Mediafile::orderByDesc('id')->paginate(10)]);
            }
        }
    }

    public function edit($id = 0)
    {
        if (in_array(Auth::user()->access_level, [1, 3, 4])) {
            if ($id > 0) {
                return view('mediafile', ['edit' => 1, 'mediafile' => Mediafile::findOrFail($id)]);
            } else {
                return view('mediafile', ['edit' => 2]);
            }
        }
    }
}
