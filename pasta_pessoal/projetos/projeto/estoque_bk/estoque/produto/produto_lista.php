<?php 
  include("../class.MySQL.php");
 $mySQL = new MySQL;
 
  $sqlFiltro = 'SELECT * FROM produto where produto_excluido_sn = "N" ';
 
 if (isset($_REQUEST['pesquisa'])) {
	 $pesquisa 	= $_REQUEST['pesquisa'];
	 

	 if($pesquisa != ''){
		$sqlFiltro .= ' and  ( produto_nome like "%'.$pesquisa.'%" ) '; 
	 }
 }
 $sqlFiltro .= ' order by produto_data_atualizacao desc';
 
 $rsProdutos = $mySQL->executeQuery($sqlFiltro);
 $rsProdutos_totalRows = mysql_num_rows($rsProdutos);



?>
 
 <table class="table table-striped">
              <thead>
                <tr>
                  
                  <th>Produto</th>
                  <th>Preço</th>
                  <th>Quantidade</th>
				  <th>Visualizar</th>
				  <th>Editar</th>
				  <th>Excluir</th>
                  
                </tr>
              </thead>
              <tbody>
			  <?php
				while ($row_rsProdutos = mysql_fetch_array($rsProdutos))
				{
					
					echo '<tr>
							<td>'.$row_rsProdutos["produto_nome"].'</td>
							<td>'.$row_rsProdutos["produto_preco"].'</td>
							<td>('.$row_rsProdutos["produto_qtd"].') </td>
							<td><a href="javascript:;" onclick="janelaVisualizar('.$row_rsProdutos["produto_id"].',\'produto\')"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></td>
							<td><a href="javascript:;" onclick="janelaEditar('.$row_rsProdutos["produto_id"].',\'produto\')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></td>
							<td>
								<a href="#" onclick="$(\'#msg_confirn_excluir\').html(\'Desejar excluir o produto ('.$row_rsProdutos["produto_nome"].') ?\');" data-href="javascript:excluir_dado('.$row_rsProdutos["produto_id"].',\'produto\')" data-toggle="modal" data-target="#confirm-delete">
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