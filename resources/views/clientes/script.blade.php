<!-- Delay table load until everything else is loaded -->
<script>
    $(window).load(function(){
        $('#consultaTable').removeAttr('style');
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
        $('#addModal').modal('show');
    });
    $('.modal-footer').on('click', '.add', function() {
        $.ajax({
            type: 'POST',
            url: "clientes/",
            data: {
                '_token': $('input[name=_token]').val(),
                'full_name': $('#full_name_add').val(),
                'peso_inicial': $('#peso_inicial_add').val(),
                'peso_saludable': $('#peso_saludable_add').val(),
                'altura': $('#altura_add').val(),
                'f_nacimiento': $('#f_nacimiento_add').val(),
                'telefono': $('#telefono_add').val(),
                'email': $('#email_add').val(),
                'anotaciones': $('#anotaciones_add').val()
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
                        $('#addModal').modal('show');
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
                    toastr.success('Cliente Añadido con Exito!', 'Success Alert', {timeOut: 5000});                             
                    location.reload();                                
                }
            },
            error:function(){ 
                alert("ERROR !!! Valores duplicados en el sistema, el teléfono y el email son únicos.");
            
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
        $('#showModal').modal('show');
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
        $('#editModal').modal('show');
    });
    id = $("#id_edit").val();
    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'PUT',
            url: '/clientes/' + id,
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
                        $('#editModal').modal('show');
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
                location.reload();                              
                toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
                //$('.item' + data['id']).remove();
            }
        });
    });
</script>