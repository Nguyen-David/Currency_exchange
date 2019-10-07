<?php

namespace App\Http\Controllers;

use App\CardUser;
use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    //
    public function addAccount(Request $request) {
        if($request) {
            $user = new User;
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

            $card = new CardUser;
            $card->card = rand(1000,9999);
            $card->user_id = $user->id;
            $card->save();
            return redirect('/')->with('message', 'Вы успешно зарегистрировались!');;
        }
        abort(404);
    }



}
