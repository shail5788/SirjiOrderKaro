<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
       'otp_code','otp_valid_for'
    ];
}
