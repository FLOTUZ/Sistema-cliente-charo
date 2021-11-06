<script>
    function cambiarPass(){
        if($('#password').val()!=''){
            var data = {
                'id_usuario' : <?=$informacion->id_usuario?>,
                'password' : $('#password').val(),
                '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>' 
            }
            $.ajax({
                url: '<?=base_url()?>Usuarios/cambiarPass',
                type: 'POST',
                data: data,
                success: function(xhr){
                    if(xhr=="success"){
                         $('#resultado').html('<p class="text-success">Contraseña actualizada correctamente.</p>')
                         $('#passActual').text($('#password').val());
                    }else{
                        $('#resultado').html('<p class="text-danger">Error al actualizadar.</p>')
                    }
                }
            })
        }else{
            $('#resultado').html('<p class="text-danger">Ingresa una contraseña valida.</p>')
        }
    }
  
</script>