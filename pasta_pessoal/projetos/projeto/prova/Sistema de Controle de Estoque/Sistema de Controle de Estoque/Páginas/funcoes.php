<?php

function conectar(){
    //adicionar as informações do banco de dados root,Nome do Utilizador- database,senha e banco criado
    $con=mysqli_connect("localhost","root","","controleestoque");
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: ". mysqli_connect_error();
    }
    return $con;
}






?>