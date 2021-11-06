<script src="<?=base_url()?>assets/vendor/select2/js/select2.full.js"></script>
<script>
    $(document).ready(function() {
       $("#persona").select2();
    });

    function asignar(){
	    $('#nuevoBeneficiario').modal('show');
	    $('#id_beneficiario').val($('#persona').val());
	    var data = { 
	      'id_beneficiario_origen' : <?=$beneficiario->id_beneficiario?>,
	      'id_beneficiario_destino' : $('#persona').val(),
	      '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>' 
	    };
	    $.ajax({
	        url: '<?=base_url()?>Administracion/asignarApoyos',
	        type: 'POST',
	        data: data,
	        success: function (xhr){
	            if(xhr=='success'){
	            	location.reload();
	            }else{
	            	$('#error').html('Ocurrio un error al asignar los apoyos.');
	            }
	        }
	    });
    }

    function eliminar(){
      var data = {
          "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
          'id_beneficiario' : <?=$beneficiario->id_beneficiario?>
      }
      $.ajax({
        url: '<?= base_url()?>Administracion/eliminarBeneficiario',
        type: 'POST',
        data: data,
        success: function (xhr) {
            if(xhr="success"){
              window.location.href = "<?=base_url()?>Administracion/beneficiarios";
            }else{
              $('#error').prepend('Errror al eliminar beneficiario.');
            }
        }
      });  
    }
</script>