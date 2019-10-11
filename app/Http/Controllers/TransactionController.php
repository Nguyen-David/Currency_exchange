<?php

namespace App\Http\Controllers;

use App\CardUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    //
    public function store(Request $request) {
        $request['money_transfer'] = (int) $request['money_transfer'];
        $user = Auth::user();

        $messages = [
            'card_id.exists' => 'Такого :attribute пользователя нет',
            'card_id.between' => 'Карта должна содержать :max цифры',
            'money_transfer.max' => 'Сума перевода превышает суму на вешем счёту',
            'money_transfer.numeric' => 'Сумма должна содержать только числовое значение',
            'password.same' => 'Пароль не верный'
        ];

        $rules = [
            'card_id' => 'exists:card_user,card_id|between:4,4',
            'money_transfer' => 'max:'.$user->card->money.'|numeric',
            'password' => 'exists:users,password',
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if (!Hash::check($request->password,$user->password))
        {
            $validation->after(function ($validation) {
                $validation->errors()->add('password', 'Пароли не совпадают');
            });
        }
        if ($validation->fails())
        {

            return redirect()->route('cabinet',['id' => $request->user_id])->withErrors($validation)->withInput();
        }

        $card_sender = CardUser::find($user->card->id);
        if($request->commision == 'on'){
            $card_sender->money = $card_sender->money - $request->money_transfer - 10;
        }else {
            $card_sender->money = $card_sender->money - $request->money_transfer;
        }
        $card_sender->save();

        $card_recipient = CardUser::where('card_id',$request->card_id)->first();
        if($request->commision != 'on'){
            $card_recipient->money = $card_recipient->money + $request->money_transfer - 10;
        }else {
            $card_recipient->money = $card_recipient->money + $request->money_transfer;
        }
        $card_recipient->save();

        return redirect('/cabinet/'. $request->user_id)->with('message', 'Вы успешно перевели деньги!');

    }
}
