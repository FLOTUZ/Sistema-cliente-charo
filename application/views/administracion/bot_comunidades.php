<script src="<?php echo base_url(); ?>assets/vendor/DataTables/datatables.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/vendor/DataTables/Buttons-1.5.4/js/dataTables.buttons.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/Buttons-1.5.4/js/buttons.html5.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/JSZip-2.5.0/jszip.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
 -->
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        var data= null;
        $.ajax({
            type: "POST",
            data: {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
            },
            url: "<?=base_url()?>Administracion/getSecciones",
            success: function(result){           
                if(result!=0){               
                  data = JSON.parse(result);
                }
                tablaSecciones(data);
            }
        });

        var data2= null;
        $.ajax({
            type: "POST",
            data: {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
            },
            url: "<?=base_url()?>Administracion/getComunidades",
            success: function(result){           
                if(result!=0){               
                  data2 = JSON.parse(result);
                }
                tablaComunidades(data2);
            }
        });     

        $('#formSeccion').on('submit', function (e) {
            $('#cargador').show();
            $('#guardar').hide();
            var data = {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
                'seccion' : $('#nombreSeccion').val(),
                'id_seccion' : $('#id_seccion').val(),
                'id_comunidad' : $('#comunidadPertenece').val()
            }
            $.ajax({
                url: '<?= base_url()?>Administracion/guardarSeccion',
                type: 'POST',
                data: data,
                success: function (xhr) {
                    if(xhr=="success"){
                        location.reload();
                    }else{
                        $('#cargador').hide();
                        $('#guardar').show();
                        $('#errorSeccion').text(xhr);
                    }
                }
            });
            return false;
        });

        $('#formComunidad').on('submit', function (e) {
            $('#cargadorA').show();
            $('#guardarA').hide();
            var data = {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
                'comunidad' : $('#nombreComunidad').val(),
                'id_comunidad' : $('#id_comunidad').val(),
            }
            $.ajax({
                url: '<?= base_url()?>Administracion/guardarComunidad',
                type: 'POST',
                data: data,
                success: function (xhr) {
                    if(xhr=="success"){
                        location.reload();
                   }else{
                        $('#cargadorA').hide();
                        $('#guardarA').show();
                        $('#errorComunidad').text(xhr);
                    }
                }
            });
            return false;
        });                 
    });


    function tablaSecciones(data){
        var table = $('#tSecciones').DataTable({
            responsive: true,/*
            dom: 'lBfrtip',
            buttons: [
                { extend: 'excel', className: 'btn-sm' },
                { extend: 'pdf', className: 'btn-sm' },
            ],*/
            iDisplayLength: -1,                        
            'data' : data,
            "columns": [
                { "data": "seccion" },
                { "data": "comunidad" },
                { "data": "accion" }
            ],
            "language": {
                "sProcessing": "Procesando..."
            },
            pageLength: 50
        });

        $('#tSecciones_filter').append('<a href="javascript:;" class="btn btn-sm btn-success agregar" style="float: right; margin-left: 10px;" onclick="nuevaSeccion()">Nueva <i class="fa fa-plus-square"></i></a>');
    }

    function tablaComunidades(data){
        var table = $('#tComunidades').DataTable({
            responsive: true,/*
            dom: 'lBfrtip',
            buttons: [
                { extend: 'excel', className: 'btn-sm' },
                { extend: 'pdf', className: 'btn-sm' },
            ],*/
            iDisplayLength: -1,                        
            'data' : data,
            "columns": [
                { "data": "comunidad" },
                { "data": "accion" }
            ],
            "language": {
                "sProcessing": "Procesando..."
            },
            pageLength: 50
        });
        $('#tComunidades_filter').append('<a href="javascript:;" class="btn btn-sm btn-success agregar" style="float: right; margin-left: 10px;" onclick="nuevaComunidad()">Nueva <i class="fa fa-plus-square"></i></a>');
    }

    function nuevaSeccion(){
        $('#formSeccion').trigger('reset');
        $('#errorSeccion').text('');
        $('#id_seccion').val(0);
        $('.parsley-required').text('');
        $('.parsley-error').removeClass('parsley-error');
        $('.parsley-success').removeClass('parsley-success');
        $('#mSeccion').modal('toggle');
    }

    function nuevaComunidad(){
        $('#formComunidad').trigger('reset');
        $('#errorComunidad').text('');
        $('#id_comunidad').val(0);
        $('.parsley-required').text('');
        $('.parsley-error').removeClass('parsley-error');
        $('.parsley-success').removeClass('parsley-success');
        $('#mComunidad').modal('toggle');
    }

    function editarSeccion(id_seccion){
        var data = { 
            'id_seccion' : id_seccion,
            '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>' 
        };
        $.ajax({
            url: '<?=base_url()?>Administracion/dataSeccion',
            type: 'POST',
            data: data,
            success: function (xhr){
                if(xhr){
                    nuevaSeccion();
                    var data = JSON.parse(xhr);
                    $('#id_seccion').val(id_seccion);
                    $('#nombreSeccion').val(data.seccion);
                    $('#comunidadPertenece').val(data.id_comunidad);           
                }else{

                }
                $('#mSeccion').modal('toggle');
            }
        });
    }

    function editarComunidad(id_comunidad){
        var data = { 
            'id_comunidad' : id_comunidad,
            '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>' 
        };
        $.ajax({
            url: '<?=base_url()?>Administracion/dataComunidad',
            type: 'POST',
            data: data,
            success: function (xhr){
                if(xhr){
                    nuevaComunidad();
                    var data = JSON.parse(xhr);
                    $('#id_comunidad').val(id_comunidad);
                    $('#nombreComunidad').val(data.comunidad);             
                }else{

                }
                $('#mComunidad').modal('toggle');
            }
        });
    }
  
</script>