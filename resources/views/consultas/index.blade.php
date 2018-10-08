@extends('theme_admin.default')

@section('title', 'Histórico de Consultas')

@section('style')
     <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>  
    @include('consultas.style')
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
            <li><i class="fa fa-users fa-fw"></i> Histórico de Consultas  <span class="badge badge-primary badge-pill">14</span></li>
            <a href="#" class="add-modal"><li><i class="fa fa-plus fa-fw"></i>Pasar Consulta</li></a>
        </ul>
    </div>
    <div class="panel-body">
            <table id="consultaTable" class="table table-striped table-bordered table-hover" >
                <thead>
                    <tr>
                        <th class="text-middle"></th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Cliente</th>                    
                        <th>Peso</th>
                        <th>Actualido</th>
                        <th>Acciones</th>
                    </tr>                   
                </thead>
                <tbody>
                    @foreach($consultas as $consulta)
                        <tr class="item{{$consulta->id}}">
                            <td>{{ $consulta->id }}</td>
                            <td>{{ $consulta->created_at }}</td>
                            <td>{{ $consulta->created_at }}</td>
                            <td>{{ $consulta->id_cliente }}</td>
                            <td>{{ $consulta->peso }}</td>                        
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $consulta->updated_at)->diffForHumans() }}</td>
                            <td>
                                <button type="button" class="btn btn-default" data-toggle="tooltip"
                                    data-placement="left" title="{{$consulta->comentario}}"> 
                                    <span class="fa fa-lg fa-info-circle"></span> Ver Notas
                                </button>
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
    </div><!-- /.panel-body -->
</div><!-- /.panel panel-default -->

@include('consultas.modal')

@endsection

@section('script')
    @include('consultas.script')
@endsection