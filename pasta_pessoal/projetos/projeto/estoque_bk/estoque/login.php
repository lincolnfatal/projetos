<?php
	include("class.MySQL.php");
	$mySQL = new MySQL;$array_logins = array(
		
			"msg" => "ERRO"
		);
	
	
	$email = $_REQUEST['email'];
	$senha = $_REQUEST['senha'];
	
	
	$rsLogins = $mySQL->executeQuery("SELECT us_email FROM usuario
						where us_senha = '".$senha."' and us_email = '".$email."'");
	while ($row_rsLogins = mysql_fetch_array($rsLogins)){
					

		$array_logins = array(
		
			"msg" => "OK"
		);
	}
	
	
	echo json_encode($array_logins);
?>