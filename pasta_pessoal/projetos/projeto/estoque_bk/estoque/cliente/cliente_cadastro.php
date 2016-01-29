<div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	       
	        
	      </div>
	      <div class="modal-body">
	      	
			<form role="form" method="post"  id="formulario_cliente" data-toggle="validator" >
			  <div class="form-group">
			    <label for="nome">Nome</label>
			    <input type="text" class="form-control" id="nome" name="nome">
			  </div>
			  <div class="form-group">
			    <label for="email">E-mail</label>
			    <input type="email" class="form-control" id="email" name="email">
			  </div>
			  <div class="form-group">
			    <label for="fone">Telefone</label>
			    <input type="fone" class="form-control" id="fone" name="fone">
				
			  </div>
			  
			  
	
			  <button id="btn_gravar" type="submit" class="btn btn-primary" >Salvar</button>
			  <input type="hidden" name="id_cliente" id="id_cliente" value="" />
			</form>	    
			    
	      </div>
	      <div class="modal-footer">
	       
	        
			<!-- onclick="alterar_dados_salva('cliente')"-->
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	  
	  
	  
<script>

$(document).ready(function() {
	
	
	
	$('#formulario_cliente')
        .find('[name="fone"]')
            .intlTelInput({
                utilsScript: 'dist/js/utils.js',
                autoPlaceholder: true,
                preferredCountries: ['br']
            });
    

    $('#formulario_cliente').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nome: {
                validators: {
                    notEmpty: {
                        message: 'Nome é obrigatório'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email inválido'
                    },
                    emailAddress: {
                        message: 'Email inválido'
                    }
                }
            },
                fone: {
                    validators: {
                        callback: {
                            message: 'Telefone inválido',
                            callback: function(value, validator, $field) {
                                return value === '' || $field.intlTelInput('isValidNumber');
                            }
                        },
						notEmpty: {
							message: 'Telefone é obrigatório '
						}
                    }
                }
            
        
			
			
			
			
			
			
			
        }
    }).on('success.form.fv', function(e) {
		
		e.preventDefault();
		alterar_dados_salva('cliente');
		
		 //return("dados gravados com sucesso");
				//	alterar_dados_salva('cliente');
                   
        });;
});
</script>

