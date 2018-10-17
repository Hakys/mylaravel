<!-- Modal form to add a cliente -->
<div id="addModal" class="modal fade" role="dialog">
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
                        <label class="control-label col-sm-2" for="full_name">Nombre Completo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="full_name_add" autofocus value="el nombre">
                            <small>Min: 2, Max: 190, Solo Texto</small>
                            <p class="errorFull_name text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="peso_inicial">Peso Inicial:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="peso_inicial_add" value="145.00">
                                <small>Formato: 999.999</small>
                                <p class="errorPeso_inicial text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="peso_saludable">Peso Saludable:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="peso_saludable_add" value="85.0">
                                <small>Formato: 999.999</small>
                                <p class="errorPeso_saludable text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="f_nacimiento">Fecha de Nacimiento:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="f_nacimiento_add" value="1995/12/12">
                                <small>Formato: 1995/12/12</small>
                                <p class="errorF_nacimiento text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="altura">Altura:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="altura_add" value="1.75">
                                <small>Formato: 1.75</small>
                                <p class="errorAltura text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="telefono">Teléfono:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telefono_add" value="959123456">
                            <small>Formato: 959123456</small>
                            <p class="errorTelefono text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email_add" value="nombre@servidor.com">
                            <small>Formato: nombre@servidor.com</small>
                            <p class="errorEmail text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="anotaciones">Anotaciones:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="anotaciones_add" cols="40" rows="10"></textarea>
                            <small>Min: 2, Max: 128, only text</small>
                            <p class="errorAnotaciones text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success add" data-dismiss="modal">
                        <span id="" class='glyphicon glyphicon-save'></span> Guardar
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to show a post -->
<div id="showModal" class="modal fade" role="dialog">
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
<div id="editModal" class="modal fade" role="dialog">
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