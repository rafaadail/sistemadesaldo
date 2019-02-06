<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function profile()
    {
        return view('site.profile.profile');
    }

    public function profileUpdate(Request $request)
    {
        $data = $request->all();

        if ($data['password'] != null) {
           $data['password'] = bcrypt(($data['password']));
        }

        auth()->user()->update($data);
    }
}
