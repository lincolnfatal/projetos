<?php
 /**
 * Classe Abstrata responsável por centralizar a conexão
 * com o banco de dados
 * 
 * @package Exemplo simples com MVC
 * @author DigitalDev
 * @version 0.1.1
 *  
 * Diretório Pai - lib
 * Arquivo - PersistModelAbstract.php
 */
abstract class PersistModelAbstract
{
    /**
    * Variável responsável por guardar dados da conexão do banco
    * @var resource
    */
    protected $o_db;
      
    function __construct()
    {
		$this->o_db  = new PDO('mysql:host=localhost;dbname=teste_pdo', 'root', '',
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$this->o_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->o_db ->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
      
      
         
          
       
      
    }
}
?>