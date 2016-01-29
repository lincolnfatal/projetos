<?php 
	include("../class.MySQL.php");
	$mySQL = new MySQL;

 
	$id_pedido 	= $_REQUEST['id_pedido'];
	$cliente 		= $_REQUEST['cliente'];
	$produto 		= $_REQUEST['produto'];
	$pedido_qtd =  $_REQUEST['qtd'];
 
	$produto_existe = "N";
	$cliente_existe = "S";
	
	$rsProdutos = $mySQL->executeQuery("SELECT cliente_id FROM cliente where cliente_nome = '".$cliente."' and cliente_excluido_sn = 'N'  ;");
		
	while ($row_rsProdutos = mysql_fetch_array($rsProdutos)){
				
		$id_cliente = $row_rsProdutos['cliente_id'];
		$cliente_existe = "S";
		
	}
	
	if($cliente_existe == 'N'){
		$msg = "Não existe esse cliente (".$produto.") no registro ! ";
		$array_retorno = array(
			"resposta" => "ERRO",
			"msg" => $msg
		);
		echo json_encode($array_retorno);
		exit();	
	}

	$produto_existe = "N";
	$rsProdutos = $mySQL->executeQuery("SELECT produto_qtd,produto_id FROM produto where produto_nome = '".$produto."' and produto_excluido_sn = 'N'  ;");
		
	while ($row_rsProdutos = mysql_fetch_array($rsProdutos)){
				
		$qtd_temp   = $row_rsProdutos["produto_qtd"];
		$id_produto = $row_rsProdutos["produto_id"];
		
		$produto_existe = "S";
		
	}
	
	if($produto_existe == 'N'){
		$msg = "Não existe esse produto (".$produto.") no estoque ";
		$array_retorno = array(
			"resposta" => "ERRO",
			"msg" => $msg
		);
		echo json_encode($array_retorno);
		exit();	
	}
	
	if($qtd_temp < $pedido_qtd){
		$msg = "Produto sem estoque, total do produto em estoque ".$qtd_temp;
		$array_retorno = array(
			"resposta" => "ERRO",
			"msg" => $msg
		);
		echo json_encode($array_retorno);
		exit();
		
	}
 
 
	 if($id_pedido > 0){
		 
		$sqlFiltro = 'SELECT * FROM pedido  where pedido_id = "'.$id_pedido.'" and pedido_excluido_sn = "N" limit 1'; 
		
		$rsPedidos = $mySQL->executeQuery($sqlFiltro);
		$rsPedidos_totalRows = mysql_num_rows($rsPedidos);

		 
		if($rsPedidos_totalRows > 0){
			
			$rsPedidos = $mySQL->executeQuery($sqlFiltro);
			while ($row_rsPedidos = mysql_fetch_array($rsPedidos)){
				$id_produto_temp = $row_rsPedidos['pedido_id_produto'];
				$pedido_qtd_temp = $row_rsPedidos['pedido_qtd'];
				
				 
			}
			if($id_produto_temp == $id_produto){
				
				$sqlFiltroTemp = "";
				if($pedido_qtd_temp < $pedido_qtd){
					$qtd_gravar = $pedido_qtd - $pedido_qtd_temp;
					// Tira a diferença 
					$rsPedidos = $mySQL->executeQuery("update  produto
														set produto_qtd = produto_qtd - ".$qtd_gravar."																				
													where produto_id = '".$id_produto."'");
				}elseif($pedido_qtd_temp > $pedido_qtd){
					$qtd_gravar = $pedido_qtd_temp - $pedido_qtd;
					// Devolver a diferença
					$rsPedidos = $mySQL->executeQuery("update  produto
														set produto_qtd = produto_qtd + ".$qtd_gravar."																				
													where produto_id = '".$id_produto."'");

				}
				
				
			}else{
			
				
				// devolve a quantidade ao antigo produto
				$rsPedidos = $mySQL->executeQuery("update  produto
																			set produto_qtd = produto_qtd + ".$pedido_qtd_temp."																				
																		where produto_id = '".$id_produto_temp."'");
				
				// TIRA A QUANTIDADE PARA O NOVO PRODUTO
				$sqlFiltroTemp = ", pr.produto_qtd = pr.produto_qtd - ".$pedido_qtd;
				$rsPedidos = $mySQL->executeQuery("update  produto
																			set produto_qtd = produto_qtd - ".$pedido_qtd_temp."																				
																		where produto_id = '".$id_produto."'");
				
			}
			$rsPedidos = $mySQL->executeQuery("update  pedido pe
															set pe.pedido_data_atualizacao = now(), 
																pe.pedido_id_produto ='".$id_produto."',
																pe.pedido_id_cliente ='".$id_cliente."',
																pe.pedido_qtd = '".$pedido_qtd."'
														where pe.pedido_id = '".$id_pedido."'");
			}
			$msg = "Pedido Gravado com sucesso!";
			$resposta = "OK";
		/*else{
			$msg = " Pedido já cadastrado com esse nome";
			$resposta = "ERRO";
		}*/
	 }else{
		/*$sqlFiltro = 'SELECT * FROM pedido  where pedido_id_cliente =  "'.$id_cliente.'" and pedido_id_produto = "'.$id_produto.'"  and pedido_id != "'.$id_pedido.'" and pedido_excluido_sn = "N" limit 1'; 
		
		$rsPedidos = $mySQL->executeQuery($sqlFiltro);
		$rsPedidos_totalRows = mysql_num_rows($rsPedidos);

		 
		if($rsPedidos_totalRows == 0){*/
			$rsPedidos = $mySQL->executeQuery("INSERT INTO `estoque`.`pedido` 
															(`pedido_id_cliente`, `pedido_id_produto`, `pedido_qtd`) 
													VALUES 	('".$id_cliente."', '".$id_produto."', '".$pedido_qtd."');");
			
			$mySQL->executeQuery("update produto 
																		set produto_qtd = produto_qtd - ".$pedido_qtd."
																	where produto_id = '".$id_produto."'");
			$msg = "Pedido Gravado com sucesso!";
			$resposta = "OK";
		/*}else{
			$resposta = "ERRO";
			$msg = " Pedido já cadastrado com esse nome";
		}*/
		
		 
	 }
	 
	 
	 
			

	 
	$array_retorno = array(
			"resposta" => $resposta,
			"msg" => $msg
	);
		
		
		
	echo json_encode($array_retorno);

?>
 