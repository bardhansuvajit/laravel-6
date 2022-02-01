<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());

        $rules = [
            'first_name' => 'required|string|min:2|max:255',
            'middle_name' => 'nullable|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'phone_number' => 'nullable|integer|digits:10',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // return redirect()->route('admin.profile')->withErrors($validator)->withInput();
            return response()->json(['error' => true, 'message' => $validator->errors()->first()]);
        } else {
            $admin = Auth::guard('admin')->user();

            $admin->first_name = $request->first_name;
            $admin->middle_name = $request->middle_name;
            $admin->last_name = $request->last_name;
            $admin->phone_number = $request->phone_number;

            $admin->save();

            return response()->json(['error' => false, 'message' => 'Profile updated', 'type' => 'success']);
        }
    }
}
