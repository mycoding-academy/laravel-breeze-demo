<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.changepassword');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        $user = auth()->user();

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        flash()->success('Your password was saved!');

        return redirect(route('dashboard'));
    }
  
}
