<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    public function token_detail(){
        return $this->belongsTo('App\Models\Personal_access_token', 'user_id', 'tokenable_id');
    }

    public function user_details(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function sms_sent(){
        return $this->hasMany('App\Models\Sent_message','sender_name', 'sender_name');
    }
}
