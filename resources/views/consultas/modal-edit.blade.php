<!-- Modal form to add a cita previa -->
<div class="modal fade" id="edit_consulta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Agregar nuevo evento</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-6" for="fecha_evento">Fecha y Hora:</label>
                        <div class="col-sm-6">
                            <div class='input-group date fecha_evento_div' id='fecha_evento_div'>
                                <input type='text' id="fecha_evento" name="fecha_evento" class="form-control" />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                            </div>
                            <small>Formato: F y H</small>
                            <p class="errorFecha_evento text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_cliente_evento">Cliente:</label>
                        <div class="col-sm-10">                            
                            <select class="form-control" id="id_cliente_evento">
                                <option value="" selected='selected'>- seleccione un cliente -</option>
                                @foreach($clientes as $cliente)    
                                    <option value="{{$cliente->id}}">{{$cliente->full_name}}</option>
                                @endforeach                                
                            </select>
                            <small>* Campo Obligatorio</small>
                            <p class="errorId_cliente_evento text-center alert alert-danger hidden"></p>
                        </div>
                    </div> 
                    <div class="form-group">     
                        <label class="control-label col-sm-2" for="tipo_evento">Tipo de evento</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="class" id="tipo_evento">
                                <option value="event-info">Información</option>
                                <option value="event-success">Exito</option>
                                <option value="event-important" selected>Importante</option>
                                <option value="event-warning">Advertencia</option>
                                <option value="event-special">Especial</option>
                            </select>
                            <small>* Campo Obligatorio</small>
                            <p class="errorTipo_evento text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="anotaciones">Comentario:</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="comentario_evento" cols="40" rows="10"></textarea>
                            <small>Min: 2, Max: 128, only text</small>
                            <p class="errorComentario_evento text-center alert alert-danger hidden"></p>
                        </div>
                    </div>        
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success addConsulta" data-dismiss="modal">
                        <span id="" class='glyphicon glyphicon-save'></span> Guardar
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>