<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;       //para que borre logicamente

class administradores extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $primaryKey='ClaveAdministrador';
    protected $fillable = ['ClaveAdministrador','Fotografia','NombreUsuario','Nombre','ApellidoPaterno',
                            'ApellidoMaterno','Sexo','Telefono','Correo','Contraseña'];
}
