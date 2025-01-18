<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logging extends Model
{
    //
    protected $fillable = [
        'user_id',
        'action',
        'message',
        'ip_address'
    ];

    public static function record($user_id, $action, $message, $ip_address)
    {
        Logging::create([
            'user_id' => $user_id->id,
            'action' => $action,
            'message' => $message,
            'ip_address' => $ip_address
        ]);
    }
}
