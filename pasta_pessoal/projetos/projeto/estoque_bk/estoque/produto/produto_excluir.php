<?php 
  include("../class.MySQL.php");
 $mySQL = new MySQL;

 
 $id_produto 	= $_REQUEST['id_excluir'];
 

  $sqlFiltro = 'SELECT * FROM produto where produto_excluido_sn = "N" and produto_id = "'.$id_produto.'" limit 1';
 

 
 $rsProdutos = $mySQL->executeQuery($sqlFiltro);
while ($row_rsProdutos = mysql_fetch_array($rsProdutos)){
	$nome = $row_rsProdutos['produto_nome'];
}
 

$mySQL->executeQuery("update  produto set   produto_data_exclusao = now(), 
											produto_excluido_sn ='S' 
									where produto_id = '".$id_produto."'");
 
 $msg = "Produto  (".$nome.") excluido com sucesso!";
 $resposta = "OK";
		

 
$array_retorno = array(
		
		"resposta" => $resposta,
		"msg" => $msg
);
	
	
	
echo json_encode($array_retorno);

?>
 