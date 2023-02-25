<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show($id = 0)
    {
        if ($id > 0) {
            return view('user', ['edit' => 0, 'users' => [User::limitAL()->findOrFail($id)]]);
        } else {
            return view('user', ['edit' => 0, 'users' => User::limitAL()->orderByDesc('id')->paginate(10)]);
        }
    }

    public function edit($id = 0)
    {
        if ($id > 0) {
            return view('user', ['edit' => 1, 'user' => User::limitAL()->find($id)]);
        }
    }

}
