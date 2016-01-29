<?php

require_once "dao.php";

$dao = new DaoUsuario();

$dao::getInstance()->BuscarPorCOD(1);

$dadosUsuario = new PojoUsuario();

echo 'inserindo novo usuario Gabriel';
$dadosUsuario->setNome('Gabriel');

echo '<br />Get nome esta como '.$dadosUsuario->getNome();
$dadosUsuario->setNome('Gabriel');

$dao::getInstance()->Inserir($dadosUsuario);

echo '<br>Alterando no cod 2 para Gabriela';
$dadosUsuario->setNome('Simone');

$dadosUsuario->setCod_usuario(2);

echo '<br />Get nome esta como '.$dadosUsuario->getNome();
$dao::getInstance()->Editar($dadosUsuario);


echo '<br>Buscando cod 5';
$valor = $dao::getInstance()->BuscarPorCOD(5);

echo '<br />Get nome esta como '.$valor->getNome();


echo '<br>Buscando nome Gabriel';
$valor = $dao::getInstance()->BuscarPorNome('gabriel');

print_r($valor);




/*
foreach(PDO::getAvailableDrivers() as $driver)
{
    echo $driver.'<br />';
}*/
?>