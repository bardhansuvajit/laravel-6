<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'first_name' => 'required | string | max:255',
            'last_name' => 'required | string | max:255',
            'email' => 'required | email | max:255 | unique:users',
            'password' => 'required | string | min:5 | max:30 | same:password_confirmation',
            'password_confirmation' => 'required | string | min:5 | max:30',
        ]);

        $user = new User();
        $user->name_prefix = 'Mr';
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);

        if ($user->save()) {
            // return redirect()->back()->with('success', 'Successfully registered');
            $creds = $request->only('email', 'password');

            if ( Auth::guard('web')->attempt($creds) ) {
                return redirect()->route('user.home');
            } else {
                return redirect()->route('user.login')->withInputs($request->all())->with('failure', 'Invalid credentials. Try again');
            }
        } else {
            return redirect()->back()->with('failure', 'Failed to register');
        }
    }

    public function check(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'email' => 'required | email | exists:users,email',
            'password' => 'required | string',
        ]);

        $creds = $request->only('email', 'password');

        if ( Auth::guard('web')->attempt($creds) ) {
            return redirect()->route('user.home');
        } else {
            return redirect()->route('user.login')->withInputs($request->all())->with('failure', 'Invalid credentials. Try again');
        }
    }
}
