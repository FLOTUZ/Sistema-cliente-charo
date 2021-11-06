  <script src="<?=base_url()?>assets/vendor/select2/js/select2.full.js"></script>
  <script>
        $(document).ready(function() { 
          //$('#info').modal('show');
        	$("#persona").select2();
          $("#apoyo").select2(); 
          $("#unidad").select2(); 
          <?php if($secciones->num_rows()>0){ ?>
          $('.comunidad<?=$comunidades->row(0)->id_comunidad?>').show();
          <?php } ?>
          var valor = $('#apoyo').val();
          var autoriza = $('#apoyo'+valor).attr('autoriza');
          $('#FnuevoBeneficiario').on('submit', function (e) {
            $('.parsley-required').text('');
            $('#cargador').show();
            $('#guardar').hide();
            $('#error').text('');
            if($('#id_beneficiario').val()==0){
              var data = {
                  "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
                  'nombre' : $('#nombre').val(),
                  'paterno' : $('#apPaterno').val(),
                  'materno' : $('#apMaterno').val()
              }
              $.ajax({
                  url: '<?= base_url()?>Apoyos/ifExisBeneficiario',
                  type: 'POST',
                  data: data,
                  success: function (xhr) {
                      if(xhr==false){
                        agregar();
                      }else{
                          if(xhr=="error1"){
                            $('#error').append('Beneficiario ya existe.');
                          }
                          $('#cargador').hide();
                          $('#guardar').show();
                     }
                  }
              });
            }else{
              agregar();
            }
            return false;
          });

          $('#nuevaSolicitud').on('submit', function (e) {
            $('#cargadorS').show();
            $('#guardarS').hide();
            $('#resultado').text('');
            if($('#autorizado').prop('checked'))
              var autorizado = 1;
            else
              var autorizado = 0;
            if($('#entregado').prop('checked'))
              var entregado = 1;
            else
              var entregado = 0;
            if($('#persona').val()!=null){
              var data = {
                  "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
                  'id_apoyo' : $('#apoyo').val(),
                  'cantidad' : $('#cantidad').val(),
                  'id_beneficiario' : $('#persona').val(),
                  'fecha' : $('#fecha').val(),
                  'descuento' : $('#descuento').val(),
                  'total' : $('#total').val(),
                  'autorizado' : autorizado,
                  'entregado' : entregado,
                  'fecha_autorizado' : $('#fecha_autorizado').val(),
                  'fecha_entregado' : $('#fecha_entregado').val()
              }
              $.ajax({
                url: '<?= base_url()?>Apoyos/nuevaSolicitud',
                type: 'POST',
                data: data,
                success: function (xhr) {
                    if(xhr="success"){
                      $('#resultado').prepend('<label class="text-success">Guardado correctamente.</label>');
                      if($("#limpiar").is(':checked')) { 
                        $('#nuevaSolicitud')[0].reset();
                        value = $('#apoyo:first').val();
                        $("#apoyo").val(value).trigger("change");
                      }
                    }else{
                      $('#resultado').prepend('<label class="text-danger">Error al guardar, consulte con el administrador.</label>');
                    }
                    $('#cargadorS').hide();
                    $('#guardarS').show();
                }
              });  
            }else{
              $('#resultado').prepend('<label class="text-danger">Seleccione un beneficiario o registre uno nuevo.</label>');
              $('#cargadorS').hide();
              $('#guardarS').show();
            }
            return false;
          });

        });

        $("#comunidad").change(function() {
          var valor = $('#comunidad').val();
          $('.seccion').hide();
          $('.comunidad'+valor).show();
          $('#seccion').val($('.comunidad'+valor+':first').val());
        });

        $("#apoyo").change(function() {
          $('#autorizado').removeAttr('checked');
          var valor = $('#apoyo').val();
          var autoriza = $('#apoyo'+valor).attr('autoriza');
        });
        

        function nuevo(){
          $('#FnuevoBeneficiario').trigger('reset');
          $('#id_beneficiario').val(0);
          $('.parsley-required').text('');
          $('.parsley-error').removeClass('parsley-error');
          $('.parsley-success').removeClass('parsley-success');
          $('#error').text('');
        }

        function editar(){
          if($('#persona').val()!=null){
            nuevo();
            $('#nuevoBeneficiario').modal('show');
            $('#id_beneficiario').val($('#persona').val());
            var data = { 
              'id_beneficiario' : $('#persona').val(),
              '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>' 
            };
            $.ajax({
                url: '<?=base_url()?>Apoyos/dataBeneficiario',
                type: 'POST',
                data: data,
                success: function (xhr){
                    if(xhr){
                        var data = JSON.parse(xhr);
                        $('#nombre').val(data.nombre);
                        $('#apPaterno').val(data.apPaterno);
                        $('#apMaterno').val(data.apMaterno);
                        var valor = data.id_tenencia;
                        $('.comunidad').hide();
                        $('.tenencia'+valor).show();
                        $('#comunidad').val(data.id_comunidad);
                        $('#direccion').val(data.direccion);
                        $('#numero').val(data.numero);
                        $('#telefono').val(data.telefono);
                    }else{

                    }
                }
            });
          }else{
            alert('No ha seleccionado un beneficiario.');
          }
        }

        function agregar(){
          var data =  $('#FnuevoBeneficiario').serialize();
          $.ajax({
            url: '<?= base_url()?>Apoyos/saveBeneficiario',
            type: 'POST',
            data: data,
            success: function (xhr) {
                if(isNaN(xhr)){
                  $('#error').append('<p class="text-danger">Error al guardar.</p>');
                }else{
                  if($('#id_beneficiario').val()==0){
                    var nombre = $('#nombre').val()+' '+$('#apPaterno').val()+' '+$('#apMaterno').val();
                    var newOption = new Option(nombre, xhr, false, false);
                    $('#persona').append(newOption).trigger('change');
                    $('#persona').val(xhr);
                  }
                  $('#nuevoBeneficiario').modal('hide');
                }
                $('#cargador').hide();
                $('#guardar').show();
            }
          });  
        }

        function ultimosApoyos(){
          $id_beneficiario = $('#persona').val();
          if($id_beneficiario>0){
            $("#registros").load("<?= base_url();?>Apoyos/ultimosCinco/"+$id_beneficiario);
            $('#ultimosRegistros').modal('show');
          }else{
            alert('No ha seleccionado un beneficiario.');
          }
        }

        $('.autorizado').click(function(){
          if($('#autorizado').prop('checked')==false)
            $('#entregado').removeAttr('checked');
        });

        $(".costo").keyup(function() {
          valor = $('#apoyo').val();
          costo = $('#apoyo'+valor).attr('costo');
          total = costo*$('#cantidad').val()-$('#descuento').val();
          $('#total').val(total);
        });

        $("#apoyo").change(function() {
          valor = $('#apoyo').val();
          costo = $('#apoyo'+valor).attr('costo');
          total = costo*$('#cantidad').val()-$('#descuento').val();
          $('#total').val(total);
        });
    </script>
</body>

</html>