<?php 
  include("../class.MySQL.php");
 $mySQL = new MySQL;
 
 $id_cliente 	= $_REQUEST['id_cliente'];
 $cliente_nome 	= $_REQUEST['nome'];
 $cliente_email = $_REQUEST['email'];
 
 $rsClientes = $mySQL->executeQuery("update  cliente set cliente_nome ='".$cliente_nome."', cliente_email = '".$cliente_email."'  where cliente_id = '".$id_cliente."'");
 $rsClientes_totalRows = mysql_num_rows($rsClientes);



?>
 