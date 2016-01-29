<?php

class ContatoController extends Zend_Controller_Action
{
   public function indexAction()
   {
      $model = new Application_Model_Contato();
	  
      $dados = $model->select();
	
      $this->view->assign("dados", $dados);
   }
   public function showAction()
   {
      $model = new Application_Model_Contato();
      $contato = $model->find($this->_getParam('id'));
      $this->view->assign("contato", $contato);
   }
   public function newAction()
   {}
   public function createAction()
   {
      $model = new Application_Model_Contato();
      $model->insert($this->_getAllParams());
      $this->_redirect('contato/index');
   }
   public function editAction()
   {
      $model = new Application_Model_Contato();
      $contato = $model->find($this->_getParam('id'));
      $this->view->assign("contato", $contato);
   }
   public function updateAction()
   {
      $model = new Application_Model_Contato();
      $model->update($this->_getAllParams());
      $this->_redirect('contato/index');
   }
   public function destroyAction()
   {
      $model = new Application_Model_Contato();
      $model->delete($this->_getParam('id'));
      $this->_redirect('contato/index');
   }
}
