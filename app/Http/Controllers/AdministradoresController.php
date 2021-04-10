<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\administradores;
use Session;

class AdministradoresController extends Controller
{
    public function altaadmin()
    {
        $consulta = administradores::orderBy('ClaveAdministrador','DESC')
                                    ->take(1)->get();
        $cuantos = count($consulta);
        if($cuantos==0)
        {
            $idsigue = 1;
        }
        else{
            $idsigue = $consulta[0]->ClaveAdministrador + 1;
        }

        return view('altaadmin')
                ->with('idsigue', $idsigue);
        //return view ('altaadmin');
    }

    public function guardaradmin(Request $request)
    {
       // return $request;

       $this->validate($request,[
           //'ClaveAdministrador'=>'required|regex:/^[A][D][M][-][0-9]+$/',
           'Fotografia'=>'image|mimes:gif,jpeg,png',
           'NombreUsuario'=>'required|regex:/^[A-Z,a-z,á,é,í,ó,ú,_,0-9]+$/',
           'Nombre'=>'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
           'ApellidoPaterno'=>'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
           'ApellidoMaterno'=>'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
           'Telefono'=>'required|regex:/^[0-9]{10}$/',
           'Correo'=>'required|email',
           'Contraseña'=>'required',
       ]);

       $file = $request->file('Fotografia');
       if($file<>"")
       {
       $img = $file->getClientOriginalName();
       $img2 = $request->ClaveAdministrador . $img;
       \Storage::disk('local')->put($img2, \File::get($file));
       }
       else{
           $img2 = "sinfoto.jpg";
       }


       $admin = new administradores;
       $admin -> ClaveAdministrador = $request->ClaveAdministrador;
       $admin -> Fotografia = $img2;
       $admin -> NombreUsuario = $request->NombreUsuario;
       $admin -> Nombre = $request->Nombre;
       $admin -> ApellidoPaterno = $request->ApellidoPaterno;
       $admin -> ApellidoMaterno = $request->ApellidoMaterno;
       $admin -> Sexo = $request->Sexo;
       $admin -> Telefono = $request->Telefono;
       $admin -> Correo = $request->Correo;
       $admin -> Contraseña = $request->Contraseña;
       $admin -> save();

       Session::flash('mensaje',"El Administrador $request->Nombre $request->ApellidoPaterno ha sido dado de ALTA");
        return redirect()->route('reporteadmin');

      
    }

    public function reporteadmin()
    {
       $consulta = administradores::withTrashed()->select('administradores.ClaveAdministrador','administradores.Fotografia',
       'administradores.NombreUsuario','administradores.Nombre','administradores.ApellidoPaterno','administradores.ApellidoMaterno',
       'administradores.Sexo','administradores.Telefono', 'administradores.Correo','administradores.deleted_at')        // si manda null es porque no esta desactivado y la fecha es que si lo esta.
       ->get();
		
		return view ('reporteadmin')
		->with('consulta',$consulta);
    }

    public function desactivaradmin($ClaveAdministrador)
    {
        //una vez que reciba la id se va al modelo de empleados y busca el registro con la llave y se borra
        $admin = administradores::find($ClaveAdministrador);
        $admin->delete();

        Session::flash('mensaje','El Administrador ha sido DESACTIVADO');
        return redirect()->route('reporteadmin'); 
    }

    public function activaradmin($ClaveAdministrador)
    {
        //withTrashed muestra todos los activos y desactivados
        $consulta = administradores::withTrashed()->where('ClaveAdministrador',$ClaveAdministrador)->restore();

        Session::flash('mensaje','El Administrador ha sido ACTIVADO');
        return redirect()->route('reporteadmin');

    }

    public function borraradmin($ClaveAdministrador)
    {
        $consulta = administradores::withTrashed()->find($ClaveAdministrador)->forceDelete();

        Session::flash('mensaje','El Administrador ha sido BORRADO PERMANENTEMENTE');
        return redirect()->route('reporteadmin');
 
    }

    public function modificaradmin($ClaveAdministrador)
    {
        $consulta = administradores::withTrashed()->select('administradores.ClaveAdministrador','administradores.Fotografia',
        'administradores.NombreUsuario','administradores.Nombre','administradores.ApellidoPaterno','administradores.ApellidoMaterno',
        'administradores.Sexo','administradores.Telefono','administradores.Correo','administradores.Contraseña')
       ->where('ClaveAdministrador',$ClaveAdministrador)
       ->get();
		
		return view ('modificaradmin')
		->with('consulta',$consulta[0]);

    }

    public function cambiaradmin(Request $request)
    {
        $this->validate($request,[
            //'ClaveAdministrador'=>'required|regex:/^[A][D][M][-][0-9]+$/',
            'Fotografia'=>'image|mimes:gif,jpeg,png',
            'NombreUsuario'=>'required|regex:/^[A-Z,a-z,á,é,í,ó,ú,_,0-9]+$/',
            'Nombre'=>'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'ApellidoPaterno'=>'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'ApellidoMaterno'=>'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'Telefono'=>'required|regex:/^[0-9]{10}$/',
            'Correo'=>'required|email',
            'Contraseña'=>'required',
            
        ]);

        $file = $request->file('Fotografia');
        if($file<>"")
        {
        $img = $file->getClientOriginalName();
        $img2 = $request->ClaveAdministrador . $img;
        \Storage::disk('local')->put($img2, \File::get($file));
        }
 
        $admin = administradores::find($request->ClaveAdministrador);
        $admin -> ClaveAdministrador = $request->ClaveAdministrador;
        if($file<>"")
        {
            $admin -> Fotografia = $img2 ;
        }
        $admin -> NombreUsuario = $request->NombreUsuario;
        $admin -> Nombre = $request->Nombre;
        $admin -> ApellidoPaterno = $request->ApellidoPaterno;
        $admin -> ApellidoMaterno = $request->ApellidoMaterno;
        $admin -> Sexo = $request->Sexo;
        $admin -> Telefono = $request->Telefono;
        $admin -> Correo = $request->Correo;
        $admin -> Contraseña = $request->Contraseña;
        $admin -> save();
 
        Session::flash('mensaje',"El Administrador $request->Nombre $request->ApellidoPaterno ha sido MODIFICADO");
         return redirect()->route('reporteadmin');
    }
 
}





















    

   /* public function eloquent()      
    {
        //return "operacion realizada";
        $consulta = administradores::all();

        return $consulta;
    }




    public function vista()
    {
        return view ('vista');
    }

    public function ejemplo()
    {
        return view ('ejemplo');
    }

     return view('mensajes')
       ->with('proceso', "Alta de Administradores")
       ->with('mensaje',"El admin $request->Nombre $request->ApellidoPaterno ha sido dado de alta");

        return $request;

        echo "Todo correcto";

     $file = $request->file('Fotografia');
       $Fotografia = $file-> getClientOriginalName();
       $image = $request->ClaveAdministrador . $Fotografia;
       \Storage::disk('local')->put($image, \File::get($file));

   */


   

