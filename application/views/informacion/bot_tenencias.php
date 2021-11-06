<script src="<?=base_url()?>assets/vendor/select2/js/select2.full.js"></script>
<script>
    $(document).ready(function() { 
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)==false) {
           $("body").toggleClass("sidenav-toggled");
        }
        $(".multiple").select2();
        <?php if($secciones->num_rows()>0){ ?>
          $('.comunidad<?=$comunidades->row(0)->id_comunidad?>').show();
        <?php } ?>
    });

    function consultar(){
        $("#listadoLoad").html('<img  src="<?=base_url()?>assets/img/cargador.gif" class="img-fluid" alt="Responsive image"><p class="text-muted">Cargando...</p>');
        $("#listadoLoad").load("<?= base_url();?>Informacion/loadTenencias/?seccion="+$('#seccion').val()+"&fecha_inicio="+$('#fecha_inicio').val()+"&fecha_final="+$('#fecha_fin').val()+"&comunidad="+$('#comunidad').val());
    }

    $("#comunidad").change(function() {
      var valor = $('#comunidad').val();
      $('.seccion').hide();
      $('.comunidad'+valor).show();
      $('#seccion').val($('.comunidad'+valor+':first').val());
    });
</script>
</body>

</html>