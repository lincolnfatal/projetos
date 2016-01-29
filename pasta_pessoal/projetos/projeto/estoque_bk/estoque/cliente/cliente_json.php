<?php
	include("../class.MySQL.php");
	$mySQL = new MySQL;
	
	if (isset($_REQUEST['id_valor'])) {
		$id_cliente = $_REQUEST['id_valor'];
		$rsClientes = $mySQL->executeQuery("SELECT * FROM cliente where cliente_id = '".$id_cliente."' ;");
		while ($row_rsClientes = mysql_fetch_array($rsClientes)){
						

			$array_clientes = array(
			
				"id_cliente" => $row_rsClientes["cliente_id"],
				"nome" => $row_rsClientes["cliente_nome"],
				"email" => $row_rsClientes["cliente_email"],
				"fone" => $row_rsClientes["cliente_ddd"].' '.$row_rsClientes["cliente_fone"]
				
			);
		}
	}else{
		$rsClientes = $mySQL->executeQuery("SELECT * FROM cliente where cliente_excluido_sn = 'N' ;");
		while ($row_rsClientes = mysql_fetch_array($rsClientes)){
						

			$array_clientes[] = array(
			
				"id_cliente" => $row_rsClientes["cliente_id"],
				"nome" => $row_rsClientes["cliente_nome"],
				"email" => $row_rsClientes["cliente_email"],
				"fone" => $row_rsClientes["cliente_ddd"].' '.$row_rsClientes["cliente_fone"]
				
			);
		}
		
	}
	
	
	echo json_encode($array_clientes);
?>