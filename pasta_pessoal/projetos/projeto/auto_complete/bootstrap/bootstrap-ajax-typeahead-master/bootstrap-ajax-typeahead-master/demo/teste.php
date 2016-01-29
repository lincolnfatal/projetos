<?php
$con = new mysqli("localhost","root","","estoque");

$result = $con->query("SELECT cliente_id,cliente_nome FROM cliente LIMIT 0,10");
    while ($row = $result->fetch_object()){
         $user_arr[] = $row->cliente_id;
         $user_arr2[] = $row->cliente_nome;
     }
     $result->close();
     echo json_encode($user_arr2);
?>