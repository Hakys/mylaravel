<!-- Modal form to show a post -->
<div id="show-modal" class="modal fade" role="dialog">
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