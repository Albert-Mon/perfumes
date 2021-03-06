@extends('Principal')
@section('contenido')

<div class="panel panel-info">
                        <div class="panel-heading">
                          <h3 class="panel-title">Reporte de Agencias Paqueteras</h3>
                      </div>
                      <br>
                      <a href="{{route('altapaqueteria')}}"> <button type="button" class="btn btn-success">Alta Paqueteria</button></a>
                        <br>
                        <br>
                      @if(Session::has('mensajes'))
                        <div class='alert alert-success'>{{Session::get('mensajes')}}</div>
                      @endif
                      
                      <div class="panel-body">

                        <div class="bs-example">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                   
                                            <thead>
                                            <tr>
                                            <th >Logo</th>
                                                <th >Clave</th>
                                                <th >Nombre de Agencia</th>
                                                <th >Estado</th>
                                                <th >Zona</th>
                                                <th >Sucursal</th>
                                                <th >Telefono</th>
                                                <th >Correo</th>
                                                <th >Transporte</th>
                                                <th >Dias de entrega</th>
                                                <th >horario</th>
                                                <th >Operaciones</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($consulta as $c)
                                            <tr>
                                               <td><img src = "{{asset('archivos/'. $c->img)}}" height =50 width=50> </td>
                            
                                                <th >{{$c->Id_paqueteria}}</th>
                                                <td>{{$c->agencia}}</td>
                                                <td>{{$c->idestado}}</td>
                                                <td>{{$c->zona}}</td>
                                                <td>{{$c->sucursal}}</td>
                                                <td>{{$c->telefono}}</td>
                                                <td>{{$c->correo}}</td>
                                                <td>{{$c->transporte}}</td>
                                                <td>{{$c->dias}}</td>
                                                <td>{{$c->horario}}</td>


                                                <td>
                                                    
                                                <a href="{{route('modificarpaqueteria',['Id_paqueteria'=>$c->Id_paqueteria])}}">
                                                    <button type="button" class="btn btn-info">Modificaci??n</button></a>                                                
                                                    @if($c->deleted_at)
                                                    <a href="{{route('activarpaqueteria',['Id_paqueteria'=>$c->Id_paqueteria])}}"> 
                                                        <button type="button" class="btn btn-warning">Activar</button>
                                                    </a>
                                                    <a href="{{route('borrarpaqueteria',['Id_paqueteria'=>$c->Id_paqueteria])}}"> 
                                                        <button type="button" class="btn btn-secondary">Borrar</button></a>
                                                    @else
                                                    <a href="{{route('desactivarpaqueteria',['Id_paqueteria'=>$c->Id_paqueteria])}}"> 
                                                        <button type="button" class="btn btn-danger">Desactivar</button></a>
                                                    @endif

                                                                                                     
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                            </tbody>
                                        </table>
                                    </div>           
                      </div>
@stop