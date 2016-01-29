<?php
	$mysqli = new mysqli('localhost','root','','controleestoque');
	if($mysqli->connect_errno){
		echo "Failed to connect to MySQL ".$mysqli->connect_error;
	}
	
	function lercliente($cliente_id){
		unset($_SESSION['cliente']);
		$mysqli = conectar();
		$sql="SELECT cliente_nome, cliente_email, cliente_telefone FROM cliente WHERE cliente_id= ".$cliente_id;
		$resultado = mysqli_query($mysqli,$sql);
		$rows = mysqli_fetch_assoc($result);
		$conta= mysqli_num_rows($result);
		if ($conta>0){
			foreach($rows as $column => $value) {
				$_SESSION['cliente'][$column]=$value;  
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>