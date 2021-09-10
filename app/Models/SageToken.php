<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SageToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'refresh_token',
        'ativo',
    ];
}
