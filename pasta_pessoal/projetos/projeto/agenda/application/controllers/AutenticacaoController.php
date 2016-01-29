<?php
class AutenticacaoController extends Zend_Controller_Action
{
   public function indexAction()
   {}
   public function loginAction()
   {
      //Desabilita renderização da view
      $this->_helper->viewRenderer->setNoRender();
      //Obter o objeto do adaptador para autenticar usando banco de dados
      $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
      $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
      //Seta qual tabela e colunas procurar o usuário
      $authAdapter->setTableName('usuario')
         ->setIdentityColumn('login')
         ->setCredentialColumn('senha');
      //Seta as credenciais com dados vindos do formulário de login
      $authAdapter->setIdentity($this->_getParam('login'))
         ->setCredential($this->_getParam('senha'))
         ->setCredentialTreatment('MD5(?)');
      //Realiza autenticação
      $result = $authAdapter->authenticate();
      //Verifica se a autenticação foi válida
      if($result->isValid()){
         //Obtém dados do usuário
         $usuario = $authAdapter->getResultRowObject();
         //Armazena seus dados na sessão
         $storage = Zend_Auth::getInstance()->getStorage();
         $storage->write($usuario);
         //Redireciona para o Index
         $this->_redirect('index');
      }else{
         $this->_redirect('autenticacao/falha');
      }
   }
   public function falhaAction()
   {}
   public function logoutAction()
   {
      //Limpa dados da Sessão
      Zend_Auth::getInstance()->clearIdentity();
      //Redireciona a requisição para a tela de Autenticacao novamente
      $this->_redirect('autenticacao');
   }
}