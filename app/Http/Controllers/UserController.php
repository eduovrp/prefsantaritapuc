<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function list()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('manageUsers.list', compact('users'));
    }

    public function edit(User $User)
    {
        $user = User::where(['id'=>$User->id])->first();
        return view('manageUsers.edit', compact('user'));
    }

    public function destroy(User $User, $id)
    {
        $User->destroy($id);
    }

}
