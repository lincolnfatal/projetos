<?php
//incluindo classes da camada Model
require_once 'models/ConsultaModel.php';


/**
 * 
 * Responsável por gerenciar o fluxo de dados entre
 * a camada de modelo e a de visualização
 * 
 * Camada - Controladores ou Controllers
 * Diretório Pai - controllers
 * Arquivo - Consulta.php
 * 
 * @author Lincoln
* @version 0.1.1
 *
 */
class ConsultaController
{
	/**
	* Efetua a manipulação dos modelos necessários
	* para a aprensentação da lista de acessos
	*/
	public function listarConsultaAction()
	{
		$o_consulta = new ConsultaModel();
		
		//Listando os consulta cadastrados
		$v_consultas = $o_consulta->_list();
		
		//definindo qual o arquivo HTML que será usado para
		//mostrar a lista de consulta
		$o_view = new View('views/listarConsulta.phtml');
		
		//Passando os dados da consulta para a View
		$o_view->setParams(array('v_consultas' => $v_consultas));
		
		//Imprimindo código HTML
		$o_view->showContents();
	}
	
	
	/**
	* Efetua a manipulação dos modelos necessários
	* para a aprensentação da lista de acessos
	*/
	public function listarXmlAction()
	{
		$o_consulta = new ConsultaModel();
		
		//Listando os consulta cadastrados
		$v_consultas = $o_consulta->_list($_REQUEST['ind_con']);
		
		//definindo qual o arquivo HTML que será usado para
		//mostrar a lista de consulta
		$o_view = new View('views/listarXml.phtml');
		
		//Passando os dados da consulta para a View
		$o_view->setParams(array('v_consultas' => $v_consultas));
		
		//Imprimindo código HTML
		$o_view->showContents();
	}
	
	
	
	
	
	/**
	* Gerencia a requisições de exclusão dos consulta
	*/
	public function apagarConsultaAction()
	{
		if( DataValidator::isNumeric($_GET['in_con']) )
		{
			//apagando o contato
			$o_consulta = new ConsultaModel();
			$o_consulta->loadById($_GET['in_con']);
			$o_consulta->delete();
			
			Application::redirect('?controle=Consulta&acao=listarConsulta');
		}	
	}
	
	/**
	* Gerencia a  de criação
	* e edição dos consulta 
	*/
	public function consultarWebServiceAction()
	{
		$o_consulta = new ConsultaModel();
		
		//verificando se o id da consulta foi passado
		if( isset($_REQUEST['valor_consulta']) )
			//verificando se o valor passado é valido
			if( DataValidator::isNumeric($_REQUEST['valor_consulta']) ){
				//buscando dados no webService 'http://www.w3schools.com/webservices/tempconvert.asmx' contato
						
				
				$client = new SoapClient('http://www.w3schools.com/webservices/tempconvert.asmx?WSDL');
				
				
				if($_REQUEST['tipo'] == 'Fahrenheit_Celsius'){
					$function = 'FahrenheitToCelsius';
				 
					$arguments= array('FahrenheitToCelsius' => array(
										'Fahrenheit'   => 123
								));
				}else{
					$function = 'CelsiusToFahrenheit';
				 
					$arguments= array('CelsiusToFahrenheit' => array(
										'Celsius'   => $_REQUEST['valor_consulta']
								));
				}
			
				
				$options = array('location' => 'http://www.w3schools.com/webservices/tempconvert.asmx?WSDL');
				 
				try {
					$result = $client->__soapCall($function, $arguments, $options);
				} catch (SoapFault $exception) {
						echo $exception;
				}
				
				
				
				
				if($_REQUEST['tipo'] == 'Fahrenheit_Celsius'){
					$o_consulta->setRespostaTemperatura(DataFilter::cleanString($result->FahrenheitToCelsiusResult));
					$o_consulta->setRequisicaoTipo('Fahrenhet');
					echo "<script>alert('Temperatura resultado $result->FahrenheitToCelsiusResult')</script>";
				}else{
					$o_consulta->setRespostaTemperatura(DataFilter::cleanString($result->CelsiusToFahrenheitResult));
					$o_consulta->setRequisicaoTipo('Celsius');
					echo "<script>alert('Temperatura resultado $result->CelsiusToFahrenheitResult')</script>";
					
				}
				$o_consulta->setRequisicaoTemperatura(DataFilter::cleanString($_REQUEST['valor_consulta']));
				
				$o_consulta->setIp(DataFilter::cleanString(ConsultaController::getIp()));
				
				
			
				$o_consulta->setXmlGerado(serialize($result));
				
				
				
				$o_consulta->save();
				
				
				
				
				
				
			}else{
				echo "<script>alert('Valor invalido')</script>";
			}
			$v_consultas = $o_consulta->_list();
		
			//definindo qual o arquivo HTML que será usado para
			//mostrar a lista de consulta
			$o_view = new View('views/listarConsulta.phtml');
			
			//Passando os dados da consulta para a View
			$o_view->setParams(array('v_consultas' => $v_consultas));
			
			//Imprimindo código HTML
			$o_view->showContents();
			
	}
	
	//Pega o ip do clientes
	public function getIp()
	{
	 
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
	 
			$ip = $_SERVER['HTTP_CLIENT_IP'];
	 
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
	 
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	 
		}
		else{
	 
			$ip = $_SERVER['REMOTE_ADDR'];
	 
		}
	 
		return $ip;
	 
	}
}
?>