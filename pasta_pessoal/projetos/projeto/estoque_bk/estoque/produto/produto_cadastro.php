<div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	       
	        
	      </div>
	      <div class="modal-body">
	      	
			<form role="form" method="post"  id="formulario_produto" data-toggle="validator" >
			  <div class="form-group">
			    <label for="produto">Produto</label>
			    <input type="text" class="form-control" id="produto" name="produto">
			  </div>
			  <div class="form-group">
			    <label for="preco">Preço</label>
			    <input type="text" class="form-control" id="preco" name="preco">
			  </div>
			  <div class="form-group">
			    <label for="qtd">Quantidade</label>
			    <input type="text" class="form-control" id="qtd" name="qtd">
				
			  </div>
			  <div class="form-group">
			    <label for="desc">Descrição</label>
			    <textarea type="text" class="form-control" id="desc" name="desc"></textarea> 
				
			  </div>
		

			  
			  
	
			  <button id="btn_gravar" type="submit" class="btn btn-primary" >Salvar</button>
			  <input type="hidden" name="id_produto" id="id_produto" value="" />
			</form>	    
			    
	      </div>
	      <div class="modal-footer">
	       
	        
			<!-- onclick="alterar_dados_salva('produto')"-->
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	  
	  
	  
<script>

$(document).ready(function() {
	
    

    $('#formulario_produto').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            produto: {
                validators: {
                    notEmpty: {
                        message: 'Produto é obrigatório'
                    }
                }
            },
            preco: {
                validators: {
                    notEmpty: {
                        message: 'Preço é obrigatorio'
                    }
                }
            },
                qtd: {
                    validators: {
                       
						notEmpty: {
							message: 'Quantidade é obrigatório '
						}
                    }
                }
            
        
			
			
			
			
			
			
			
        }
    }).on('success.form.fv', function(e) {
		
		e.preventDefault();
		alterar_dados_salva('produto');
		
		 //return("dados gravados com sucesso");
				//	alterar_dados_salva('produto');
                   
        });;
});
</script>

