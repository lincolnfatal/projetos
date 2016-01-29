<?php
	include("../class.MySQL.php");
	$mySQL = new MySQL;
	
	$id_pedido = $_REQUEST['id_valor'];
	$rsProdutos = $mySQL->executeQuery("SELECT * FROM pedido pe inner join 
							  cliente cl on pe.pedido_id_cliente = cl.cliente_id
							  inner join produto pd on pe.pedido_id_produto = pd.produto_id
						where pe.pedido_excluido_sn = 'N' and pe.pedido_id = '".$id_pedido."' ;");
	while ($row_rsProdutos = mysql_fetch_array($rsProdutos)){
					

		$array_produtos = array(
		
			"id_pedido" => $row_rsProdutos["pedido_id"],
			"produto" => $row_rsProdutos["produto_nome"],
			"cliente" => $row_rsProdutos["cliente_nome"],
			"qtd" => $row_rsProdutos["pedido_qtd"],
			
		);
	}
	
	
	echo json_encode($array_produtos);
?>