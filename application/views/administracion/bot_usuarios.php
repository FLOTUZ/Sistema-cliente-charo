<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/jquery.dataTables.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/vendor/DataTables/Buttons-1.5.4/js/dataTables.buttons.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/Buttons-1.5.4/js/buttons.html5.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/JSZip-2.5.0/jszip.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script> -->
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        var data= null;
        $.ajax({
            type: "POST",
            data: {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
            },
            url: "<?=base_url()?>Usuarios/getListado",
            success: function(result){           
                if(result!=0){               
                  data = JSON.parse(result);
                }
                tabla(data);
            }
        });

        $('#form').on('submit', function (e) {
            $('#cargador').show();
            $('#guardar').hide();
            var data = {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
                'usuario' : $('#usuario').val(),
                'id_usuario' : $('#id_usuario').val(),
            }
            $.ajax({
                url: '<?= base_url()?>Usuarios/ifExisUser',
                type: 'POST',
                data: data,
                success: function (xhr) {
                    if(xhr=="false"){
                        if($('#id_usuario').val()==0)
                            addUser();
                        else
                            updateUser();
                    }else{
                        $('#error').append('<ul class="parsley-errors-list filled" id="parsley-id-7"><li class="parsley-required">El usuario ya existe.</li></ul>');
                        $('#cargador').hide();
                        $('#guardar').show();
                   }
                }
            });
            return false;
        });
    });


    function tabla(data){
        var table = $('#listado').DataTable({
            responsive: true,/*
            dom: 'lBfrtip',
            buttons: [
                { extend: 'excel', className: 'btn-sm' },
                { extend: 'pdf', className: 'btn-sm' },
            ],*/
            iDisplayLength: -1,                        
            'data' : data,
            "columns": [
                { "data": "usuario" },
                { "data": "nombre" },
                { "data": "tipo" },
                { "data": "ultimo_ingreso" },
                { "data": "accion" }
            ],
            "language": {
                "sProcessing": "Procesando..."
            },
            pageLength: 50
        });

        $('#listado_filter').append('<a href="#" class="btn btn-sm btn-success agregar" style="float: right; margin-left: 10px;" onclick="nuevo()">Nuevo <i class="fa fa-user"></i></a>');
    }

    function nuevo(){
        $('#form').trigger('reset');
        $('#id_usuario').val(0);
        $('.parsley-required').text('');
        $('.parsley-error').removeClass('parsley-error');
        $('.parsley-success').removeClass('parsley-success');
        $('#nuevoUsuario').modal('toggle');
    }

    function addUser(){
        var autoriza = 0;
        if($('#autoriza').prop('checked'))
            autoriza = 1;
       var data = {
            'nombre' : $('#nombre').val(),
            'usuario' : $('#usuario').val(),
            'password' : $('#password').val(),
            'area' : $('#id_area').val(),
            'tipo_usuario' : $('#tipo_usuario').val(),
            'autoriza' : autoriza,
            '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>'
       };
        $.ajax({
            url: '<?=base_url()?>Usuarios/addUser',
            type: 'POST',
            data: data,
            success: function (xhr){
                if(xhr=='success'){
                    location.reload();
                }else{
                   $('#error').append('<p class="text-danger">Error al agregar usuario, consulte con el adminitrador.</p>');
                }
                $('#cargador').hide();
                $('#guardar').show();
            }
        });
    }  

    function editar(id_usuario){
        var data = { 
            'id_usuario' : id_usuario,
            '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>' 
        };
        $.ajax({
            url: '<?=base_url()?>Usuarios/dataUsuario',
            type: 'POST',
            data: data,
            success: function (xhr){
                if(xhr){
                    nuevo();
                    var data = JSON.parse(xhr);
                    $('#id_usuario').val(id_usuario);
                    $('#usuario').val(data.usuario);
                    $('#password').val(data.password);
                    $('#nombre').val(data.nombre);
                    $('#tipo_usuario').val(data.id_tipo_usuario);                
                    $('#nuevoUsuario').modal('toggle');                 
                }else{

                }
            }
        });
    }

    function updateUser(){
        var autoriza = 0;
        if($('#autoriza').prop('checked'))
            autoriza = 1;
        var data = {
            'id_usuario' : $('#id_usuario').val(),
            'nombre' : $('#nombre').val(),
            'usuario' : $('#usuario').val(),
            'password' : $('#password').val(),
            'area' : $('#id_area').val(),
            'tipo_usuario' : $('#tipo_usuario').val(),
            'autoriza' : autoriza,
            '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>'
        };
        $.ajax({
            url: '<?=base_url()?>Usuarios/updateUser',
            type: 'POST',
            data: data,
            success: function (xhr){
                if(xhr=='success'){
                    $('#cargador').hide();
                    $('#guardar').show();
                    location.reload();
                }else{

                }
            }
        });
    }
  
</script>