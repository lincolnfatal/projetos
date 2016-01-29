<?php 
  include("../class.MySQL.php");
 $mySQL = new MySQL;

 
 $id_Pedido 	= $_REQUEST['id_excluir'];
 


 

$mySQL->executeQuery("update  Pedido set   Pedido_data_exclusao = now(), 
											Pedido_excluido_sn ='S' 
									where Pedido_id = '".$id_Pedido."'");
 
 $msg = "Pedido excluido com sucesso!";
 $resposta = "OK";
		

 
$array_retorno = array(
		
		"resposta" => $resposta,
		"msg" => $msg
);
	
	
	
echo json_encode($array_retorno);

?>
 