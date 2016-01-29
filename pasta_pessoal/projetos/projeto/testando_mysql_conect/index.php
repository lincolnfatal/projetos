<?php
require_once "conexao.php"; 

$mysql = new class_mysql();

$mysql-> executeQuery('delete from usuario');

?> 