@extends('Principal')
@section('contenido')

<div class="panel panel-warning">
                      <div class="panel-heading"> 
                        <h3 class="panel-title">Registro de Paqueteria</h3>
                      </div>
                      <div class="panel-body">

<form action ="{{route('guardarpaqueteria')}}" method ="POST" enctype='multipart/form-data'>
                            {{csrf_field()}}
                            <div class="col-md-12 form-group">
                            <label for="dni">Clave de Paquetria:
                              @if($errors->first('Id_paqueteria'))
                              <p class='text-danger'> {{$errors->first('Id_paqueteria')}}</p>
                              @endif
                            </label>
                            <input type="text" name="Id_paqueteria" id="idpaquete" value="{{$idsigue}}" readonly='readonly' class="form-control"tabindex="5">
                         </div>

                          <div class="col-md-6">
                            <label>Nombre de Agencia:
                            @if($errors->first('agencia'))
                            <p class='text-danger'>{{$errors->first ('agencia')}}</agencia>
                            @endif
                            </label>
                            <input type="text" class="form-control" placeholder="Ejem: DHL" name="agencia" id="agencia" value="{{old('agencia')}}">
                          </div>
                          <div class="col-md-6 ">
                            <label>Sucursal:
                            @if($errors->first('sucursal'))
                            <p class='text-danger'>{{$errors->first ('sucursal')}}</sucursal>
                            @endif
                            </label>
                            <input type="text" class="form-control" placeholder="Ejem: 20AD2"name="sucursal" id="sucursal" value="{{old('sucursal')}}">
                          </div>
                      
                          <div class="col-md-3">
                            <label for="dni">Estado: 
                                @if ($errors->first('idestado'))
                                  <p class='text-danger'>{{$errors->first('idestado')}}</p>
                                @endif</label>
                                  <select class="form-control" name="idestado">
                                @foreach($estados as $est)
                                  <option value="{{$est->idestado}}">{{$est->nombre}}</option>
                                @endforeach
                                  </select>
                          </div>
                            
                            <br>
                            <div class="col-md-3">
                            <label>Municipio:
                            @if($errors->first('municipio'))
                            <p class='text-danger'>{{$errors->first ('municipio')}}</municipio>
                            @endif
                            </label>
                            <input type="text" class="form-control" placeholder="Ejem: Zacatlan"name="municipio" id="municipio" value="{{old('municipio')}}">
                          </div>
                           <div class="col-md-6">
                            <label>Calle:
                            @if($errors->first('calle'))
                            <p class='text-danger'>{{$errors->first ('calle')}}</calle>
                            @endif
                            </label>
                            <input type="text" class="form-control" placeholder="Ejem: Independencia" name="calle" id="calle" value="{{old('calle')}}">
                          </div>
  
                          <div class="col-md-2">
                            <label>Número:
                            @if($errors->first('numero'))
                            <p class='text-danger'>{{$errors->first ('numero')}}</numero>
                            @endif
                            </label>
                            <input type="text" class="form-control" placeholder="Ejem: #32" name="numero" id="numero"  value="{{old('numero')}}">
                          </div>
                          <div class="col-md-2 ">
                            <label>Codigo Postal:
                            @if($errors->first('codigo_postal'))
                            <p class='text-danger'>{{$errors->first ('codigo_postal')}}</cp>
                            @endif
                            </label>
                            <input type="text" class="form-control" placeholder="Ejem: 52010"name="codigo_postal" id="codigo_postal" value="{{old('codigo_postal')}}">
                          </div>

                            <div class="col-md-8 form-group">
                              <label>Correo Electronico:
                              @if($errors->first('correo'))
                            <p class='text-danger'>{{$errors->first ('correo')}}</correo>
                            @endif
                              </label>
                              <input class="form-control" placeholder="Ejemplo:Juan@gmail.com"  name="correo" id="correo" value="{{old('correo')}}" >
                            </div>

                            <div class="col-md-4 form-group">
                              <label for="tel">Telefono:
                                @if($errors->first('telefono'))
                            <p class='text-danger'>{{$errors->first ('telefono')}}</telefono>
                            @endif
                              </label>
                              <input type="text" class="form-control" placeholder="Ejemplo: 7255885555" name="telefono" id="telefono" value="{{old('telefono')}}">
                            </div>
                            <div class="col-md-3">
                            <label>Zona:
                             </label>
                                <select class="form-control" name="zona" id="zona" value="{{old('zona')}}">
                                    <option value="centro">Centro</option>
                                    <option value="norte">Norte</option>
                                    <option value="sur">Sur</option>
                                 
                      </select>
                    </div>
                            <div class="col-md-4 ">
                            <label>Maximo de piezas:
                            @if($errors->first('piezas'))
                            <p class='text-danger'>{{$errors->first ('piezas')}}</piezas>
                            @endif
                            </label>
                            <input type="text" class="form-control" placeholder="Ejem: 50"name="piezas" id="piezas" value="{{old('piezas')}}">
                          </div>
                            <div class="form-group col-md-12">
                            <div class="col-md-6">
                              
                            
                          
                            <div class="col-md-4">
                            
                            <label>Dias de entrega:
                            @if($errors->first('dias'))
                            <p class='text-danger'>{{$errors->first ('dias')}}</dias>
                            @endif
                            </label>
                            <input type="text" class="form-control" placeholder="Ejem: 10 "name="dias" id="dias" value="{{old('dias')}}">
                          </div>

                            <div class="col-md-4">
                            <label>Horario:
                            @if($errors->first('horario'))
                            <p class='text-danger'>{{$errors->first ('horario')}}</horario>
                            @endif
                            </label>
                            <input type="text" class="form-control" placeholder="Ejem: 10:00 am" name="horario" id="horario" value="{{old('horario')}}">
                          </div>
                          </div>
                           

                            <div class="row">
                            <div class="col-md-3">   
                            <label for="dni">Transporte:</label>
                                    <div class="custom-control custom-radio">
                                    <input type="radio" id="transporte1" name="transporte"  value = "Motocicleta" class="custom-control-input" checked="">
                                    <label class="custom-control-label" for="transporte1">Motocicleta</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                    <input type="radio" id="transporte2" name="transporte" value = "Camioneta" class="custom-control-input">
                                    <label class="custom-control-label" for="transporte2">Camioneta</label>
                                    </div>
                            </div>

                            <div class="row">
                            <div class="col-md-3">
                                <label for="dni">Tipo de Pago:</label>
                                <div class="custom-control custom-radio">
                                <input type="radio" id="pago1" name="tipo_pago"  value = "Tarjeta" class="custom-control-input" checked="">
                                <label class="custom-control-label" for="pago1">Tarjeta</label>
                                </div>
                                <div class="custom-control custom-radio">
                                <input type="radio" id="pago2" name="tipo_pago" value = "Transferencia" class="custom-control-input">
                                <label class="custom-control-label" for="pago2">Transferencia</label>
                                </div>
                            </div>
                         </div>

                         </div>

                            <div class="col-md-4">
                            <label>Cuenta Bancaria:
                            @if($errors->first('cuenta_bancaria'))
                            <p class='text-danger'>{{$errors->first ('cuenta_bancaria')}}</cuenta>
                            @endif
                            </label>
                            <input type="text" class="form-control" placeholder="16 digitos" name="cuenta_bancaria" id="cuenta_bancaria" value="{{old('cuenta_bancaria')}}">
                          </div>
                          <div class="col-md-2">
                            <label>Comisiones extras:
                            @if($errors->first('comision'))
                            <p class='text-danger'>{{$errors->first('comision')}}</comision>
                            @endif
                            </label>
                            <input type="text" class="form-control" placeholder="Ejem: $35"name="comision" id="comision" value="{{old('comision')}}">
                          </div>


                          <div class="col-md-4">
                            <label>Logo:         
                            </label>
                            @if($errors->first('img'))
                            <p class='text-danger'>{{$errors->first ('img')}}</img>
                            @endif
                              </label>
                            <input type="file" class="form-control" name="img" id="img" value="img" tabindex="6">
                          </div>

                          <br>
                          <div class=" col-md-4 form-group">
                          <br>
                          <div class="col-md-6">
                            <button class="btn btn-success btn-block">Guardar</button>
                          </div>
                          <div class="col-md-6">
                            <button  class="btn btn-danger btn-block">Cancelar</button>
                          </div>
                          </div>
                          </div>
                          </div>

                        </form>
            





                         
@stop