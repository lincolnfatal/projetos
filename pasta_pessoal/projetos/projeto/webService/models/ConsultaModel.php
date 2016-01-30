<?php


/**
* @package Exemplo simples com MVC 
* @author Lincoln 
* @version 0.1.1
*  
* Camada - Modelo ou Model.
* Diretório Pai - models  
* Arquivo - TelefoneModel
*
* Responsável por gerenciar os dados da consulta

**/
class ConsultaModel extends PersistModelAbstract
{
	private $in_id;
	private $st_requisicao_temperatura;
	private $st_requisicao_tipo;
	private $st_resposta_temperatura;
	private $st_data_consulta;
	private $st_ip;
	private $st_xml_gerado  ;
	
	
	function __construct()
	{
		parent::__construct();
		//executa método de criação da tabela de Telefone
		$this->createTablePesquisa();
	}
	
	
	/**
	 * Setters e Getters da
	 * classe TelefoneModel
	 */
	
	public function setId( $in_id )
	{
		$this->in_id = $in_id;
		return $this;
	}
	
	public function getId()
	{
		return $this->in_id;
	}
	
	public function setRequisicaoTemperatura( $st_requisicao_temperatura )
	{
		$this->st_requisicao_temperatura = $st_requisicao_temperatura;
		return $this;
	}
	
	public function getRequisicaoTemperatura()
	{
		return $this->st_requisicao_temperatura;
	}
	
	public function setRespostaTemperatura( $st_resposta_temperatura )
	{
		$this->st_resposta_temperatura = $st_resposta_temperatura;
		return $this;
	}
	
	public function getRespostaTemperatura()
	{
		return $this->st_resposta_temperatura;
	}
	
	public function setRequisicaoTipo( $st_requisicao_tipo )
	{
		$this->st_requisicao_tipo = $st_requisicao_tipo;
		return $this;
	}
	
	public function getRequisicaoTipo()
	{
		return $this->st_requisicao_tipo;
	}
	
	public function setDataConsulta( $st_data_consulta )
	{
		$this->st_data_consulta = $st_data_consulta;
		return $this;
	}
	
	public function getDataConsulta()
	{		
		$timestamp = strtotime($this->st_data_consulta); // Gera o timestamp de $data_mysql
		$this->st_data_consulta = date('d/m/Y H:i:s', $timestamp); 
		return $this->st_data_consulta;
	}
	
	public function setIp( $st_ip )
	{
		$this->st_ip = $st_ip;
		return $this;
	}
	
	public function getIp()
	{
		return $this->st_ip;
	}
	
	
	public function setXmlGerado( $st_xml_gerado )
	{
		$this->st_xml_gerado = $st_xml_gerado;
		return $this;
	}
	
	public function getXmlGerado()
	{
		return $this->st_xml_gerado;
	}
	
	
	/**
	* Retorna um array contendo os contatos
	* @param string $st_nome
	* @return Array
	*/
	public function _list($id_cont = null )
	{
	
		if(!is_null($id_cont))
			$st_query = 'SELECT * FROM pesquisa where excluido = 0 and id_consulta = "'.$id_cont.'" order by id_consulta desc limit 1;';	
		else
			$st_query = 'SELECT * FROM pesquisa where excluido = 0 order by id_consulta desc ;';	
		
		$v_consultas = array();
		try
		{
			$o_data = $this->o_db->query($st_query);
			while($o_ret = $o_data->fetchObject())
			{
				$o_consulta = new ConsultaModel();
				$o_consulta->setId($o_ret->id_consulta);
				$o_consulta->setRequisicaoTemperatura($o_ret->requisicao_temperatura);
				$o_consulta->setRequisicaoTipo($o_ret->requisicao_tipo);
				$o_consulta->setRespostaTemperatura($o_ret->resposta_temperatura);
				$o_consulta->setDataConsulta($o_ret->datahora_consulta);
				$o_consulta->setIp($o_ret->ip_requisitante);
				$o_consulta->setXmlGerado($o_ret->xml_gerado);				
				
				array_push($v_consultas, $o_consulta);
			}
		}
		catch(PDOException $e)
		{}				
		return $v_consultas;
	}
	
