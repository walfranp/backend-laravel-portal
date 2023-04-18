<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogAcesso extends Model
{
    protected $fillable = [
        'user_id', 'ip',
    ];

    public function registraAcesso($user_id, $ip){

       LogAcesso::create([
            'user_id' => $user_id,
            'ip' => $ip
        ]);

        return true;

    }
}
