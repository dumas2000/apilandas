<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $primaryKey = 'dni_persona';

    protected $fillable = ['dni_persona','nombres','apellidos','celular','direccion'];

    public function trabajadores(){
        return $this->hasMany(Trabajador::class,'dni_persona');
    }
}
