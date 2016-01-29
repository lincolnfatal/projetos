<?php
$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="estoque"; // Database name


	$con = mysql_connect($host,$username,$password)   or die(mysql_error());
	mysql_select_db($db_name, $con)  or die(mysql_error());

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT cliente_nome,cliente_email from cliente where cliente_nome LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['cliente_email'];
	echo "$cname\n";
}
?>