<?php

class Application_Model_Contato
{
   public function select($where = null, $order = null, $limit = null)
   {
       
  
	 
      $dao = new Application_Model_DbTable_Contato();
      $select = $dao->select()->from($dao)->order($order)->limit($limit);
	  
      if(!is_null($where)){
         $select->where($where);
      }
	   
      return $dao->fetchAll($select)->toArray();
   }
   public function find($id)
   {
      $dao = new Application_Model_DbTable_Contato();
      $arr = $dao->find($id)->toArray();
	  print_r($arr);
      return $arr[0];
   }
   public function insert(array $request)
   {
      $dao = new Application_Model_DbTable_Contato();
      $dados = array(
         'contato_nome' => $request['contato_nome'],
         'contato_telefone' => $request['contato_telefone'],
         'contato_email' => $request['contato_email']
      );
      return $dao->insert($dados);
   }
   public function update(array $request)
   {
      $dao = new Application_Model_DbTable_Contato();
      $dados = array(
         'contato_nome' => $request['contato_nome'],
         'contato_telefone' => $request['contato_telefone'],
         'contato_email' => $request['contato_email']
      );
      $where = $dao->getAdapter()->quoteInto("contato_id = ?", $request['contato_id']);
      $dao->update($dados, $where);
   }
   public function delete($id)
   {
      $dao = new Application_Model_DbTable_Contato();
      $where = $dao->getAdapter()->quoteInto("contato_id = ?", $id);
      $dao->delete($where);
   }
}

?>