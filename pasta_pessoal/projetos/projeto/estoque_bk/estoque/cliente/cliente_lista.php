<?php 
  include("../class.MySQL.php");
 $mySQL = new MySQL;
 
  $sqlFiltro = 'SELECT * FROM cliente where cliente_excluido_sn = "N" ';
 
 if (isset($_REQUEST['pesquisa'])) {
	 $pesquisa 	= $_REQUEST['pesquisa'];
	 

	 if($pesquisa != ''){
		$sqlFiltro .= ' and  ( cliente_nome like "%'.$pesquisa.'%" or cliente_email like "%'.$pesquisa.'%") '; 
	 }
 }
 $sqlFiltro .= ' order by cliente_data_atualizacao desc';
 
 $rsClientes = $mySQL->executeQuery($sqlFiltro);
 $rsClientes_totalRows = mysql_num_rows($rsClientes);



?>
 
 <table class="table table-striped">
              <thead>
                <tr>
                  
                  <th>Nome</th>
                  <th>email</th>
                  <th>Telefone</th>
				  <th>Visualizar</th>
				  <th>Editar</th>
				  <th>Excluir</th>
                  
                </tr>
              </thead>
              <tbody>
			  <?php
				while ($row_rsClientes = mysql_fetch_array($rsClientes))
				{
					
					echo '<tr>
							<td>'.$row_rsClientes["cliente_nome"].'</td>
							<td>'.$row_rsClientes["cliente_email"].'</td>
							<td>('.$row_rsClientes["cliente_ddd"].') '.$row_rsClientes["cliente_fone"].'</td>
							<td><a href="javascript:;" onclick="janelaVisualizar('.$row_rsClientes["cliente_id"].',\'cliente\')"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></td>
							<td><a href="javascript:;" onclick="janelaEditar('.$row_rsClientes["cliente_id"].',\'cliente\')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></td>
							<td>
								<a href="#" onclick="$(\'#msg_confirn_excluir\').html(\'Desejar excluir o clinte ('.$row_rsClientes["cliente_nome"].') ?\');" data-href="javascript:excluir_dado('.$row_rsClientes["cliente_id"].',\'cliente\')" data-toggle="modal" data-target="#confirm-delete">
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