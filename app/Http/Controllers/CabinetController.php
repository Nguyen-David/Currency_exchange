<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    //
    public function show($id){
        $user = User::findOrFail($id);
        $user->toArray();
        return view('main/cabinet',['user' => $user]);
    }
}
