<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function check(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'email' => 'required | string | email | exists:admins',
            'password' => 'required | string'
        ]);

        $creds = $request->only('email', 'password');

        if ( Auth::guard('admin')->attempt($creds) ) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.login')->withInputs($request->all())->with('failure', 'Invalid credentials. Try again');
        }
    }
}
