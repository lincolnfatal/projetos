<?php
class class_mysql
 {
	 var $host="localhost";
	 var $user="root";
	 var $password="";
	 var $database="teste";

	var $query;
	var $link;
	var $result;

	function class_mysql()
	{
		//Apenas instancia o Objeto
	}
	function connect()
	 {
		 $this->link=mysql_connect($this->host,$this->user,$this->password);
		 if(!$this->link)
		 {
			 echo "Falha na conexao com o Banco de Dados!<br />";
			 echo "Erro: " . mysql_error();
			 die();
		 }
		 elseif(!mysql_select_db($this->database, $this->link))
		 {
			 echo "O Banco de Dados solicitado não pode ser aberto!<br />";
			 echo "Erro: " . mysql_error();
			 die();
		 }
	 }
	 function executeQuery($query)
	 {
		 $this->connect();
		 $this->query=$query;
		 if($this->result=mysql_query($this->query))
		 {
			 $this->disconnect();
			 return $this->result;
		 }
		 else
		 {
			echo "Ocorreu um erro na execução da SQL";
			echo "Erro :" . mysql_error();
			echo "SQL: " . $query;
			die();
			disconnect();
		 }
	 }
	function disconnect(){
		return mysql_close($this->link);
	} 


 }


?>