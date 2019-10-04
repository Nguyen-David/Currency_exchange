<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    //
    public function addAccount(Request $request) {
        if($request) {
            $user = new User;
            $user->name = $request->name;
            $user->surname = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            return redirect('/')->with('message', 'Вы успешно зарегистрировались!');;
        }
        abort(404);
    }



}
