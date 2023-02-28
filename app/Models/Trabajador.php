<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $table = 'trabajadores';

    protected $primaryKey = 'id_trabajador';

    protected $fillable = ['dni_persona','id_rol'];

    public function personas(){
        return $this->belongsTo([Persona::class,'dni_persona']
        );
    }

    public function roles(){
        return $this->belongsTo([Rol::class,'id_rol']
        );
    }
}
