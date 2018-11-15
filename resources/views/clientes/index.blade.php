@extends('theme_admin.default')

@section('title', 'Clientes')

@section('style')
    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>  
    @include('clientes.style')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <h1 class="page-header">
            <div class="col-sm-11">
                <i class="fa fa-users fa-fw"></i> @yield('title')
                <span class="badge badge-primary badge-pill">{{ $clientes->count() }}</span>
            </div>
            <div class="col-sm text-center">
                <a href="#" class="add-modal" ><i class="fa fa-fw fa-plus-circle"></i></a>
            </div>
        </h1>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<div class="panel panel-default">
    <!--
    <div class="panel-heading">
        <ul>
            <li> Todos los Clientes  </li>
            
        </ul>
    </div>
    -->
    <div class="panel-body table-responsive">
            <table class="table table-striped table-bordered table-hover" id="clienteTable">
                <thead>
                    <tr>
                        <th scope="col" class="text-middle"></th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Fecha de<br>Nacimiento</th>
                        <th scope="col">Altura</th>                    
                        <th scope="col">Peso Inicial<br>y Saludable</th>                    
                        <th scope="col">Activo</th>
                        <th scope="col">Ultima Visita</th>
                        <th scope="col">Próxima Visita</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    {{ csrf_field() }}
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)    
                        <tr class="item{{$cliente->id}} @if(!$cliente->activo) warning @endif">
                            <th scope="row">{{ $cliente->id }}</th>
                            <td><a href="{{ route('clientes.show', $cliente) }}">{{ $cliente->full_name }}</a></td>
                            <td class="text-center">
                                {{\Carbon\Carbon::createFromTimeString($cliente->f_nacimiento)->age }} años
                                ({{\Carbon\Carbon::createFromTimeString($cliente->f_nacimiento)->format('d/m/Y') }})
                            </td>                  
                            <td class="text-right">{{ $cliente->altura }} m.</td>
                            <td class="text-right">
                                <span class="text-danger">{{ $cliente->peso_inicial }} Kg.</span> -> <span class="text-info">{{ $cliente->peso_saludable }} Kg.</span><br>
                                <span class="text-warning">{{ $cliente->consultas()->where('asistio',1)->orderbydesc('fecha')->first()->peso }} Kg.</span>
                            </td>                           
                            <!--<td>{{ App\Cliente::getExcerpt($cliente->anotaciones) }}</td>-->
                            <td class="text-center"><input type="checkbox" class="activado" data-id="{{$cliente->id}}" @if($cliente->activo) checked @endif></td>
                            <td>@if($cliente->consultas()->count())                                     
                                {{$cliente->consultas()->where('asistio',1)->orderbydesc('fecha')->first()->fecha->diffForHumans()}}
                            @endif</td>
                            <td>@if($cliente->consultas()->where('asistio',0)->orderby('fecha')->first()->anotacion!='peso esperado')
                                {{$cliente->consultas()->where('asistio',0)->orderby('fecha')->first()->fecha->diffForHumans()}}
                                ({{$cliente->consultas()->where('asistio',0)->orderby('fecha')->first()->fecha->format('d/m/Y h:i')}})
                            @else
                                <a href="">Reservar Cita</a>
                            @endif</td>
                            <td>
                                <!--
                                <button class="show-modal btn btn-success" 
                                    data-id="{{$cliente->id}}" 
                                    data-full_name="{{$cliente->full_name}}"                                     
                                    data-peso_inicial="{{$cliente->peso_inicial}}" 
                                    data-peso_saludable="{{$cliente->peso_saludable}}" 
                                    data-f_nacimiento="{{$cliente->f_nacimiento}}"
                                    data-altura="{{$cliente->altura}}"
                                    data-telefono="{{$cliente->telefono}}"                                 
                                    data-email="{{$cliente->email}}" 
                                    data-anotaciones="{{$cliente->anotaciones}}"
                                    data-toggle="tooltip"
                                    data-placement="top" 
                                    title="Mostrar Ficha">
                                    <span class="glyphicon glyphicon-eye-open"></span></button>
                                <button class="delete-modal btn btn-danger" 
                                    data-id="{{$cliente->id}}" 
                                    data-full_name="{{$cliente->full_name}}" 
                                    data-peso_inicial="{{$cliente->peso_inicial}}" 
                                    data-peso_saludable="{{$cliente->peso_saludable}}" 
                                    data-f_nacimiento="{{$cliente->f_nacimiento}}"
                                    data-altura="{{$cliente->altura}}" 
                                    data-telefono="{{$cliente->telefono}}" 
                                    data-email="{{$cliente->email}}" 
                                    data-anotaciones="{{$cliente->anotaciones}}"
                                    data-toggle="tooltip"
                                    data-placement="top" 
                                    title="Eliminar Cliente">
                                    <span class="glyphicon glyphicon-trash"></span></button>
                                -->
                                <button class="edit-modal btn btn-info"  
                                    data-id="{{$cliente->id}}" 
                                    data-full_name="{{$cliente->full_name}}" 
                                    data-peso_inicial="{{$cliente->peso_inicial}}" 
                                    data-peso_saludable="{{$cliente->peso_saludable}}" 
                                    data-f_nacimiento="{{$cliente->f_nacimiento}}"
                                    data-altura="{{$cliente->altura}}"
                                    data-telefono="{{$cliente->telefono}}" 
                                    data-email="{{$cliente->email}}" 
                                    data-anotaciones="{{$cliente->anotaciones}}"
                                    data-toggle="tooltip"
                                    data-placement="top" 
                                    title="Editar Ficha">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </button>
                                @if($cliente->anotaciones)
                                <button type="button" class="btn btn-default" data-toggle="tooltip"
                                    data-placement="left" title="{{$cliente->anotaciones}}"> 
                                    <span class="fa fa-lg fa-info-circle"></span> Notas
                                </button>
                                @endif
                            </td>
                        </tr>                        
                    @endforeach
                </tbody>
            </table>
    </div><!-- /.panel-body -->
</div><!-- /.panel panel-default -->

@include('clientes.modal-add')
@include('clientes.modal-delete')
@include('clientes.modal-edit')
@include('clientes.modal-show')
@include('consultas.modal')

@endsection

@section('script')
    @include('clientes.script')
@endsection