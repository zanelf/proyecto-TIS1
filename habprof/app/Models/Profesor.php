<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'profesor';
    protected $primaryKey = 'rut_profesor';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'rut_profesor',
        'nombre_profesor',
        'dinf',
    ];

    public $timestamps = false;
}