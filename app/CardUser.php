<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardUser extends Model
{
    //
    protected $table ='card_user';
    protected $primaryKey ='id';
    public $timestamps = FAlSE;

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
