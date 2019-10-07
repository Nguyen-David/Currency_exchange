<?php

namespace App\Http\Controllers;

use App\CardUser;
use App\User;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    //
    public function show($id){
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11');
        $result_currency = json_decode(curl_exec($curl), FALSE);
        curl_close($curl);

//        $result = [];
//        foreach ($result_currency as $k => $v){
//            $result[]['usd'] = $v->ccy;
//            $result['buy'] = $v->buy;
//            $result['sale'] = $v->sale;
//        }

        $user = User::findOrFail($id);
        $user->toArray();
        $card = CardUser::find(2);


        return view('main/cabinet',[
            'user' => $user,
            'currency' => $result_currency
        ]);
    }

    public function addMoney(Request $request){
        return view('main.replenish');
    }
}
