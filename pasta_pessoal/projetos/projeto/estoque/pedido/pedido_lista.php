<?php 
  include("../class.MySQL.php");
 $mySQL = new MySQL;
 
  $sqlFiltro = 'SELECT * FROM pedido pe inner join 
							  cliente cl on pe.pedido_id_cliente = cl.cliente_id
							  inner join produto pd on pe.pedido_id_produto = pd.produto_id
						where pe.pedido_excluido_sn = "N" ';
 
 if (isset($_REQUEST['pesquisa'])) {
	 $pesquisa 	= $_REQUEST['pesquisa'];
	 

	 if($pesquisa != ''){
		$sqlFiltro .= ' and  ( cl.cliente_nome like "%'.$pesquisa.'%"  or pd.produto_nome like "%'.$pesquisa.'%"  ) '; 
	 }
 }
 $sqlFiltro .= ' order by pe.pedido_data_atualizacao desc';
 
 $rsPedidos = $mySQL->executeQuery($sqlFiltro);
 $rsPedidos_totalRows = mysql_num_rows($rsPedidos);



?>
 
 <table class="table table-striped">
              <thead>
                <tr>
                  
                  <th>Cliente</th>
                  <th>Produto</th>
                  <th>Quantidade</th>
				  <th>Visualizar</th>
				  <th>Editar</th>
				  <th>Excluir</th>
                  
                </tr>
              </thead>
              <tbody>
			  <?php
				while ($row_rsPedidos = mysql_fetch_array($rsPedidos))
				{
					
					echo '<tr>
							<td>'.$row_rsPedidos["cliente_nome"].'</td>
							<td>'.$row_rsPedidos["produto_nome"].'</td>
							<td>('.$row_rsPedidos["pedido_qtd"].') </td>
							<td><a href="javascript:;" onclick="janelaVisualizar('.$row_rsPedidos["pedido_id"].',\'pedido\')"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></td>
							<td><a href="javascript:;" onclick="janelaEditar('.$row_rsPedidos["pedido_id"].',\'pedido\')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></td>
							<td>
								<a href="#" onclick="$(\'#msg_confirn_excluir\').html(\'Desejar excluir o pedido ('.$row_rsPedidos["cliente_nome"].') ?\');" data-href="javascript:excluir_dado('.$row_rsPedidos["pedido_id"].',\'pedido\')" data-toggle="modal" data-target="#confirm-delete">
									<span class="glyphicon glyphicon-remove" ></span>
								</a>
							</td>
							
						</tr>';
				}
				
				
			?>
                
              </tbody>
            </table>
			
			



 <script>

        $('#confirm-delete').on('show.bs.modal', function(e) {
	
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			
        });
		
		
    </script>