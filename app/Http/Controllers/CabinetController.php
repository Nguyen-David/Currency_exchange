<?php

namespace App\Http\Controllers;

use App\CardUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabinetController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        $user = Auth::user();

        $curl = curl_init();
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11');
        $result_currency = json_decode(curl_exec($curl), FALSE);
        curl_close($curl);

        return view('main/cabinet',[
            'user' => $user,
            'currency' => $result_currency
        ]);
    }


    public function addMoneyStore(Request $request){
        $user = User::find($request->user_id);

        $rules = [
              'password' => 'same:users,password',
        ];

        $this->validate($request,$rules);

//        if($user->password != $request->password){
//            return redirect()->back()->withErrors('Пароль неверный')->withInput('user_id');
//        }



        $card = CardUser::where('user_id', $request->user_id)->first();
        $card->money = $card->money + $request->money;
        $card->save();

    }
}
