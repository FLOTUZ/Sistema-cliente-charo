<script type="text/javascript">
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)==false) {
	   $("body").toggleClass("sidenav-toggled");
	}
    function consultar(){
        $("#listadoLoad").html('<img  src="<?=base_url()?>assets/img/cargador.gif" class="img-fluid" alt="Responsive image"><p class="text-muted">Cargando...</p>');
        $("#listadoLoad").load("<?= base_url();?>Apoyos/loadListado/?estatus="+$('#estatus').val()+"&fecha_inicio="+$('#fecha_inicio').val()+"&fecha_final="+$('#fecha_fin').val());
    }
</script>
</body>

</html>