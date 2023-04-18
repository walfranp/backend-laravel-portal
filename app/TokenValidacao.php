<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TokenValidacao extends Model
{

    protected $table = 'token_validacao';

    protected $fillable = [
        'user_id', 'token_type', 'codigo', 'token', 'token_date',
    ];

    const TYPE_VALIDATION_ACCOUNT = 0;
    const TYPE_FORGOT_PASSWORD_RESET = 1;
    const TYPE_INVITE_USER = 2;
    const TYPE_UNLOCK_ACCOUNT = 3;
    const TYPE_ORGANIZATION_LINKED = 4;
    const TYPE_VALIDATION_EMAIL = 5;



    public function addTokenValidacao($token_type, $user_id)
    {
        TokenValidacao::where('user_id', '=', $user_id)->where('token_type', '=', 1)->delete();

        $tokenValidation = TokenValidacao::create([

            'user_id' => $user_id,
            'token_type' => $token_type,
            'codigo' => rand(10000, 199000),
            'token' => Str::random(64),
            'token_date' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return $tokenValidation->codigo;
    }

    public function validarToken($dateToken, $days)
    {
        $lastDate = new DateTime($dateToken);
        $now = new DateTime();
        $now = now();

        $diff = $now->diff($lastDate)->format("%a");
        if ($diff < $days) {
            return true;
        } else {
            return false;
        }
    }

}
