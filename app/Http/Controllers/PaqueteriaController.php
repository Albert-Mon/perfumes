<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paqueterias;
use Session;
use App\Models\municipios;
use App\Models\estados;

class PaqueteriaController extends Controller
{
    public function altapaqueteria()
    {
        $consulta = paqueterias::orderBy('Id_paqueteria','DESC')
                                    ->take(1)->get();
        $cuantos = count($consulta);
        if($cuantos==0)
        {
            $idsigue = 1;
        }
        else{
            $idsigue = $consulta[0]->Id_paqueteria + 1;
        }
        $estados = estados::all();
        return view('altapaqueteria')
        ->with('estados',$estados)
        ->with('idsigue', $idsigue);
        //return view('altapaqueteria');
    }

    public function guardarpaqueteria(Request $request)
    {
       // return $request;

       $this->validate($request,[
        'agencia'=> 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
        'sucursal'=> 'required|regex:/^[A-Z,a-z, ,0-9]+$/',
        'idestado'=> 'required',
        'municipio'=> 'required|regex:/^[A-Z,a-z, ,0-9]+$/',
        'calle'=> 'required|regex:/^[0-9,A-Z][A-Z,a-z,0-9, ]+$/',
        'numero'=> 'required|regex:/^[#][0-9, A-Z,a-z]*$/',
        'codigo_postal'=> 'required|:/^[0-9]{5}$/',
        'correo'=> 'required|email',
        'telefono'=> 'required|regex:/^[0-9]{10}$/' ,
        'piezas'=> 'required|:/^[0-9]{2}$/',
        'horario'=> 'required|regex:/^[0-9]{2}[:][0-9, ]{3}[a,m,p, ]{2}$/',
        'dias'=> 'required|integer',
        'comision'=> 'required|regex:/^[$][0-9]+[.][0-9]{2}$/',
        'cuenta_bancaria'=> 'required|:/^[0-9]{14}$/',
        'img'=>'image|mimes:gif,jpeg,jpg,png'
       ]);

       $file = $request ->file('img');
       if($file<>""){
       $img =$file->getClientOriginalName();
       $img2 =$request->id_paqueteria . $img;
       \Storage::disk('local')->put($img2, \File::get($file));
       }
       else{
           $img2 = "sinfoto.jpg";
       }
         $paqueteria = new paqueterias;
         $paqueteria -> agencia= $request-> agencia;
         $paqueteria -> sucursal = $request-> sucursal;
         $paqueteria -> idestado = $request-> idestado;
         $paqueteria -> municipio = $request-> municipio;
         $paqueteria -> calle = $request-> calle;
         $paqueteria -> numero = $request-> numero;
         $paqueteria -> codigo_postal = $request-> codigo_postal;
         $paqueteria -> telefono= $request-> telefono;
         $paqueteria -> correo = $request-> correo;
         $paqueteria -> zona = $request-> zona;
         $paqueteria -> piezas= $request-> piezas;
         $paqueteria -> dias= $request-> dias;
         $paqueteria -> horario= $request-> horario;
         $paqueteria -> tipo_pago= $request-> tipo_pago;
         $paqueteria -> transporte= $request-> transporte;
         $paqueteria -> cuenta_bancaria= $request-> cuenta_bancaria;
         $paqueteria -> comision= $request-> comision;
         $paqueteria-> img = $img2;
         $paqueteria -> save();

       Session::flash('mensajes',"La Agencia $request->agencia  ha sido registrada");
        return redirect()->route('reportepaqueteria');

    
    }

    public function reportepaqueteria()
    {
        $consulta = paqueterias::withTrashed()->select('paqueterias.Id_paqueteria','paqueterias.agencia',
            'paqueterias.idestado','paqueterias.zona','paqueterias.sucursal','paqueterias.telefono',
            'paqueterias.correo','paqueterias.transporte','paqueterias.dias',
            'paqueterias.horario','paqueterias.deleted_at','paqueterias.img')
            ->get();

        return view ('reportepaqueteria')->with ('consulta',$consulta);

    }

    public function desactivarpaqueteria($Id_paqueteria)
    {
        $paque = paqueterias::find($Id_paqueteria);
        $paque->delete();

        Session::flash('mensajes',' Ha sido DESACTIVADO');
        return redirect()->route('reportepaqueteria'); 
    }

    public function activarpaqueteria($Id_paqueteria)
    {
        $consulta = paqueterias::withTrashed()->where('Id_paqueteria',$Id_paqueteria)->restore();

        Session::flash('mensajes','Ha sido ACTIVADO');
        return redirect()->route('reportepaqueteria');

    }

