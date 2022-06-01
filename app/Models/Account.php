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
}
