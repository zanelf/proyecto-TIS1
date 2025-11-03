<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'rut_admin',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}