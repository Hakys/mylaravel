<!-- Delay table load until everything else is loaded -->
<script>
    $(window).load(function(){
        $('#clienteTable').removeAttr('style');
    })
</script>

<script>
    $(document).ready(function(){
        $('.activado').iCheck({
            checkboxClass: 'icheckbox_square-yellow',
            radioClass: 'iradio_square-yellow',
            increaseArea: '20%'
        });
        $('.activado').on('ifClicked', function(event){
            id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: "{{ URL::route('changeStatus') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id
                },
                success: function(data) {
                    //
                },
            });
        });
        $('.activado').on('ifToggled', function(event) {
            $(this).closest('tr').toggleClass('warning');
        });
        // Page-Level Demo Scripts - Notifications - Use for reference 
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>

<!-- AJAX CRUD operations -->
<script type="text/javascript">
    // add a new cliente
    $(document).on('click', '.add-modal', function() {
        $('.modal-title').text('Añadir Cliente');
        $('#add-modal').modal('show');
    });
    $('.modal-footer').on('click', '.add', function() {
        $.ajax({
            type: 'POST',
            url: "{{ URL::route('clientes.store') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                //'fecha': $('#fecha_add').val(),
                'full_name': $('#full_name_add').val(),
                'peso_inicial': $('#peso_inicial_add').val(),
                'peso_saludable': $('#peso_saludable_add').val(),
                'altura': $('#altura_add').val(),
                'f_nacimiento': $('#f_nacimiento_add').val(),
                'telefono': $('#telefono_add').val(),
                'email': $('#email_add').val(),
                'anotaciones': $('#anotaciones_add').val(),
            },
            success: function(data) {
                $('.errorFull_name').addClass('hidden');
                $('.errorPeso_inicial').addClass('hidden');
                $('.errorPeso_saludable').addClass('hidden');
                $('.errorAltura').addClass('hidden');
                $('.errorF_nacimiento').addClass('hidden');
                $('.errorTelefono').addClass('hidden');
                $('.errorEmail').addClass('hidden');
                $('.errorAnotaciones').addClass('hidden');

                if ((data.errors)) {
                    setTimeout(function () {
                        $('#add-modal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                    }, 500);

                    if (data.errors.full_name) {
                        $('.errorFull_name').removeClass('hidden');
                        $('.errorFull_name').text(data.errors.full_name);
                    }
                    if (data.errors.peso_inicial) {
                        $('.errorPeso_inicial').removeClass('hidden');
                        $('.errorPeso_inicial').text(data.errors.peso_inicial);
                    }
                    if (data.errors.peso_saludable) {
                        $('.errorPeso_saludable').removeClass('hidden');
                        $('.errorPeso_saludable').text(data.errors.peso_saludable);
                    }
                    if (data.errors.altura) {
                        $('.errorAltura').removeClass('hidden');
                        $('.errorAltura').text(data.errors.altura);
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
                    toastr.success('Cliente Añadido con Exito!', 'Success Alert', {timeOut: 5000});                                                            
                }
            }, 
            error :function(error){
                //location.reload();
                toastr.error('Agregation error! ('+eval(error.status)+')', 'Error Alert', {timeOut: 5000});
            },
        });
         
    });

    // Show a cliente
    $(document).on('click', '.show-modal', function() {
        $('.modal-title').text('Detalles del Cliente Nº '+$(this).data('id'));
        $('#full_name_show').val($(this).data('full_name'));
        $('#peso_inicial_show').val($(this).data('peso_inicial'));
        $('#peso_saludable_show').val($(this).data('peso_saludable'));
        $('#f_nacimiento_show').val($(this).data('f_nacimiento'));
        $('#altura_show').val($(this).data('altura'));
        $('#telefono_show').val($(this).data('telefono'));
        $('#email_show').val($(this).data('email'));
        $('#anotaciones_show').val($(this).data('anotaciones'));
        $('#show-modal').modal('show');
    });

    // Edit a cliente
    $(document).on('click', '.edit-modal', function() {
        id = $(this).data('id');
        nombre = $(this).data('full_name');
        $('.modal-title').text('Editar Información del Cliente (Nº '+id+') '+nombre);
        $('#id_edit').val(id);
        $('#full_name_edit').val(nombre);
        $('#peso_inicial_edit').val($(this).data('peso_inicial'));
        $('#peso_saludable_edit').val($(this).data('peso_saludable'));
        $('#f_nacimiento_edit').val($(this).data('f_nacimiento'));
        $('#altura_edit').val($(this).data('altura'));
        $('#telefono_edit').val($(this).data('telefono'));
        $('#email_edit').val($(this).data('email'));
        $('#anotaciones_edit').val($(this).data('anotaciones'));
        $('#edit-modal').modal('show');
    });
    id = $("#id_edit").val();
    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'PUT',
            url: 'clientes/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#id_edit").val(),
                'full_name': $('#full_name_edit').val(),
                'peso_inicial': $('#peso_inicial_edit').val(),
                'peso_saludable': $('#peso_saludable_edit').val(),
                'altura': $('#altura_edit').val(),
                'f_nacimiento': $('#f_nacimiento_edit').val(),
                'telefono': $('#telefono_edit').val(),
                'email': $('#email_edit').val(),
                'anotaciones': $('#anotaciones_edit').val()
            },
            success: function(data) {
                $('.errorFull_name').addClass('hidden');
                $('.errorPeso_inicial').addClass('hidden');
                $('.errorPeso_saludable').addClass('hidden');
                $('.errorAltura').addClass('hidden');
                $('.errorF_nacimiento').addClass('hidden');
                $('.errorTelefono').addClass('hidden');
                $('.errorEmail').addClass('hidden');
                $('.errorAnotaciones').addClass('hidden');

                if ((data.errors)) {
                    setTimeout(function () {
                        $('#edit-modal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                    }, 500);

                    if (data.errors.full_name) {
                        $('.errorFull_name').removeClass('hidden');
                        $('.errorFull_name').text(data.errors.full_name);
                    }
                    if (data.errors.peso_inicial) {
                        $('.errorPeso_inicial').removeClass('hidden');
                        $('.errorPeso_inicial').text(data.errors.peso_inicial);
                    }
                    if (data.errors.peso_saludable) {
                        $('.errorPeso_saludable').removeClass('hidden');
                        $('.errorPeso_saludable').text(data.errors.peso_saludable);
                    }
                    if (data.errors.altura) {
                        $('.errorAltura').removeClass('hidden');
                        $('.errorAltura').text(data.errors.altura);
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
                    toastr.success('Successfully updated Cliente!', 'Success Alert', {timeOut: 5000});
                }
            },
            error :function(error){
                location.reload();
                toastr.error('Edition error! ('+eval(error)+')', 'Error Alert', {timeOut: 5000});
            },
        });
    });
    /*
    error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        $('#post').html(msg);
    },
    */


    // delete a post
    $(document).on('click', '.delete-modal', function() {
        id = $(this).data('id');
        $('.modal-title').text('Borrar Ficha de Cliente Nº '+id);     
        $('#id_delete').val(id);
        $('#full_name_delete').val($(this).data('full_name'));
        $('#delete-modal').modal('show');
    });
    $('.modal-footer').on('click', '.delete', function() {
        if(confirm('¿Estas seguro de eliminar al cliente: '+$("#full_name_edit").val()+'?'))
            $.ajax({
                type: 'DELETE',
                url: 'clientes/'+ id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                },
                success: function(data) { 
                    location.reload();                              
                    toastr.success('Cliente Borrado con Éxito!', 'Success Alert', {timeOut: 5000});
                    //$('.item' + data['id']).remove();
                }
            });
    });
</script>