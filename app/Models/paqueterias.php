<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes; 
class paqueterias extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $primaryKey='Id_paqueteria';
    protected $fillable = ['Id_paqueteria','agencia','sucursal','estado','municipio','calle','numero',
    'codigo_postal','telefono','correo','zona','piezas','dias','horario','tipo_pago','cuenta_bancaria','comision','transporte','img'];
}
