<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;

class ProfileController extends Controller
{
    //

    public function show($id) {

        $user = User::findOrFail($id);

        return view('profile.show', compact('user'));
    }

    public function edit($id) {

        $roles = Role::all();

        $user = User::findOrFail($id);

        return view('profile.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id) {

        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'sometimes|string',
            'avatar' => 'sometimes|image|file|max:5000'
        ]);

        if($request->avatar) {
            $user->avatar = $request->avatar->store('uploads', 'public');
        }
        
        $user->name = $request->username;

        $user->role_id = $request->role_id;

        $user->save();

        return redirect()->route('show-profile', $user->id);
    }
}
