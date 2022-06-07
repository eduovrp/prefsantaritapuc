<?php

namespace App\Http\Controllers;

use App\Models\NivelAcesso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $nivelAcessos = NivelAcesso::get();
        return view('manageUsers.edit', compact('user', 'nivelAcessos'));
    }

    public function update(Request $request, $id)
    {

        if(Auth::user()->nivel_acesso_id < 3){

            if(Auth::user()->nivel_acesso_id != 1 && Auth::user()->id != 6 && $id == 6 ){
                return redirect()->route('manageUsers.list')->with('warning', 'Ocorreu um erro com suas permissões, verifique ou tente novamente.');

            } else {

                User::where(['id'=>$id])->update([
                    'name' => trim($request->name),
                    'cpf' => str_replace(array(".", ",", "-", "/"), "", trim($request->cpf)),
                    'rg' => trim($request->rg),
                    'email' => trim($request->email),
                    'address' => trim($request->address),
                    'number' => trim($request->number),
                    'district' => trim($request->district),
                    'city' => trim($request->city),
                    'state' => trim($request->state),
                    'nivel_acesso_id' => $request->nivel_acesso_id
                ]);
                return redirect()->route('manageUsers.list')->with('status', 'Dados atualizados com sucesso!');
            }
        }else {
            return redirect()->route('manageUsers.home')->with('warning', 'Ocorreu um erro com suas permissões, verifique ou tente novamente.');
        }
    }

    public function destroy(User $User, $id)
    {
        $User->destroy($id);
    }

}
