<?php 
  include("../class.MySQL.php");
 $mySQL = new MySQL;

 
 $id_produto 	= $_REQUEST['id_produto'];
 $produto_nome 	= $_REQUEST['produto'];
 $produto_desc = $_REQUEST['desc'];
 
 $produto_preco 	= $_REQUEST['preco'];

 
 $produto_qtd =  $_REQUEST['qtd'];


 if($id_produto > 0){
	 
	$sqlFiltro = 'SELECT * FROM produto  where produto_nome =  "'.$produto_nome.'" and produto_id != "'.$id_produto.'" and produto_excluido_sn = "N" limit 1'; 
	
	$rsProdutos = $mySQL->executeQuery($sqlFiltro);
	$rsProdutos_totalRows = mysql_num_rows($rsProdutos);

	 
	if($rsProdutos_totalRows == 0){
		$rsProdutos = $mySQL->executeQuery("update  produto set produto_data_atualizacao = now(), 
																		produto_nome ='".$produto_nome."',
																		produto_qtd ='".$produto_qtd."',
																		produto_preco ='".$produto_preco."',
																		produto_descricao = '".$produto_desc."'  
																where produto_id = '".$id_produto."'");
		$msg = "Produto Gravado com sucesso!";
		$resposta = "OK";
	}else{
		$msg = " Produto já cadastrado com esse nome";
		$resposta = "ERRO";
	}
 }else{
	$sqlFiltro = 'SELECT * FROM produto  where produto_nome =  "'.$produto_nome.'" and produto_excluido_sn = "N" limit 1'; 
	
	$rsProdutos = $mySQL->executeQuery($sqlFiltro);
	$rsProdutos_totalRows = mysql_num_rows($rsProdutos);

	 
	if($rsProdutos_totalRows == 0){
		$rsProdutos = $mySQL->executeQuery("INSERT INTO `estoque`.`produto` (`produto_nome`, `produto_descricao`, `produto_qtd`, `produto_preco`) 
												VALUES ('".$produto_nome."', '".$produto_desc."', '".$produto_qtd."', '".$produto_preco."');");
		$msg = "Produto Gravado com sucesso!";
		$resposta = "OK";
	}else{
		$resposta = "ERRO";
		$msg = " Produto já cadastrado com esse nome";
	}
	
	 
 }
 
 
 
		

 
$array_retorno = array(
		"resposta" => $resposta,
		"msg" => $msg
);
	
	
	
echo json_encode($array_retorno);

?>
 