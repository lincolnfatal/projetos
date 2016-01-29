<?php

class cliente {
 
    public $nome;
    public $saldo;
    public function confirmarrecebimento(){
      echo  "<br/>Confirmado o recebimento";
    }   
    public function pagarconta($valor){
      echo "<br/>Foi pago o valor de R$ ".$valor;
    }     
}   
?>