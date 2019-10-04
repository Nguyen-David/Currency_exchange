<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class EditController extends Controller
{
    //
    public function show($id){
        $user = User::find($id);
        $user->toArray();
        return view('main/edit',['user' => $user]);
    }
}
