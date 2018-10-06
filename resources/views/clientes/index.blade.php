@extends('theme_admin.default')

@section('title', 'Listado de Clientes')

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
            <li><i class="fa fa-users fa-fw"></i> Todos los Clientes  <span class="badge badge-primary badge-pill">14</span></li>
            <a href="#" class="add-modal"><li><i class="fa fa-plus fa-fw"></i>Añadir un Cliente</li></a>
        </ul>
    </div>
    <style>
        th{
            text-align: center;
        }
    </style>
    <div class="panel-body">
            <table class="table table-striped table-bordered table-hover" id="clienteTable">
                <thead>
                    <tr>
                        <th class="text-middle"></th>
                        <th>Nombre Completo</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Peso</th>                    
                        <th>Activo</th>
                        <th>Actualido</th>
                        <th>Acciones</th>
                    </tr>
                    {{ csrf_field() }}
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr class="item{{$cliente->id}} @if(!$cliente->activo) warning @endif">
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->full_name }}</td>
                            <td>{{ $cliente->f_nacimiento }}</td>                            
                            <td>{{ $cliente->peso }}</td>
                            <!--<td>{{ App\Cliente::getExcerpt($cliente->anotaciones) }}</td>-->
                            <td class="text-center"><input type="checkbox" class="activado" data-id="{{$cliente->id}}" @if ($cliente->activo) checked @endif></td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cliente->updated_at)->diffForHumans() }}</td>
                            <td>
                                <button type="button" class="btn btn-default" data-toggle="tooltip"
                                    data-placement="left" title="{{$cliente->anotaciones}}"> 
                                    <span class="fa fa-lg fa-info-circle"></span> Ver Notas
                                </button>
                                <button class="show-modal btn btn-success" 
                                    data-id="{{$cliente->id}}" 
                                    data-full_name="{{$cliente->full_name}}" 
                                    data-f_nacimiento="{{$cliente->f_nacimiento}}"
                                    data-peso="{{$cliente->peso}}" 
                                    data-telefono="{{$cliente->telefono}}" 
                                    data-email="{{$cliente->email}}" 
                                    data-anotaciones="{{$cliente->anotaciones}}"
                                    data-toggle="tooltip"
                                    data-placement="top" 
                                    title="Mostrar Ficha">
                                    <span class="glyphicon glyphicon-eye-open"></span></button>
                                <button class="edit-modal btn btn-info"  
                                    data-id="{{$cliente->id}}" 
                                    data-full_name="{{$cliente->full_name}}" 
                                    data-f_nacimiento="{{$cliente->f_nacimiento}}"
                                    data-peso="{{$cliente->peso}}" 
                                    data-telefono="{{$cliente->telefono}}" 
                                    data-email="{{$cliente->email}}" 
                                    data-anotaciones="{{$cliente->anotaciones}}"
                                    data-toggle="tooltip"
                                    data-placement="top" 
                                    title="Editar Ficha">
                                    <span class="glyphicon glyphicon-edit"></span></button>
                                <button class="delete-modal btn btn-danger" 
                                    data-id="{{$cliente->id}}" 
                                    data-full_name="{{$cliente->full_name}}" 
                                    data-f_nacimiento="{{$cliente->f_nacimiento}}"
                                    data-peso="{{$cliente->peso}}" 
                                    data-telefono="{{$cliente->telefono}}" 
                                    data-email="{{$cliente->email}}" 
                                    data-anotaciones="{{$cliente->anotaciones}}"
                                    data-toggle="tooltip"
                                    data-placement="top" 
                                    title="Eliminar Cliente">
                                    <span class="glyphicon glyphicon-trash"></span></button>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
    </div><!-- /.panel-body -->
</div><!-- /.panel panel-default -->

@include('clientes.modal')

@endsection

@section('script')
    @include('clientes.script')
@endsection