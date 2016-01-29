<?php 
  include("../class.MySQL.php");
 $mySQL = new MySQL;

 
 $id_cliente 	= $_REQUEST['id_cliente'];
 $cliente_nome 	= $_REQUEST['nome'];
 $cliente_email = $_REQUEST['email'];
 
 $cliente_fone 	= substr($_REQUEST['fone'], 2);
 $cliente_fone  = str_replace('-','',$cliente_fone);
 $cliente_fone  = str_replace(' ','',$cliente_fone);
 
 $cliente_ddd =  substr($_REQUEST['fone'],0, 2);


 if($id_cliente > 0){
	 
	$sqlFiltro = 'SELECT * FROM cliente  where cliente_email =  "'.$cliente_email.'" and cliente_id != "'.$id_cliente.'" and cliente_excluido_sn = "N" limit 1'; 
	
	$rsClientes = $mySQL->executeQuery($sqlFiltro);
	$rsClientes_totalRows = mysql_num_rows($rsClientes);

	 
	if($rsClientes_totalRows == 0){
		$rsClientes = $mySQL->executeQuery("update  cliente set cliente_data_atualizacao = now(), 
																		cliente_nome ='".$cliente_nome."',
																		cliente_ddd ='".$cliente_ddd."',
																		cliente_fone ='".$cliente_fone."',
																		cliente_email = '".$cliente_email."'  
																where cliente_id = '".$id_cliente."'");
		$msg = "Cliente Gravado com sucesso!";
		$resposta = "OK";
	}else{
		$msg = " Cliente já cadastrado com esse email";
		$resposta = "ERRO";
	}
 }else{
	$sqlFiltro = 'SELECT * FROM cliente  where cliente_email =  "'.$cliente_email.'" and cliente_excluido_sn = "N" limit 1'; 
	
	$rsClientes = $mySQL->executeQuery($sqlFiltro);
	$rsClientes_totalRows = mysql_num_rows($rsClientes);

	 
	if($rsClientes_totalRows == 0){
		$rsClientes = $mySQL->executeQuery("INSERT INTO `estoque`.`cliente` (`cliente_nome`, `cliente_email`, `cliente_ddd`, `cliente_fone`) 
												VALUES ('".$cliente_nome."', '".$cliente_email."', '".$cliente_ddd."', '".$cliente_fone."');");
		$msg = "Cliente Gravado com sucesso!";
		$resposta = "OK";
	}else{
		$resposta = "ERRO";
		$msg = " Cliente já cadastrado com esse email";
	}
	
	 
 }
 
 
 
		

 
$array_retorno = array(
		"resposta" => $resposta,
		"msg" => $msg
);
	
	
	
echo json_encode($array_retorno);

?>
 