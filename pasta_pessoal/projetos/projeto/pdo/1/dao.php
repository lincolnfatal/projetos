<?php

require_once "conexao.php";
require_once "usuario.php";
require_once "geralog.php";



class  DaoUsuario {

     public static $instance;

    function __construct() {
        //
		
    }

    public static function getInstance() {
		
        if (!isset(self::$instance))
            self::$instance = new DaoUsuario();

        return self::$instance;
    }

    public function Inserir(PojoUsuario $usuario) {
        try {
            $sql = "INSERT INTO usuario (		
                nome,
                email,
                senha,
                ativo) 
                VALUES (
                :nome,
                :email,
                :senha,
                :ativo)";

            $p_sql = Conexao::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $usuario->getNome());
            $p_sql->bindValue(":email", $usuario->getEmail());
            $p_sql->bindValue(":senha", $usuario->getSenha());
            $p_sql->bindValue(":ativo", $usuario->getAtivo());
          


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . 
$e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function Editar(PojoUsuario $usuario) {
        try {
            $sql = "UPDATE usuario set
		nome = :nome,
                email = :email,
                senha = :senha,
                ativo = :ativo WHERE cod_usuario = :cod_usuario";

            $p_sql = Conexao::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $usuario->getNome());
            $p_sql->bindValue(":email", $usuario->getEmail());
            $p_sql->bindValue(":senha", $usuario->getSenha());
            $p_sql->bindValue(":ativo", $usuario->getAtivo());
            
            $p_sql->bindValue(":cod_usuario", $usuario->getCod_usuario());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->
getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function Deletar($cod) {
        try {
            $sql = "DELETE FROM usuario WHERE cod_usuario = :cod";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $cod);

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->
getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function BuscarPorCOD($cod) {
        try {
            $sql = "SELECT * FROM usuario WHERE cod_usuario = :cod";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $cod);
            $p_sql->execute();
            return $this->populaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->
getCode() . " Mensagem: " . $e->getMessage());
        }
    }
	
	
	    public function BuscarPorNome($nome) {
        try {
            $sql = "SELECT * FROM usuario WHERE nome = :nome";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":nome", $nome);
            $p_sql->execute();
			
			
			 while ($row = $p_sql->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
				$dadosRetorno[] = $this->populaUsuario($row);
			 }
			
			
            return $dadosRetorno;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->
getCode() . " Mensagem: " . $e->getMessage());
        }
    }
private function populaUsuario($row) {
        $pojo = new PojoUsuario;
        $pojo->setCod_usuario($row['cod_usuario']);
        $pojo->setNome($row['nome']);
        $pojo->setEmail($row['email']);
        $pojo->setSenha($row['senha']);
        $pojo->setAtivo($row['ativo']);
        //$pojo->setPerfil(ControllerPerfil::getInstance()->BuscarPorCOD($row['cod_perfil']));
        return $pojo;
    }

}

?>
