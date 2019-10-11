<?php

namespace App\Http\Controllers;

use App\CardUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class RegistrationController extends Controller
{
    //
    public function addAccount(Request $request) {
        $messages = [
            'required' => 'Поле :attribute обязательно к заполнению!',
            'password.max' => 'максимальное количество символов для поля email :max',
            'name.max' => 'максимальное количество символов для поля email :max',
            'surname.max' => 'максимальное количество символов для поля email :max',
            'email.unique' => 'Такой :attribute уже существует, поле должно быть уникальным',
            'alpha' => 'Поле :attribute должно содержать только буквы',
            'password.between' => 'Поле :attribute должно быть от :min до :max'
        ];

        $rules = [
            'name' => 'required|max:10|alpha',
            'surname' => 'required|max:10|alpha',
            'email' => 'required|unique:users,email',
            'password' => 'required|between:4,10'
        ];


        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails())
        {
            return redirect()->route('sign_up')->withErrors($validation)->withInput();
        }



        if($request) {
            $user = new User;
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

            $card = new CardUser;
            $card->card_id = rand(1000,9999);
            $card->user_id = $user->id;
            $card->save();
            return redirect('/')->with('message', 'Вы успешно зарегистрировались!');
        }
        abort(404);
    }



}
