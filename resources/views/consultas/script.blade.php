<!-- Delay table load until everything else is loaded -->
<script>
    $(window).load(function(){
        $('#consultaTable').removeAttr('style');
    })
</script>

<script>
    $(document).ready(function(){        
        // Page-Level Demo Scripts - Notifications - Use for reference 
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>

<!-- AJAX CRUD operations -->
<script type="text/javascript">
    // add a new cliente
    $(document).on('click', '.add-ConsultaModal', function() {
        $('.modal-title').text('Anotar Consulta');
        $('#addConsultaModal').modal('show');
    });
    $('.modal-footer').on('click', '.addConsulta', function() {
        $.ajax({
            type: 'POST',
            url: "consultas/",
            data: {
                '_token': $('input[name=_token]').val(),  
                'id_cliente': $('#id_cliente_add').val(),               
                'peso': $('#peso_add').val(),                               
                'comentario': $('#comentario_add').val(),
            },
            success: function(data) {
                $('.errorId_cliente').addClass('hidden');
                $('.errorPeso').addClass('hidden');
                $('.errorAnotaciones').addClass('hidden');

                if ((data.errors)) {
                    setTimeout(function () {
                        $('#addConsultaModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                    }, 500);

                    if (data.errors.full_name) {
                        $('.errorId_cliente').removeClass('hidden');
                        $('.errorId_cliente').text(data.errors.id_cliente);
                    }
                    if (data.errors.peso) {
                        $('.errorPeso').removeClass('hidden');
                        $('.errorPeso').text(data.errors.peso);
                    }
                    if (data.errors.anotaciones) {
                        $('.errorComentario').removeClass('hidden');
                        $('.errorComentario').text(data.errors.comentario);
                    }
                } else {   
                    toastr.success('Successfully added Client!', 'Success Alert', {timeOut: 5000});                             
                    location.reload();                                
                }
            },
            error:function(){ 
                alert("error!!!!");
            }
        });
    });

    // Show a post
    $(document).on('click', '.show-modal', function() {
        $('.modal-title').text('Detalles del Cliente Nº '+$(this).data('id'));
        $('#full_name_show').val($(this).data('full_name'));
        $('#peso_show').val($(this).data('peso'));
        $('#f_nacimiento_show').val($(this).data('f_nacimiento'));
        $('#telefono_show').val($(this).data('telefono'));
        $('#email_show').val($(this).data('email'));
        $('#anotaciones_show').val($(this).data('anotaciones'));
        $('#showConsultaModal').modal('show');
    });


    // Edit a post
    $(document).on('click', '.edit-modal', function() {
        id = $(this).data('id');
        $('.modal-title').text('Editar Información del Cliente Nº '+id);
        $('#id_edit').val(id);
        $('#full_name_edit').val($(this).data('full_name'));
        $('#peso_edit').val($(this).data('peso'));
        $('#f_nacimiento_edit').val($(this).data('f_nacimiento'));
        $('#telefono_edit').val($(this).data('telefono'));
        $('#email_edit').val($(this).data('email'));
        $('#anotaciones_edit').val($(this).data('anotaciones'));
        $('#editConsultaModal').modal('show');
    });
    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'PUT',
            url: 'clientes/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#id_edit").val(),
                'full_name': $('#full_name_edit').val(),
                'peso': $('#peso_edit').val(),
                'f_nacimiento': $('#f_nacimiento_edit').val(),
                'telefono': $('#telefono_edit').val(),
                'email': $('#email_edit').val(),
                'anotaciones': $('#anotaciones_edit').val()
            },
            success: function(data) {
                $('.errorFull_name').addClass('hidden');
                $('.errorPeso').addClass('hidden');
                $('.errorF_nacimiento').addClass('hidden');
                $('.errorTelefono').addClass('hidden');
                $('.errorEmail').addClass('hidden');
                $('.errorAnotaciones').addClass('hidden');

                if ((data.errors)) {
                    setTimeout(function () {
                        $('#editConsultaModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                    }, 500);

                    if (data.errors.full_name) {
                        $('.errorFull_name').removeClass('hidden');
                        $('.errorFull_name').text(data.errors.full_name);
                    }
                    if (data.errors.peso) {
                        $('.errorPeso').removeClass('hidden');
                        $('.errorPeso').text(data.errors.peso);
                    }
                    if (data.errors.f_nacimiento) {
                        $('.errorF_nacimiento').removeClass('hidden');
                        $('.errorF_nacimiento').text(data.errors.f_nacimiento);
                    }
                    if (data.errors.telefono) {
                        $('.errorTelefono').removeClass('hidden');
                        $('.errorTelefono').text(data.errors.telefono);
                    }
                    if (data.errors.email) {
                        $('.errorEmail').removeClass('hidden');
                        $('.errorEmail').text(data.errors.email);
                    }
                    if (data.errors.anotaciones) {
                        $('.errorAnotaciones').removeClass('hidden');
                        $('.errorAnotaciones').text(data.errors.anotaciones);
                    }
                } else {
                    location.reload();
                    toastr.success('Successfully updated Post!', 'Success Alert', {timeOut: 5000});
                }
            }
        });
    });

    // delete a post
    $(document).on('click', '.delete-modal', function() {
        id = $(this).data('id');
        $('.modal-title').text('Borrar Ficha de Cliente Nº '+id);     
        $('#id_delete').val(id);
        $('#full_name_delete').val($(this).data('full_name'));
        $('#deleteModal').modal('show');
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'DELETE',
            url: 'clientes/'+ id,
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#id_delete").val(),
            },
            success: function(data) {                               
                toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
                $('.item' + data['id']).remove();
            }
        });
    });
</script>