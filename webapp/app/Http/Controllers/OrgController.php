<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Org;

class OrgController extends Controller
{

    public function show($id = 0)
    {
        if ($id > 0) {
            return view('org', ['edit' => 0, 'orgs' => [Org::findOrFail($id)]]);
        } else {
            return view('org', ['edit' => 0, 'orgs' => Org::orderByDesc('id')->paginate(10)]);
        }
    }

    public function edit($id = 0)
    {
        if (($id > 0) && (Auth::user()->access_level == 4)) {
            return view('org', ['edit' => 1, 'org' => Org::findOrFail($id)]);
        } elseif (Auth::user()->access_level == 4) {
            return view('org', ['edit' => 2]);
        }
    }
}