	/**
	* Retorna os dados de um contato referente
	* a um determinado Id
	* @param integer $in_id
	* @return ContatoModel
	*/
	public function loadById( $in_id )
	{
		$v_consultas = array();
		$st_query = "SELECT * FROM pesquisa WHERE id_consulta = $in_id;";
		$o_data = $this->o_db->query($st_query);
		$o_ret = $o_data->fetchObject();
		$this->setId($o_ret->id_consulta);	
		return $this;
	}
	
	/**
	* Salva dados contidos na instancia da classe
	* na tabela de contato. Se o ID for passado,
	* um UPDATE será executado, caso contrário, um
	* INSERT será executado
	* @throws PDOException
	* @return integer
	*/
	public function save()
	{
		
		$st_query = "INSERT INTO pesquisa
					(
						requisicao_temperatura,
						requisicao_tipo,
						resposta_temperatura,
						ip_requisitante,
						xml_gerado
						
					)
					VALUES
					(
						'$this->st_requisicao_temperatura',
						'$this->st_requisicao_tipo',
						'$this->st_resposta_temperatura',
						'$this->st_ip',
						'$this->st_xml_gerado'
					);";
		
		try
		{
			
			if($this->o_db->exec($st_query) > 0)
				if(is_null($this->in_id))
				{
					
					/*
					* verificando se o driver usado é sqlite e pegando o ultimo id inserido
					* por algum motivo, a função nativa do PDO::lastInsertId() não funciona com sqlite
					*/
					if($this->o_db->getAttribute(PDO::ATTR_DRIVER_NAME) === 'sqlite')
					{
						$o_ret = $this->o_db->query('SELECT last_insert_rowid() AS com_in_id')->fetchObject();
						return $o_ret->com_in_id;
					}
					else
						return $this->o_db->lastInsertId();
					
				}
				else
					return $this->in_id;
		}
		catch (PDOException $e)
		{
			throw $e;
		}
		return false;				
	}

	/**
	* Deleta os dados persistidos na tabela de
	* contato usando como referencia, o id da classe.
	*/
	public function delete()
	{
		if(!is_null($this->in_id))
		{
			echo $st_query = "UPDATE 
							pesquisa set excluido = 1
						WHERE id_consulta = $this->in_id";
			if($this->o_db->exec($st_query) > 0)
				return true;
		}
		return false;
	}
	
	/**
	* Cria tabela para armazernar os dados de contato, caso
	* ela ainda não exista.
	* @throws PDOException
	*/
	private function createTablePesquisa()
	{
		/*
		* No caso do Sqlite, o AUTO_INCREMENT é automático na chave primaria da tabela
		* No caso do MySQL, o AUTO_INCREMENT deve ser especificado na criação do campo
		*/
		if($this->o_db->getAttribute(PDO::ATTR_DRIVER_NAME) === 'sqlite')
			$st_auto_increment = '';
		else
			$st_auto_increment = 'AUTO_INCREMENT';
		
		$st_query = " CREATE TABLE IF NOT EXISTS pesquisa (
					id_consulta INT(11) NOT NULL $st_auto_increment,
					requisicao_temperatura FLOAT NOT NULL,
					requisicao_tipo VARCHAR(20) NOT NULL,
					resposta_temperatura FLOAT NOT NULL,
					datahora_consulta DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					ip_requisitante VARCHAR(20) NOT NULL,
					xml_gerado TEXT NULL,
					excluido INT(11) NULL DEFAULT '0',
					PRIMARY KEY (id_consulta)
				);";

		//executando a query;
		try
		{
			$this->o_db->exec($st_query);
		}
		catch(PDOException $e)
		{
			throw $e;
		}	
	}
}
?>