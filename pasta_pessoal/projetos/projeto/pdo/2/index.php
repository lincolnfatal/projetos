<?php

require_once "dao.php";

$dao = new DaoUsuario();


$dadosUsuario = new PojoUsuario();

echo 'inserindo novo usuario Gabriel';
$dadosUsuario->setNome('Gabriel');


echo '<br />Get nome esta como '.$dadosUsuario->getNome();
$dadosUsuario->setNome('Gabriel');

$dao::conexao()->Inserir($dadosUsuario);



echo '<br>Alterando no cod 2 para Gabriela';
$dadosUsuario->setNome('Simone');

$dadosUsuario->setCod_usuario(2);

echo '<br />Get nome esta como '.$dadosUsuario->getNome();

$dao::conexao()->Editar($dadosUsuario);


echo '<br>Buscando cod 5';
$valor = $dao::conexao()->BuscarPorCOD(5);

echo '<br />Get nome esta como '.$valor->getNome();


echo '<br>Buscando nome Gabriel';
$rs = $dao::conexao()->BuscarPorNome('gabriel');

//print_r($rs);

foreach($rs as  $value )
{
    echo "<br> Nome = ".$value->getNome()." id = ".$value->getCod_usuario();
}



/*
foreach(PDO::getAvailableDrivers() as $driver)
{
    echo $driver.'<br />';
}*/
?>