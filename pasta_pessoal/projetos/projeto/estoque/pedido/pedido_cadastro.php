<div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	       
	        
	      </div>
	      <div class="modal-body">
	      	
			<form role="form" method="post"  id="formulario_pedido" data-toggle="validator" >
			  <div class="form-group">
			    <label for="cliente">Cliente</label>
			    <input type="text" class="form-control" id="cliente" name="cliente">
			  </div>

			  <div class="form-group">
			    <label for="produto">Produto</label>
			    <input type="text" class="form-control" id="produto" name="produto">
			  </div>
			  <div class="form-group">
			    <label for="qtd">Quantidade</label>
			    <input type="text" class="form-control" id="qtd" name="qtd">
				
			  </div>

			  
			  <button id="btn_gravar" type="submit" class="btn btn-primary" >Salvar</button>
			  <input type="hidden" name="id_pedido" id="id_pedido" value="" />
			</form>	    
			    
	      </div>
	      <div class="modal-footer">
	       
	        
			<!-- onclick="alterar_dados_salva('pedido')"-->
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	  

<script>

$(document).ready(function() {
	
    

    $('#formulario_pedido').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            cliente: {
                validators: {
                    notEmpty: {
                        message: 'Cliente é obrigatório'
                    }
                }
            },
            produto: {
                validators: {
                    notEmpty: {
                        message: 'Produto é obrigatorio'
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
		alterar_dados_salva('pedido');
		
		 //return("dados gravados com sucesso");
				//	alterar_dados_salva('pedido');
                   
        });;
});




var productNames = new Array();
var productIds = new Object();
$.getJSON( 'produto/produto_json.php', null,
function ( jsonData )
{
	$.each( jsonData, function ( index, product )
	{
		productNames.push( product.produto );
		productIds[product.id_produto] = product.id_produto;
	} );
	$( '#produto' ).typeahead( { source:productNames } );
	
});


var clientNames = new Array();
var clientIds = new Object();
$.getJSON( 'cliente/cliente_json.php', null,
function ( jsonData )
{
	$.each( jsonData, function ( index, client )
	{
		clientNames.push( client.nome );
		clientIds[client.nome] = client.nome;
	} );
	$( '#cliente' ).typeahead( { source:clientNames } );
	
});



   
</script>
<style>

body {
  font: 12px 'Lucida Grande', Helvetica, Arial, Verdana, sans-serif;
}

input {
  width: 500px;
}

input.fetching {
  background: lightgrey;
}

#last-selection {
  font-size: 10px;
  color: green;
}

p.warning {
  color: red;
}

</style>

