<?php
	include("../class.MySQL.php");
	$mySQL = new MySQL;
	if (isset($_REQUEST['id_valor'])) {
		$id_produto = $_REQUEST['id_valor'];
		$rsProdutos = $mySQL->executeQuery("SELECT * FROM produto where produto_id = '".$id_produto."' and produto_excluido_sn = 'N'  ;");
		
		while ($row_rsProdutos = mysql_fetch_array($rsProdutos)){
					

			$array_produtos = array(
			
				"id_produto" => $row_rsProdutos["produto_id"],
				"produto" => $row_rsProdutos["produto_nome"],
				"desc" => $row_rsProdutos["produto_descricao"],
				"qtd" => $row_rsProdutos["produto_qtd"],
				"preco" => $row_rsProdutos["produto_preco"]
				
			);
		}
	
	}else{
		$rsProdutos = $mySQL->executeQuery("SELECT * FROM produto where produto_excluido_sn = 'N'  ;");
		while ($row_rsProdutos = mysql_fetch_array($rsProdutos)){
					

			$array_produtos[] = array(
			
				"id_produto" => $row_rsProdutos["produto_id"],
				"produto" => $row_rsProdutos["produto_nome"],
				"desc" => $row_rsProdutos["produto_descricao"],
				"qtd" => $row_rsProdutos["produto_qtd"],
				"preco" => $row_rsProdutos["produto_preco"]
				
			);
		}
		
		
	}
	while ($row_rsProdutos = mysql_fetch_array($rsProdutos)){
					

		$array_produtos = array(
		
			"id_produto" => $row_rsProdutos["produto_id"],
			"produto" => $row_rsProdutos["produto_nome"],
			"desc" => $row_rsProdutos["produto_descricao"],
			"qtd" => $row_rsProdutos["produto_qtd"],
			"preco" => $row_rsProdutos["produto_preco"]
			
		);
	}
	
	
	echo json_encode($array_produtos);
?>