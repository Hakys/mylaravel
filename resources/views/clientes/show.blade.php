@extends('theme_admin.default')

@section('title', 'Ficha de Clientes')

@section('style')
    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>  
    @include('clientes.style')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <h1 class="page-header">@yield('title')</h1>
        </div>
        <!-- /.col-xl-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<div class="panel panel-default">
    <div class="panel-heading">
        <ul>
            <a href="{{ route('clientes.index') }}" ><li><i class="fa fa-users fa-fw">
                </i> Todos los Clientes  <span class="badge badge-primary badge-pill">14</span></li>
            <a href="#" class="add-modal" ><li><i class="fa fa-plus fa-fw"></i>Añadir un Cliente</li></a>
        </ul>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header"><h1>Cliente: {{ $cliente->full_name }}</h1></div>
                            <!-- /.card-header -->
                            <div class="card-body bg-white text-dark">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item active"><a href="#home" data-toggle="tab" class="nav-link active" aria-expanded="true">Evolución</a></li>
                                    <li class="nav-item"><a href="#profile" data-toggle="tab" class="nav-link">Datos Personales</a></li>
                                    <li class="nav-item"><a href="#messages" data-toggle="tab" class="nav-link">Historia Clinica</a></li>
                                    <li class="nav-item"><a href="#settings" data-toggle="tab" class="nav-link">Param. Antropométricos</a></li>
                                    <li class="nav-item"><a href="#notas" data-toggle="tab" class="nav-link">Anotaciones</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane pt-2 fade active in" id="home">                                                
                                        <p><div id="morris-line-chart"></div></p>    
                                    </div>
                                    <div role="tabpanel" class="tab-pane pt-2 fade" id="profile">
                                        <h5>Datos Personales</h5>                                        
                                        <div id="editModal">
                                            <div class="modal-body">
                                                <form class="form-horizontal" role="form">  
                                                    <input type="text" class="hidden" id="id_edit" value="{{ $cliente->id }}">                  
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="full_name">Nombre Completo:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="full_name_edit" autofocus value="{{ $cliente->full_name }}">
                                                            <small>Min: 2, Max: 190, Solo Texto</small>
                                                            <p class="errorFull_name text-center alert alert-danger hidden"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="peso">Peso:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="peso_edit" value="{{ $cliente->peso }}">
                                                            <small>Max: 999,999 Kg.</small>
                                                            <p class="errorPeso text-center alert alert-danger hidden"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="f_nacimiento">Fecha de Nacimiento:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="f_nacimiento_edit" value="{{ $cliente->f_nacimiento }}">
                                                            <small>Ej. 1995/12/12</small>
                                                            <p class="errorF_nacimiento text-center alert alert-danger hidden"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="telefono">Teléfono:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="telefono_edit" value="{{ $cliente->telefono }}">
                                                            <small>Ej. 959123456</small>
                                                            <p class="errorTelefono text-center alert alert-danger hidden"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="email">Email:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="email_edit" value="{{ $cliente->email }}">
                                                            <small>Formato: nombre@servidor.com</small>
                                                            <p class="errorEmail text-center alert alert-danger hidden"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="anotaciones">Notas Personales:</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" id="anotaciones_edit" cols="40" rows="10">{{ $cliente->anotaciones }}</textarea>
                                                            <small>Min: 2, Max: 5000, only text</small>
                                                            <p class="errorAnotaciones text-center alert alert-danger hidden"></p>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary edit" data-dismiss="modal" >
                                                        <span class='glyphicon glyphicon-check'></span> Guardar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane pt-2 fade" id="messages">
                                        <h5>Historia Clinica</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane pt-2 fade" id="settings">
                                        <h5>Param. Antropométricos</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane pt-2 fade" id="notas">
                                        <h5>Notas</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>                                   
                                </div>
                            </div>
                            <!-- /.card-body bg-white text-dark -->
                        </div>
                        <!-- /.panel -->

            </div>
            <div class="col-lg-6">
                <h1>Histórico</h1>
                <div class="panel-heading">
                        <ul>
                            <a href="{{ route('clientes.index') }}" ><li><i class="fa fa-users fa-fw">
                                </i> Todos los Clientes  <span class="badge badge-primary badge-pill">14</span></li>
                            <a href="#" class="add-Consultamodal" ><li><i class="fa fa-plus fa-fw"></i>Añadir Consulta</li></a>
                        </ul>
                    </div>
                <table id="consultaTable" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>                           
                            <th class="text-middle">Fecha</th>                                                                          
                            <th>Peso / Variación</th>                            
                            <th>Comentario</th>                            
                            <th>Acciones</th>
                        </tr>                   
                    </thead>
                    <tbody>
                        @foreach($consultas as $consulta)
                            
                            <tr class="item{{$consulta->id}}">                                
                                <td>{{ \Carbon\Carbon::createFromTimeString($consulta->fecha)->format('d/m/Y') }}</td>
                                <td class="h4"><sup>{{ $consulta->peso }} Kg.</sup> <sub>{{ $consulta->variacion }} Kg.</sub></td>                       
                                <td>{{ $consulta->comentario }}</td>                        
                                <td>                                    
                                    <button class="show-modal btn btn-success" 
                                        data-id="{{$consulta->id}}" 
                                        data-id_cliente="{{$consulta->id_cliente}}"                                     
                                        data-peso="{{$consulta->peso}}"                                     
                                        data-comentario="{{$consulta->comentario}}"
                                        data-toggle="tooltip"
                                        data-placement="top" 
                                        title="Mostrar Consulta">
                                        <span class="glyphicon glyphicon-eye-open"></span></button>
                                    <button class="edit-modal btn btn-info"  
                                        data-id="{{$consulta->id}}" 
                                        data-id_cliente="{{$consulta->id_cliente}}"                                     
                                        data-peso="{{$consulta->peso}}"                                     
                                        data-comentario="{{$consulta->comentario}}"
                                        data-toggle="tooltip"
                                        data-placement="top" 
                                        title="Editar Ficha">
                                        <span class="glyphicon glyphicon-edit"></span></button>
                                    <button class="delete-modal btn btn-danger" 
                                        data-id="{{$consulta->id}}" 
                                        data-id_cliente="{{$consulta->id_cliente}}"                                     
                                        data-peso="{{$consulta->peso}}"                                     
                                        data-comentario="{{$consulta->comentario}}"
                                        data-toggle="tooltip"
                                        data-placement="top" 
                                        title="Eliminar consulta">
                                        <span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /.panel-body -->
