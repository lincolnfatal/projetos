<?php
include("class_cliente.php");

$tempCliente = new Cliente();
$tempCliente->nome = "Lincoln";
$tempCliente->saldo = 100;
$tempCliente->confirmarrecebimento();
$tempCliente->pagarconta(300);

echo "<br/>Nome do Cliente : ".$tempCliente->nome;
echo "<br/>Nome do Saldo : ".$tempCliente->saldo;

?>