    public function borrarpaqueteria($Id_paqueteria)
    {
        $consulta = paqueterias::withTrashed()->find($Id_paqueteria)->forceDelete();

        Session::flash('mensajes','Registro BORRADO DEFINITIVAMENTEMENTE');
        return redirect()->route('reportepaqueteria');
 
    }

    public function modificarpaqueteria($Id_paqueteria)
    {
    //     $consulta = paqueterias::withTrashed()->select('paqueterias.Id_paqueteria', 'paqueterias.agencia',
    //     'paqueterias.sucursal','paqueterias.idestado','paqueterias.municipio','paqueterias.calle','paqueterias.numero',
    //     'paqueterias.codigo_postal','paqueterias.telefono','paqueterias.correo','paqueterias.zona',
    //     'paqueterias.piezas','paqueterias.dias','paqueterias.horario',
    //     'paqueterias.tipo_pago','paqueterias.transporte','paqueterias.cuenta_bancaria','paqueterias.comision','paqueterias.img')
    //    ->where('Id_paqueteria',$Id_paqueteria)
    //    ->get();
    $consulta = paqueterias::where('Id_paqueteria','=',$Id_paqueteria)
		           ->get();
	    $esta = estados::where('idestado','=',$consulta[0]->idestado)
		              ->get();
		$nomest =$esta[0]->nombre;
		$estados = estados::where('idestado','!=',$consulta[0]->idestado)
		             ->get();
		return view ('modificarpaqueteria')
        ->with('estados',$estados)
        ->with('idestado',$consulta[0]->idestado)
		->with('nomest',$nomest)
		->with('consulta',$consulta[0]);

    }

    public function cambiarpaqueteria(Request $request)
    {
        $this->validate($request,[
        'agencia'=> 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
        'sucursal'=> 'required|regex:/^[A-Z,a-z, ,0-9]+$/',
        'idestado'=> 'required',
        'municipio'=> 'required|regex:/^[A-Z,a-z, ,0-9]+$/',
        'calle'=> 'required|regex:/^[0-9,A-Z][A-Z,a-z,0-9, ]+$/',
        'numero'=> 'required|regex:/^[#][0-9, A-Z,a-z]*$/',
        'codigo_postal'=> 'required|:/^[0-9]{5}$/',
        'correo'=> 'required|email',
        'telefono'=> 'required|regex:/^[0-9]{10}$/' ,
        'piezas'=> 'required|:/^[0-9]{2}$/',
        'horario'=> 'required|regex:/^[0-9]{2}[:][0-9, ]{3}[a,m,p, ]{2}$/',
        'dias'=> 'required|integer',
        'comision'=> 'required|regex:/^[$][0-9]+[.][0-9]{2}$/',
        'cuenta_bancaria'=> 'required|:/^[0-9]{14}$/',
        'img'=>'image|mimes:gif,jpeg,jpg,png'
            
        ]);

        $file = $request->file('img');
        if($file<>"")
        {
        $img = $file->getClientOriginalName();
        $img2 = $request->Id_paqueteria . $img;
        \Storage::disk('local')->put($img2, \File::get($file));
        }
 
        $paqueteria = paqueterias::find($request->Id_paqueteria);
        $paqueteria -> Id_paqueteria = $request->Id_paqueteria;
        $paqueteria -> agencia= $request-> agencia;
         $paqueteria -> sucursal = $request-> sucursal;
         $paqueteria -> idestado = $request-> idestado;
         $paqueteria -> municipio = $request-> municipio;
         $paqueteria -> calle = $request-> calle;
         $paqueteria -> numero = $request-> numero;
         $paqueteria -> codigo_postal = $request-> codigo_postal;
         $paqueteria -> telefono= $request-> telefono;
         $paqueteria -> correo = $request-> correo;
         $paqueteria -> zona = $request-> zona;
         $paqueteria -> piezas= $request-> piezas;
         $paqueteria -> dias= $request-> dias;
         $paqueteria -> horario= $request-> horario;
         $paqueteria -> tipo_pago= $request-> tipo_pago;
         $paqueteria -> transporte= $request-> transporte;
         $paqueteria -> cuenta_bancaria= $request-> cuenta_bancaria;
         $paqueteria -> comision= $request-> comision;
         if($file<>"")
        {
            $paqueteria -> img = $img2 ;
        }
         $paqueteria -> save();
 
        Session::flash('mensajes',"Se modificaron los datos de $request->agencia");
         return redirect()->route('reportepaqueteria');
    }
    
}
