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

    public function promote($id)
    {

        $user = User::where(['id'=>$id])->first();

        if($user->nivelAcesso == "User"){
            $novoNivel = "Gerente";
        } elseif($user->nivelAcesso == "Gerente") {
            $novoNivel = "Admin";
        } else {
            return false;
        }

        User::where(['id'=>$id])->update([
            'nivelAcesso' => $novoNivel
        ]);
    }

    public function update(Request $request, $id)
    {
        User::where(['id'=>$id])->update([
            'name' => trim($request->name),
            'cpf' => str_replace(array(".", ",", "-", "/"), "", trim($request->cpf)),
            'rg' => trim($request->rg),
            'email' => trim($request->email),
            'address' => trim($request->address),
            'number' => trim($request->number),
            'district' => trim($request->district),
            'city' => trim($request->city),
            'state' => trim($request->state)
        ]);

        return redirect()->route('manageUsers.list')->with('status', 'Dados atualizados com sucesso!');
    }

    public function removePrivileges($id)
    {
        User::where(['id'=>$id])->update([
            'nivelAcesso' => "User",
        ]);
    }

    public function destroy(User $User, $id)
    {
        $User->destroy($id);
    }

}
