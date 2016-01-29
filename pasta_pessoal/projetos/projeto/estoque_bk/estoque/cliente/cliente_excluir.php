<?php 
  include("../class.MySQL.php");
 $mySQL = new MySQL;

 
 $id_cliente 	= $_REQUEST['id_excluir'];
 

  $sqlFiltro = 'SELECT * FROM cliente where cliente_excluido_sn = "N" and cliente_id = "'.$id_cliente.'" limit 1';
 

 
 $rsClientes = $mySQL->executeQuery($sqlFiltro);
while ($row_rsClientes = mysql_fetch_array($rsClientes)){
	$email = $row_rsClientes['cliente_email'];
}
 

$mySQL->executeQuery("update  cliente set   cliente_data_exclusao = now(), 
											cliente_excluido_sn ='S' 
									where cliente_id = '".$id_cliente."'");
 
 $msg = "Cliente  (".$email.") excluido com sucesso!";
 $resposta = "OK";
		

 
$array_retorno = array(
		
		"resposta" => $resposta,
		"msg" => $msg
);
	
	
	
echo json_encode($array_retorno);

?>
 