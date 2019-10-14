<?php

namespace App\Http\Controllers;

use App\CardUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AddMoneyController extends Controller
{
    //
    public function show() {
        return view('main.add_money');
    }

    public function store(Request $request) {

        $messages = [
            'required' => 'Поле :attribute обязательно к заполнению!',
            'password.max' => 'максимальное количество символов для поля email :max',
            'money.max' => 'максимальное количество денег для пополнения :max',
            'password.between' => 'Поле :attribute должно быть от :min до :max'
        ];

        $rules = [
            'money' => 'max:100000|numeric',
            'password' => 'required|between:4,10',

        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        $user = Auth::user();
        if (!Hash::check($request->password,$user->password))
        {
            $validation->after(function ($validation) {
                $validation->errors()->add('password', 'Пароли не совпадают');
            });
        }
        if ($validation->fails())
        {
            return redirect()->route('add_money')->withErrors($validation)->withInput();
        }

        $card = CardUser::find($user->card->id);
        $card->money = $card->money + $request->money;
        $card->save();
        return redirect()->route('cabinet')->with('message','Вы успешно пополнили счет');

    }
}
