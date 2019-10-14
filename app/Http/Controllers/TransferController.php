<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
{
    //
    public function show(){
        return view('main\transfer');
    }

    public function store(Request $request){
        $user = Auth::user();

        $messages = [
            'required' => 'Поле :attribute обязательно к заполнению!',
            'money.max' => 'максимальное количество денег для перевода :max',
        ];

        $rules = [
            'money' => 'required|max:'. $user->card->money.'|numeric',
            'valute' => 'required',
        ];
        $validation = Validator::make($request->all(), $rules, $messages);


        if ($validation->fails())
        {
            return redirect()->route('transfer')->withErrors($validation)->withInput();
        }

        $curl = curl_init();
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11');
        $result_currency = json_decode(curl_exec($curl), FALSE);
        curl_close($curl);

        foreach ($result_currency as $k => $v){
            if($v->ccy == $request->valute) {
               $res['value'] = $request->money/$v->buy ;
               $res['valute'] = $v->ccy;
            }
        }


        return redirect()->route('transfer')->with('value',round($res['value'], 2))
            ->with('valute',$res['valute']);
    }
}
