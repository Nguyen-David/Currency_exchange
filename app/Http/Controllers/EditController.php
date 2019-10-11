<?php

namespace App\Http\Controllers;

use App\CardUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EditController extends Controller
{
    //
    public function show(){
        $user = Auth::user();
        $user->toArray();
        return view('main/edit',['user' => $user]);
    }

    public function store(Request $request){
        $user_id = Auth::id();
        $messages = [
            'required' => 'Поле :attribute обязательно к заполнению!',
            'name.max' => 'максимальное количество символов для поля email :max',
            'surname.max' => 'максимальное количество символов для поля email :max',
            'email.unique' => 'Такой :attribute уже существует, поле должно быть уникальным',
            'alpha' => 'Поле :attribute должно содержать только буквы',
        ];

        $rules = [
            'name' => 'required|max:10|alpha',
            'surname' => 'required|max:10|alpha',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user_id),
            ],
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails())
        {
            return redirect()->route('sign_up')->withErrors($validation)->withInput();
        }


        $user = User::find($user_id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->save();

        return redirect('/cabinet')->with('message', 'Вы успешно отредактировали данные!');

    }
}