</div><!-- /.panel panel-default -->

@include('clientes.modal')

@endsection

@section('script')
    @include('clientes.script')
    <script>
        $(function() {                                               
            Morris.Line({
                // ID of the element in which to draw the chart.
                element: 'morris-line-chart',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data: [
                    {"fecha": "2018-01-01", "inicial": {{ $consultas->first()->cliente->peso_inicial }} },
                    {"fecha": "{{ \Carbon\Carbon::createFromTimeString($consultas->first()->fecha)->format('Y-m-d') }}", "inicial": {{ $consultas->first()->cliente->peso_inicial }} },
                    {"fecha": "{{ TODAY()->format('Y-m-d')}}", "inicial": {{ $consultas->first()->cliente->peso_inicial }} }, 
                   
                    {"fecha": "2018-01-01", "saludable": {{ $consultas->first()->cliente->peso_saludable }} },    
                    {"fecha": "{{ \Carbon\Carbon::createFromTimeString($consultas->first()->fecha)->format('Y-m-d') }}", "saludable": {{ $consultas->first()->cliente->peso_saludable }} },    
                    {"fecha": "{{ TODAY()->format('Y-m-d')}}", "saludable": {{ $consultas->first()->cliente->peso_saludable }} },
                    @foreach($consultas as $consulta)
                        {"fecha": "{{ \Carbon\Carbon::createFromTimeString($consulta->fecha)->format('Y-m-d') }}", "peso": {{ $consulta->peso }}, "variacion": {{ $consulta->variacion }} },
                    @endforeach
                ],
                // The name of the data record attribute that contains x-values.
                xkey: 'fecha',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['inicial','variacion','peso','saludable'],
                // Labels for the ykeys -- will be displayed when you hover over the chart.
                labels: ['INICIAL','VARIACIÓN','PESO','SALUDABLE'],
            });
        });
    </script>
@endsection