<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        var data= null;
        $.ajax({
            type: "POST",
            data: {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
            },
            url: "<?=base_url()?>Administracion/getBeneficiarios",
            success: function(result){           
                if(result!=0){               
                  data = JSON.parse(result);
                }
                tablaBeneficiarios(data);
            }
        });
    });


    function tablaBeneficiarios(data){
        var table = $('#tBeneficiarios').DataTable({
            responsive: true,
            <?php if($this->session->Charo2019['tipo_usuario']==3){?>
            dom: 'lBfrtip',
            buttons: [
                { extend: 'excel', className: 'btn-sm' },
                { extend: 'pdf', className: 'btn-sm' },
            ],
            <?php } ?>
            iDisplayLength: -1, 
            "order": [[ 1, "asc" ]],                       
            'data' : data,
            "columns": [
                { "data": "id_beneficiario" },
                { "data": "nombre" },
                { "data": "seccion" },
                { "data": "comunidad" },
                { "data": "direccion" },
                { "data": "telefono" },
                { "data": "accion" }
            ],
            "language": {
                "sProcessing": "Procesando..."
            },
            pageLength: 50
        });
    }

</script>