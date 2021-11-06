<script src="<?=base_url()?>assets/vendor/select2/js/select2.full.js"></script>
<script>
    $(document).ready(function() { 
    	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)==false) {
		   $("body").toggleClass("sidenav-toggled");
		}
    	$(".multiple").select2();
    });

    function consultar(){
        $("#listadoLoad").html('<img  src="<?=base_url()?>assets/img/cargador.gif" class="img-fluid" alt="Responsive image"><p class="text-muted">Cargando...</p>');
        $("#listadoLoad").load("<?= base_url();?>Informacion/loadApoyos/?apoyo="+$('#apoyo').val()+"&fecha_inicio="+$('#fecha_inicio').val()+"&fecha_final="+$('#fecha_fin').val());
    }
</script>
</body>

</html>