  <script src="<?=base_url()?>assets/vendor/select2/js/select2.full.js"></script>
  <script>
        $(document).ready(function() { 
          $("#apoyo").select2(); 
          $("#apoyo").val(<?=$solicitud->id_apoyo?>).trigger("change");
          $('#nuevaSolicitud').on('submit', function (e) {
          $('#cargadorS').show();
          $('#guardarS').hide();
          $('#resultado').text('');
            var data = {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
                'id_apoyo' : $('#apoyo').val(),
                'cantidad' : $('#cantidad').val(),
                'id_beneficiario' : <?=$solicitud->id_beneficiario?>,
                'fecha' : $('#fecha').val(),
                'id_solicitud' : <?=$solicitud->id_solicitud?>
            }
            $.ajax({
              url: '<?= base_url()?>Apoyos/editarSolicitud',
              type: 'POST',
              data: data,
              success: function (xhr) {
                  if(xhr="success"){
                    $('#resultado').prepend('<label class="text-success">Guardado correctamente.</label>');
                  }else{
                    $('#resultado').prepend('<label class="text-danger">Error al guardar, consulte con el administrador.</label>');
                  }
                  $('#cargadorS').hide();
                  $('#guardarS').show();
              }
            });  
            return false;
          });

        });

        function eliminar(){
          var data = {
              "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
              'id_solicitud' : <?=$solicitud->id_solicitud?>
          }
          $.ajax({
            url: '<?= base_url()?>Apoyos/eliminarSolicitud',
            type: 'POST',
            data: data,
            success: function (xhr) {
                if(xhr="success"){
                  $('#resultadoEliminar').prepend('<label class="text-success">Eliminado correctamente.</label>');
                  $('.eliminado').hide('slow');
                }else{
                  $('#resultadoEliminar').prepend('<label class="text-danger">Error al eliminar, consulte con el administrador.</label>');
                }
            }
          });  
        }
    </script>
</body>

</html>