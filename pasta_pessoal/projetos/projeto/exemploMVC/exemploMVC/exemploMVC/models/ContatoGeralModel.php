<?php
require_once 'models/TelefoneModel.php';


/**
* @package Exemplo simples com MVC 
* @author DigitalDev 
* @version 0.1.1
*  
* Camada - Modelo ou Model.
* Diretório Pai - models  
* Arquivo - TelefoneModel
*
* Responsável por gerenciar e persistir os dados dos  
* Contatos da Agenda Telefônica 
**/
class ContatoGeralModel extends PersistModelAbstract
{
	private $in_id;
	private $st_nome;
	private $st_email;
	
	private $in_ddd;
	private $in_telefone;
	private $in_telefone_id;
	
	
	
	
	/**
	 * Setters e Getters da
	 * classe TelefoneModel
	 */
	 
	 
	public function setTelefone_id( $in_telefone_id )
	{
		$this->in_telefone_id = $in_telefone_id;
		return $this;
	}
	
	public function getTelefone_id()
	{
		return $this->in_telefone_id;
	}
	 
	public function setDDD( $in_ddd )
	{
		$this->in_ddd = $in_ddd;
		return $this;
	}
	
	public function getDDD()
	{
		return $this->in_ddd;
	}
	
	public function setTelefone( $in_telefone )
	{
		$this->in_telefone = $in_telefone;
		return $this;
	}
	
	public function getTelefone()
	{
		return $this->in_telefone;
	}
	 
	 
	 
	
	public function setId( $in_id )
	{
		$this->in_id = $in_id;
		return $this;
	}
	
	public function getId()
	{
		return $this->in_id;
	}
	
	public function setNome( $st_nome )
	{
		$this->st_nome = $st_nome;
		return $this;
	}
	
	public function getNome()
	{
		return $this->st_nome;
	}
	
	public function setEmail( $st_email )
	{
		$this->st_email = $st_email;
		return $this;
	}
	
	public function getEmail()
	{
		return $this->st_email;
	}
	
	/**
	* Retorna um array contendo os contatos
	* @param string $st_nome
	* @return Array
	*/
	public function _list( $id_cont = null )
	{
		
		$st_query = "SELECT * FROM tbl_contato WHERE con_in_id = '$id_cont';";
		
		$v_contatos = array();
		try
		{
			$o_data = $this->o_db->query($st_query);
			while($o_ret = $o_data->fetchObject())
			{
				$o_contato = new ContatoModel();
				$o_contato->setId($o_ret->con_in_id);
				$o_contato->setNome($o_ret->con_st_nome);
				$o_contato->setEmail($o_ret->con_st_email);
				array_push($v_contatos, $o_contato);
			}
		}
		catch(PDOException $e)
		{}				
		return $v_contatos;
	}
	
	public function _listGeral( $ind_con = null )
	{
		$st_query = "SELECT * FROM tbl_contato WHERE con_in_id = '$ind_con';";
			
		
		$v_contatos = array();
		try
		{
			$o_data = $this->o_db->query($st_query);
			
			while($o_ret = $o_data->fetchObject())
			{
				$o_contato = new ContatoGeralModel();
				$o_contato->setId($o_ret->con_in_id);
				$o_contato->setNome($o_ret->con_st_nome);
				$o_contato->setEmail($o_ret->con_st_email);
				array_push($v_contatos, $o_contato);
			}
			
			
			
					
		}
		catch(PDOException $e)
		{}	
		$st_query = "SELECT * FROM tbl_telefone WHERE con_in_id = $ind_con";
		$v_telefones = array();
		try
		{
			$o_data = $this->o_db->query($st_query);
			while($o_ret = $o_data->fetchObject())
			{
				$o_telefone = new ContatoGeralModel();
				$o_telefone->setId($o_ret->tel_in_id);
				$o_telefone->setDDD($o_ret->tel_in_ddd);
				$o_telefone->setTelefone($o_ret->tel_in_telefone);
				$o_telefone->setTelefone_id($o_ret->con_in_id);
				array_push($v_telefones,$o_telefone);
			}
		}
		catch(PDOException $e)
		{}		
		$rt_result['contato'] =  $v_contatos;
		$rt_result['telefone'] =  $v_telefones;
		return $rt_result;
	}
	
	/**
	* Retorna os dados de um contato referente
	* a um determinado Id
	* @param integer $in_id
	* @return ContatoModel
	*/
	public function loadById( $in_id )
	{
		$v_contatos = array();
		$st_query = "SELECT * FROM tbl_contato WHERE con_in_id = $in_id;";
		$o_data = $this->o_db->query($st_query);
		$o_ret = $o_data->fetchObject();
		$this->setId($o_ret->con_in_id);
		$this->setNome($o_ret->con_st_nome);
		$this->setEmail($o_ret->con_st_email);		
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
		if(is_null($this->in_id))
			$st_query = "INSERT INTO tbl_contato
						(
							con_st_nome,
							con_st_email
						)
						VALUES
						(
							'$this->st_nome',
							'$this->st_email'
						);";
		else
			$st_query = "UPDATE
							tbl_contato
						SET
							con_st_nome = '$this->st_nome',
							con_st_email = '$this->st_email'
						WHERE
							con_in_id = $this->in_id";
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
			$st_query = "DELETE FROM
							tbl_contato
						WHERE con_in_id = $this->in_id";
			if($this->o_db->exec($st_query) > 0)
				return true;
		}
		return false;
	}
	
	
}
?>