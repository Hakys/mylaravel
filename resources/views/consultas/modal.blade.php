<!-- Modal form to add a consulta -->
<div id="addConsultaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="full_name">Cliente:</label>
                        <div class="col-sm-10">                            
                            <select class="form-control" id="id_cliente_add" autofocus>
                                @foreach($clientes as $cliente)    
                                    <option value="{{$cliente->id}}">{{$cliente->full_name}}</option>
                                @endforeach                                
                            </select>
                            <small>* Campo Obligatorio</small>
                            <p class="errorId_cliente text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="peso">Peso:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="peso_add">
                            <small>Max: 999,999 Kg.</small>
                            <p class="errorPeso text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="anotaciones">Comentario:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="comentario_add" cols="40" rows="10"></textarea>
                            <small>Min: 2, Max: 128, only text</small>
                            <p class="errorComentario text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <hr>
                    <label for="from">Inicio</label>
                    <div class='input-group date' id='from'>
                        <input type='text' id="from" name="from" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>
                    <br>
                    <label for="to">Final</label>
                    <div class='input-group date' id='to'>
                        <input type='text' name="to" id="to" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>
                    <br>            
                    <label for="tipo">Tipo de evento</label>
                    <select class="form-control" name="class" id="tipo">
                        <option value="event-info">Informacion</option>
                        <option value="event-success">Exito</option>
                        <option value="event-important">Importantante</option>
                        <option value="event-warning">Advertencia</option>
                        <option value="event-special">Especial</option>
                    </select>
                    <br>
                    <label for="title">Título</label>
                    <input type="text" required autocomplete="off" name="title" class="form-control" id="title" placeholder="Introduce un título">
                    <br>
                    <label for="body">Evento</label>
                    <textarea id="body" name="event" required class="form-control" rows="3"></textarea>    
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

<!-- Modal form to show a post -->
<div id="showConsultaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form"> @method('GET')
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="full_name">Nombre Completo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="full_name_show" disabled> 
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="peso">Peso:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="peso_show" disabled>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="f_nacimiento">Fecha de Nacimiento:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="f_nacimiento_show" disabled>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="telefono">Teléfono:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telefono_show" disabled>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email_show" disabled>
                        </div>
                    </div>    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="anotaciones">Anotaciones:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="anotaciones_show" cols="40" rows="10" disabled></textarea>
                        </div>
                    </div>      
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to edit a form -->
<div id="editConsultaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form"> @method('PUT')  
                    <input type="text" class="hidden" id="id_edit" disabled>                  
                    <div class="form-group">
                            <label class="control-label col-sm-2" for="full_name">Nombre Completo:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="full_name_edit" autofocus>
                                <small>Min: 2, Max: 190, Solo Texto</small>
                                <p class="errorFull_name text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="peso">Peso:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="peso_edit">
                                <small>Max: 999,999 Kg.</small>
                                <p class="errorPeso text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="f_nacimiento">Fecha de Nacimiento:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="f_nacimiento_edit">
                                <small>Ej. 1995/12/12</small>
                                <p class="errorF_nacimiento text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="telefono">Teléfono:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="telefono_edit">
                                <small>Ej. 959123456</small>
                                <p class="errorTelefono text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email_edit">
                                <small>Formato: nombre@servidor.com</small>
                                <p class="errorEmail text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="anotaciones">Notas Personales:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="anotaciones_edit" cols="40" rows="10"></textarea>
                                <small>Min: 2, Max: 5000, only text</small>
                                <p class="errorAnotaciones text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                        <span class='glyphicon glyphicon-check'></span> Guardar
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to delete a form -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <h3 class="text-center">Desea BORRAR la ficha con la siguiente información</h3>
                    <br />
                    <div class="form-group">
                        <label class="control-label col-sm-2 text-right" for="id_delete">Nombre:</label>
                        <div class="col-sm-10" >
                            <p id="id_delete"></p>
                            
                        </div>
                    </div>                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Borrar
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Volver
                        </button>
                    </div> 
                </form> 
            </div>     
        </div>
    </div>
</div>