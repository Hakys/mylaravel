@extends('theme_admin.default')

@section('title', 'Consultas del Día: '.$hoy)

@section('style')
    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>  
    <link rel="stylesheet" href="{!! asset('theme_admin/vendor/calendario-bs/css/calendar.css') !!}">
    <link rel="stylesheet" href="{!! asset('theme_admin/vendor/calendario-bs/css/bootstrap-datetimepicker.min.css') !!}" />
    @include('consultas.style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="page-header"><h2>@yield('title')</h2></div>
            <div class="pull-left form-inline"><br>
                <div class="btn-group">
                    <button class="btn btn-primary" data-calendar-nav="prev"><< Anterior</button>
                <button class="btn" data-calendar-nav="today">Hoy</button>
                    <button class="btn btn-primary" data-calendar-nav="next">Siguiente >></button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-warning" data-calendar-view="year">Año</button>
                    <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                    <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                    <button class="btn btn-warning" data-calendar-view="day">Dia</button>
                </div>
            </div>
            <div class="pull-right form-inline"><br>
            <button class="add_evento-modal btn btn-info" 
                data-toggle='modal' 
                data-target='#add_evento' 
                data-start="{{ $first['start'] }}"
                data-fecha="{{ $first['fecha'] }}" 
                >Registrar Cita Previa</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <table id="consultaTable" class="table table-striped table-bordered table-hover" >
                <thead>
                    <tr class="text-middle">                        
                        <th>Hora</th>
                        <th>Cliente</th>      
                        <th>Comentario</th>      
                        <th>Acciones</th>
                    </tr>                   
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr class="item{{ $cita['id'] }}">  
                            <td class="text-center text-info h4">{{ $cita['hora'] }}</td>
                            @if(!$cita['consulta'])
                                <td colspan="3" class="text-right">
                                    <button class="add_evento-modal btn btn-success btn-sm"  
                                        data-target='#add_evento'
                                        data-toggle='modal'
                                        data-start="{{ $cita['start'] }}" 
                                        data-fecha="{{ $cita['fecha'] }}">
                                        <span class="glyphicon glyphicon-edit"> RESERVAR</span>
                                    </button>
                                </td>
                            @else 
                                <td>{{ $cita['consulta']->cliente['full_name'] }}</td>
                                <td>{{ $cita['consulta']->comentario }}</td>
                                <td class="text-right">
                                    <button class="delete_evento-modal btn btn-danger btn-sm"  
                                        data-target='#add_evento'
                                        data-toggle='modal'
                                        data-start="{{ $cita['start'] }}" 
                                        data-fecha="{{ $cita['fecha'] }}">
                                        <span class="glyphicon glyphicon-edit"> LIBERAR</span>
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div><!-- /.panel-body -->
    </div><!-- /.panel panel-default -->
    <div id="_calendar"></div> <!-- Aqui se mostrara nuestro calendario -->
    <br><br>
    <!--ventana modal para el calendario-->
        <div class="modal fade" id="events-modal">
            <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" style="height: 400px">
                            <p>One fine body&hellip;</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>





@endsection

@section('script')
    @include('consultas.script')
    <!--<script type="text/javascript" src="{!! asset('theme_admin/vendor/calendario-bs/js/jquery.min.js') !!}"></script>-->
    <script type="text/javascript" src="{!! asset('theme_admin/vendor/calendario-bs/js/es-ES.js') !!}"></script>
    <script src="{!! asset('theme_admin/vendor/calendario-bs/js/moment.js') !!}"></script>
    <script src="{!! asset('theme_admin/vendor/calendario-bs/js/bootstrap-datetimepicker.js') !!}"></script>
    <script src="{!! asset('theme_admin/vendor/calendario-bs/js/bootstrap-datetimepicker.es.js') !!}"></script>
    <script src="{!! asset('theme_admin/vendor/calendario-bs/js/underscore-min.js') !!}"></script>
    <script src="{!! asset('theme_admin/vendor/calendario-bs/js/calendar.js') !!}"></script>
    
    <script type="text/javascript">
        (function($){
            //creamos la fecha actual
            var date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
            var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

            //establecemos los valores del calendario
            var options = {
                // definimos que los eventos se mostraran en ventana modal
                modal: '#events-modal', 

                // dentro de un iframe
                modal_type:'iframe',    

                //obtenemos los eventos de la base de datos
                events_source: "{{ route('obtener_eventos') }}", 

                // mostramos el calendario en el mes
                view: 'month',             

                // y dia actual
                day: yyyy+"-"+mm+"-"+dd,   


                // definimos el idioma por defecto
                language: 'es-ES', 

                //Template de nuestro calendario
                tmpl_path: '/theme_admin/vendor/calendario-bs/tmpls/', 
                tmpl_cache: false,


                // Hora de inicio
                time_start: '09:00', 

                // y Hora final de cada dia
                time_end: '21:00',   

                // intervalo de tiempo entre las hora, en este caso son 10 minutos
                time_split: '10',    

                // Definimos un ancho del 100% a nuestro calendario
                width: '100%', 

                onAfterEventsLoad: function(events){
                    if(!events){
                        return;
                    }
                    var list = $('#eventlist');
                    list.html('');

                    $.each(events, function(key, val){
                        $(document.createElement('li'))
                            .html('<a href="' + val.url + '">' + val.title + '</a>')
                            .appendTo(list);
                        });
                    },
                    onAfterViewLoad: function(view){
                        $('.page-header h2').text(this.getTitle());
                        $('.btn-group button').removeClass('active');
                        $('button[data-calendar-view="' + view + '"]').addClass('active');
                    },
                    classes: {
                        months: {
                            general: 'label'
                        }
                }
            };


            // id del div donde se mostrara el calendario
            var calendar = $('#calendar').calendar(options); 

            $('.btn-group button[data-calendar-nav]').each(function(){
                var $this = $(this);
                $this.click(function(){
                    calendar.navigate($this.data('calendar-nav'));
                });
            });

            $('.btn-group button[data-calendar-view]').each(function(){
                var $this = $(this);
                $this.click(function(){
                    calendar.view($this.data('calendar-view'));
                });
            });

            $('#first_day').change(function(){
                var value = $(this).val();
                value = value.length ? parseInt(value) : null;
                calendar.setOptions({first_day: value});
                calendar.view();
            });
        }(jQuery));
    </script>
@endsection