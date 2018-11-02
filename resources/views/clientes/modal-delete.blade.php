<!-- Modal form to delete a form -->
<div id="delete-modal" class="modal fade" role="dialog">
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