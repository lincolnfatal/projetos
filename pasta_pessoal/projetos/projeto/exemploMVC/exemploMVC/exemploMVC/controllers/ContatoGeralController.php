<?php
//incluindo classes da camada Model
require_once 'models/ContatoGeralModel.php';


/**
 * 
 * Responsável por gerenciar o fluxo de dados entre
 * a camada de modelo e a de visualização
 * 
 * Camada - Controladores ou Controllers
 * Diretório Pai - controllers
 * Arquivo - ContatoController.php
 * 
 * @author DigitalDev
* @version 0.1.1
 *
 */
class ContatoGeralController
{
	/**
	* Efetua a manipulação dos modelos necessários
	* para a aprensentação da lista de contatos
	*/
	
	
	public function listarContatoGeralAction()
	{
		$o_Contato = new ContatoGeralModel();
		
		if( isset($_REQUEST['ind_con']) )
			//verificando se o id passado é valido
			if( DataValidator::isNumeric($_REQUEST['ind_con']) ){
				//buscando dados do contato
				
		
				//Listando os contatos cadastrados
				$v_contatos = $o_Contato->_listGeral($_REQUEST['ind_con']);
				
				//definindo qual o arquivo HTML que será usado para
				//mostrar a lista de contatos
				$o_view = new View('views/listarContatoGeral.phtml');
				
				//Passando os dados do contato para a View
				$o_view->setParams(array('v_contatos' => $v_contatos));
				
				//Imprimindo código HTML
				$o_view->showContents();
			}
	}
	

}
?>