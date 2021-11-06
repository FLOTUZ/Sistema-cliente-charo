<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/jquery.dataTables.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/vendor/DataTables/Buttons-1.5.4/js/dataTables.buttons.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/Buttons-1.5.4/js/buttons.html5.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/JSZip-2.5.0/jszip.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
 -->
 <script src="<?php echo base_url(); ?>assets/vendor/DataTables/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        if(<?=$this->session->Charo2019['tipo_usuario']?>!=3)
            $('#usuario').attr('disabled','true');
        var data= null;
        $.ajax({
            type: "POST",
            data: {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
            },
            url: "<?=base_url()?>Administracion/getUnidades",
            success: function(result){           
                if(result!=0){               
                  data = JSON.parse(result);
                }
                tablaUnidades(data);
            }
        });

        var data2= null;
        $.ajax({
            type: "POST",
            data: {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
            },
            url: "<?=base_url()?>Administracion/getApoyos",
            success: function(result){           
                if(result!=0){               
                  data2 = JSON.parse(result);
                }
                tablaApoyos(data2);
            }
        });     

        $('#formUnidades').on('submit', function (e) {
            $('#cargador').show();
            $('#guardar').hide();
            var data = {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
                'unidad' : $('#nombreUnidad').val(),
                'id_unidad' : $('#id_unidad').val(),
            }
            $.ajax({
                url: '<?= base_url()?>Administracion/guardarUnidad',
                type: 'POST',
                data: data,
                success: function (xhr) {
                    if(xhr=="success"){
                        location.reload();
                   }else{
                        $('#cargador').hide();
                        $('#guardar').show();
                        $('#errorUnidad').text(xhr);
                   }
                }
            });
            return false;
        });

        $('#formApoyo').on('submit', function (e) {
            $('#cargadorA').show();
            $('#guardarA').hide();
            var data = {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
                'apoyo' : $('#nombreApoyo').val(),
                'id_unidad' : $('#id_unidadA').val(),
                'costo' : $('#costo').val(),
                'id_apoyo' : $('#id_apoyo').val(),
                'descripcion' : $('#descripcion').val()
            }
            $.ajax({
                url: '<?= base_url()?>Administracion/guardarApoyo',
                type: 'POST',
                data: data,
                success: function (xhr) {
                    if(xhr=="success"){
                        location.reload();
                   }else{
                        $('#cargadorA').hide();
                        $('#guardarA').show();
                        $('#errorApoyo').text(xhr);
                   }
                }
            });
            return false;
        });                 
    });


    function tablaUnidades(data){
        var table = $('#tUnidades').DataTable({
            responsive: true,/*
            dom: 'lBfrtip',
            buttons: [
                { extend: 'excel', className: 'btn-sm' },
                { extend: 'pdf', className: 'btn-sm' },
            ],*/
            iDisplayLength: -1,                        
            'data' : data,
            "columns": [
                { "data": "unidad" },
                { "data": "accion" }
            ],
            "language": {
                "sProcessing": "Procesando..."
            },
            pageLength: 50
        });

        $('#tUnidades_filter').append('<a href="javascript:;" class="btn btn-sm btn-success agregar" style="float: right; margin-left: 10px;" onclick="nuevaUnidad()">Nueva <i class="fa fa-plus-square"></i></a>');
    }

    function tablaApoyos(data){
        var table = $('#tApoyos').DataTable({
            responsive: true,/*
            dom: 'lBfrtip',
            buttons: [
                { extend: 'excel', className: 'btn-sm' },
                { extend: 'pdf', className: 'btn-sm' },
            ],*/
            iDisplayLength: -1,                        
            'data' : data,
            "columns": [
                { "data": "apoyo" },
                { "data": "unidad"},
                { "data": "costo"},
                { "data": "accion" }
            ],
            "language": {
                "sProcessing": "Procesando..."
            },
            pageLength: 50
        });
        $('#tApoyos_filter').append('<a href="javascript:;" class="btn btn-sm btn-success agregar" style="float: right; margin-left: 10px;" onclick="nuevoApoyo()">Nuevo <i class="fa fa-plus-square"></i></a>');
    }

    function nuevaUnidad(){
        $('#formUnidad').trigger('reset');
        $('#errorUnidad').text('');
        $('#id_unidad').val(0);
        $('.parsley-required').text('');
        $('.parsley-error').removeClass('parsley-error');
        $('.parsley-success').removeClass('parsley-success');
        $('#mUnidades').modal('toggle');
    }

    function nuevoApoyo(){
        $('#formApoyo').trigger('reset');
        $('#errorApoyo').text('');
        $('#id_apoyo').val(0);
        $('.parsley-required').text('');
        $('.parsley-error').removeClass('parsley-error');
        $('.parsley-success').removeClass('parsley-success');
        $('#mApoyos').modal('toggle');
    }

    function editarUnidad(id_unidad){
        var data = { 
            'id_unidad' : id_unidad,
            '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>' 
        };
        $.ajax({
            url: '<?=base_url()?>Administracion/dataUnidad',
            type: 'POST',
            data: data,
            success: function (xhr){
                if(xhr){
                    nuevaUnidad();
                    var data = JSON.parse(xhr);
                    $('#id_unidad').val(id_unidad);
                    $('#nombreUnidad').val(data.unidad);            
                }else{

                }
                $('#mUnidad').modal('toggle');
            }
        });
    }

    function editarApoyo(id_apoyo){
        var data = { 
            'id_apoyo' : id_apoyo,
            '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>' 
        };
        $.ajax({
            url: '<?=base_url()?>Administracion/dataApoyo',
            type: 'POST',
            data: data,
            success: function (xhr){
                if(xhr){
                    nuevoApoyo();
                    var data = JSON.parse(xhr);
                    $('#id_apoyo').val(id_apoyo);
                    $('#nombreApoyo').val(data.apoyo);
                    $('#id_unidadA').val(data.id_unidad);   
                    $('#costo').val(data.costo);  
                    $('#descripcion').val(data.descripcion);         
                }else{

                }
                $('#mApoyos').modal('toggle');
            }
        });
    }
  
</script>