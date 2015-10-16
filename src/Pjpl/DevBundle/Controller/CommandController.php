<?php
namespace Pjpl\DevBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Pjpl\SimaticServerBundle\Command\I_GetByte;
use Pjpl\SimaticServerBundle\Command\Q_GetByte;
use Pjpl\SimaticServerBundle\Command\Q_SetByte;
use Pjpl\SimaticServerBundle\Command\D_GetByte;
use Pjpl\SimaticServerBundle\Command\D_SetByte;
use Pjpl\SimaticServerBundle\Command\D_GetInt;
use Pjpl\SimaticServerBundle\Command\D_SetInt;
use Pjpl\SimaticServerBundle\Command\D_GetDInt;
use Pjpl\SimaticServerBundle\Command\D_SetDInt;
use Pjpl\SimaticServerBundle\Command\D_GetReal;
use Pjpl\SimaticServerBundle\Command\D_SetReal;
use Pjpl\SimaticServerBundle\S7\Common\ResponseCode;
use Pjpl\SimaticServerBundle\S7\Common\ConstProcess;
use Pjpl\SimaticServerBundle\S7\Common\VarCode;
use Pjpl\SimaticServerBundle\Command\CommandRaportFull;
use Pjpl\SimaticServerBundle\Process\Variables;

/**
 * @todo Description of CommandController
 *
 * @author piotr
 */
class CommandController extends Controller{

	public function indexAction(){
		return $this->render('PjplDevBundle:Command:index.html.twig');
	}


	public function iGetByteAction(Request $request){
		$ip = $this->container->getParameter('simatic_server')['ip'];
		$port = $this->container->getParameter('simatic_server')['port'];
		$timeout = $this->container->getParameter('simatic_server')['timeout'];
		$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
		$socket_connect = socket_connect($socket, $ip , $port);

		$response = [];
		$portGroupNr;
		$form = $this->createFormBuilder();
		$form->add('portGroupNr', 'integer',[
				'label' => 'numer grupy portów'
		]);
//		$form->add('processId','integer',[
//			'label' => 'identyfikator procesu'
//		]);
		$form->add('pobierz', 'submit');
		$form = $form->getForm();

		$form->handleRequest($request);
		if( $form->isValid()){
			$processId = 1;//$form->get('processId')->getData();
			$portGroupNr = $form->get('portGroupNr')->getData();
			$command = new I_GetByte($processId, $portGroupNr, $socket);
			$responseObject = $command->action();
			switch($responseObject->getResponseCode()){
				case ResponseCode::RETURN_BYTE_short:
					$response = sprintf("0x%02X", $responseObject->getByte());
					break;
				case ResponseCode::OK_short:
					break;
				case ResponseCode::NO_short:
					break;
				default:

			}
		}else{

		}

		return $this->render('PjplDevBundle:Command:i-get-byte.html.twig', ['form' => $form->createView(), 'response' => $response]);
	}
	public function qGetByteAction(){

		$ip = $this->container->getParameter('simatic_server')['ip'];
		$port = $this->container->getParameter('simatic_server')['port'];
		$timeout = $this->container->getParameter('simatic_server')['timeout'];
		$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
		$socket_connect = socket_connect($socket, $ip , $port);

		$processId = ConstProcess::PROCESS1_ID_byte;
		$varId = VarCode::ZMIENNA_BYTE;
		$command = new Q_GetByte($processId, $varId, $socket);
		$responseObject = $command->action();

		switch($responseObject->getResponseCode()){
			case ResponseCode::RETURN_BYTE_short:
				$response = $responseObject->getByte();
				break;
			case ResponseCode::OK_short:
				break;
			case ResponseCode::NO_short:
				break;
			default:
		}

		$response = sprintf("0x%02X",$response);
		return $this->render('PjplDevBundle:Command:q-get-byte.html.twig',['response' => $response]);
	}
	public function qSetByteAction(Request $request){

		$response = null;
		$form = $this->createFormBuilder();
		$form->add('portAddr','integer',[
				'label' => 'adres portu'
		]);
		$form->add('portVal', 'integer',[
				'label' => 'wartość portu'
		]);
		$form->add('ustaw', 'submit');
		$form = $form->getForm();

		$form->handleRequest($request);

		if( $form->isValid()){
			$ip = $this->container->getParameter('simatic_server')['ip'];
			$port = $this->container->getParameter('simatic_server')['port'];
			$timeout = $this->container->getParameter('simatic_server')['timeout'];
			$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
			$socket_connect = socket_connect($socket, $ip , $port);
			$processId = ConstProcess::PROCESS1_ID_byte;

			$portAddr = $form->get('portAddr')->getData();
			$portVal = $form->get('portVal')->getData();
			$command = new Q_SetByte($processId, $portAddr, $portVal, $socket);
			$responseObject = $command->action();
			switch($responseObject->getResponseCode()){
				case ResponseCode::RETURN_BYTE_short:
					$response = sprintf("0x%02X", $responseObject->getByte());
					break;
				case ResponseCode::OK_short:
					break;
				case ResponseCode::NO_short:
					break;
				default:

			}
		}else{

		}

		return $this->render('PjplDevBundle:Command:q-set-byte.html.twig', ['form' => $form->createView(), 'response' => $response]);
	}
	public function dGetByteAction(Request $request){
		$response = null;
		$form = $this->createFormBuilder();
		$form->add('varCode','integer',[
				'label' => 'adres '
		]);
		$form->add('pobierz', 'submit');
		$form = $form->getForm();

		$form->handleRequest($request);

		if( $form->isValid()){
			$ip = $this->container->getParameter('simatic_server')['ip'];
			$port = $this->container->getParameter('simatic_server')['port'];
			$timeout = $this->container->getParameter('simatic_server')['timeout'];
			$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
			$socket_connect = socket_connect($socket, $ip , $port);
			$processId = ConstProcess::PROCESS1_ID_byte;

			$varCode = $form->get('varCode')->getData();
			$command = new D_GetByte($processId, $varCode, $socket);
			$responseObject = $command->action();
			switch($responseObject->getResponseCode()){
				case ResponseCode::RETURN_BYTE_short:
					$response = sprintf("0x%02X", $responseObject->getByte());
					break;
				case ResponseCode::OK_short:
					break;
				case ResponseCode::NO_short:
					break;
				default:

			}
		}
		return $this->render('PjplDevBundle:Command:d-get-byte.html.twig', ['form' => $form->createView(), 'response' => $response]);
	}
	public function dSetByteAction(Request $request){
		$response = null;
		$form = $this->createFormBuilder();
		$form->add('varCode','integer',[
				'label' => 'adres '
		]);
		$form->add('varVal', 'integer',[
				'label' => 'wartość'
		]);
		$form->add('zapisz', 'submit');
		$form = $form->getForm();

		$form->handleRequest($request);

		if( $form->isValid()){

			$ip = $this->container->getParameter('simatic_server')['ip'];
			$port = $this->container->getParameter('simatic_server')['port'];
			$timeout = $this->container->getParameter('simatic_server')['timeout'];
			$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
			$socket_connect = socket_connect($socket, $ip , $port);
			$processId = ConstProcess::PROCESS1_ID_byte;

			$varCode = $form->get('varCode')->getData();
			$varVal = $form->get('varVal')->getData();
			$command = new D_SetByte($processId, $varCode, $varVal, $socket);
			$responseObject = $command->action();
			switch($responseObject->getResponseCode()){
				case ResponseCode::RETURN_BYTE_short:
					$response = sprintf("0x%02X", $responseObject->getByte());
					break;
				case ResponseCode::OK_short:
					break;
				case ResponseCode::NO_short:
					break;
				default:

			}
		}
		return $this->render('PjplDevBundle:Command:d-set-byte.html.twig', ['form' => $form->createView(), 'response' => $response]);
	}
	public function dGetIntAction(Request $request){
		$response = null;
		$form = $this->createFormBuilder();
		$form->add('varCode','integer',[
				'label' => 'kod zmiennej '
		]);
		$form->add('pobierz', 'submit');
		$form = $form->getForm();

		$form->handleRequest($request);

		if( $form->isValid()){
			$ip = $this->container->getParameter('simatic_server')['ip'];
			$port = $this->container->getParameter('simatic_server')['port'];
			$timeout = $this->container->getParameter('simatic_server')['timeout'];
			$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
			$socket_connect = socket_connect($socket, $ip , $port);
			$processId = ConstProcess::PROCESS1_ID_byte;

			$varCode = $form->get('varCode')->getData();
			$command = new D_GetInt($processId, $varCode, $socket);
			$responseObject = $command->action();
			switch($responseObject->getResponseCode()){
				case ResponseCode::RETURN_INT_short:
					$response = sprintf("0x%04X", $responseObject->getInt());
					break;
				case ResponseCode::OK_short:
					break;
				case ResponseCode::NO_short:
					break;
				default:

			}
		}
		return $this->render('PjplDevBundle:Command:d-get-int.html.twig', ['form' => $form->createView(), 'response' => $response]);
	}
	public function dSetIntAction(Request $request){
		$response = null;
		$form = $this->createFormBuilder();
		$form->add('varCode','integer',[
				'label' => 'kod zmiennej '
		]);
		$form->add('varVal', 'integer',[
				'label' => 'wartość'
		]);
		$form->add('zapisz', 'submit');
		$form = $form->getForm();

		$form->handleRequest($request);

		if( $form->isValid()){

			$ip = $this->container->getParameter('simatic_server')['ip'];
			$port = $this->container->getParameter('simatic_server')['port'];
			$timeout = $this->container->getParameter('simatic_server')['timeout'];
			$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
			$socket_connect = socket_connect($socket, $ip , $port);
			$processId = ConstProcess::PROCESS1_ID_byte;

			$varCode = $form->get('varCode')->getData();
			$varVal = $form->get('varVal')->getData();
			$command = new D_SetInt($processId, $varCode, $varVal, $socket);
			$responseObject = $command->action();
			switch($responseObject->getResponseCode()){
				case ResponseCode::RETURN_BYTE_short:
					$response = sprintf("0x%02X", $responseObject->getByte());
					break;
				case ResponseCode::OK_short:
					break;
				case ResponseCode::NO_short:
					break;
				default:

			}
		}
		return $this->render('PjplDevBundle:Command:d-set-int.html.twig', ['form' => $form->createView(), 'response' => $response]);
	}
	public function dGetDIntAction(Request $request){
		$response = null;
		$form = $this->createFormBuilder();
		$form->add('varCode','integer',[
				'label' => 'kod zmiennej '
		]);
		$form->add('pobierz', 'submit');
		$form = $form->getForm();

		$form->handleRequest($request);

		if( $form->isValid()){
			$ip = $this->container->getParameter('simatic_server')['ip'];
			$port = $this->container->getParameter('simatic_server')['port'];
			$timeout = $this->container->getParameter('simatic_server')['timeout'];
			$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
			$socket_connect = socket_connect($socket, $ip , $port);
			$processId = ConstProcess::PROCESS1_ID_byte;

			$varCode = $form->get('varCode')->getData();
			$command = new D_GetDInt($processId, $varCode, $socket);
			$responseObject = $command->action();
			switch($responseObject->getResponseCode()){
				case ResponseCode::RETURN_DINT_short:
					$response = sprintf("0x%08X", $responseObject->getDInt());
					break;
				case ResponseCode::OK_short:
					break;
				case ResponseCode::NO_short:
					break;
				default:

			}
		}
		return $this->render('PjplDevBundle:Command:d-get-dint.html.twig', ['form' => $form->createView(), 'response' => $response]);
	}
	public function dSetDIntAction(Request $request){
		$response = null;
		$form = $this->createFormBuilder();
		$form->add('varCode','integer',[
				'label' => 'kod zmiennej '
		]);
		$form->add('varVal', 'integer',[
				'label' => 'wartość'
		]);
		$form->add('zapisz', 'submit');
		$form = $form->getForm();

		$form->handleRequest($request);

		if( $form->isValid()){

			$ip = $this->container->getParameter('simatic_server')['ip'];
			$port = $this->container->getParameter('simatic_server')['port'];
			$timeout = $this->container->getParameter('simatic_server')['timeout'];
			$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
			$socket_connect = socket_connect($socket, $ip , $port);
			$processId = ConstProcess::PROCESS1_ID_byte;

			$varCode = $form->get('varCode')->getData();
			$varVal = $form->get('varVal')->getData();
			$command = new D_SetDInt($processId, $varCode, $varVal, $socket);
			$responseObject = $command->action();
			switch($responseObject->getResponseCode()){
				case ResponseCode::RETURN_BYTE_short:
					$response = sprintf("0x%02X", $responseObject->getByte());
					break;
				case ResponseCode::OK_short:
					break;
				case ResponseCode::NO_short:
					break;
				default:

			}
		}
		return $this->render('PjplDevBundle:Command:d-set-dint.html.twig', ['form' => $form->createView(), 'response' => $response]);
	}
	public function dGetRealAction(Request $request){
		$response = null;
		$form = $this->createFormBuilder();
		$form->add('varCode','integer',[
				'label' => 'kod zmiennej '
		]);
		$form->add('pobierz', 'submit');
		$form = $form->getForm();

		$form->handleRequest($request);

		if( $form->isValid()){
			$ip = $this->container->getParameter('simatic_server')['ip'];
			$port = $this->container->getParameter('simatic_server')['port'];
			$timeout = $this->container->getParameter('simatic_server')['timeout'];
			$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
			$socket_connect = socket_connect($socket, $ip , $port);
			$processId = ConstProcess::PROCESS1_ID_byte;

			$varCode = $form->get('varCode')->getData();
			$command = new D_GetReal($processId, $varCode, $socket);
			$responseObject = $command->action();
			switch($responseObject->getResponseCode()){
				case ResponseCode::RETURN_REAL_short:
					$response =  $responseObject->getReal();
					break;
				case ResponseCode::OK_short:
					break;
				case ResponseCode::NO_short:
					break;
				default:

			}
		}
		return $this->render('PjplDevBundle:Command:d-get-real.html.twig', ['form' => $form->createView(), 'response' => $response]);
	}
	public function dSetRealAction(Request $request){
		$response = null;
		$form = $this->createFormBuilder();
		$form->add('varCode','integer',[
				'label' => 'kod zmiennej '
		]);
		$form->add('varVal', 'number',[
				'label' => 'wartość'
		]);
		$form->add('zapisz', 'submit');
		$form = $form->getForm();

		$form->handleRequest($request);

		if( $form->isValid()){

			$ip = $this->container->getParameter('simatic_server')['ip'];
			$port = $this->container->getParameter('simatic_server')['port'];
			$timeout = $this->container->getParameter('simatic_server')['timeout'];
			$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
			$socket_connect = socket_connect($socket, $ip , $port);
			$processId = ConstProcess::PROCESS1_ID_byte;

			$varCode = $form->get('varCode')->getData();
			$varVal = $form->get('varVal')->getData();
			$command = new D_SetReal($processId, $varCode, $varVal, $socket);
			$responseObject = $command->action();
			switch($responseObject->getResponseCode()){
				case ResponseCode::RETURN_BYTE_short:
					$response = sprintf("0x%02X", $responseObject->getByte());
					break;
				case ResponseCode::OK_short:
					break;
				case ResponseCode::NO_short:
					break;
				default:

			}
		}
		return $this->render('PjplDevBundle:Command:d-set-real.html.twig', ['form' => $form->createView(), 'response' => $response]);

	}
	public function scadaRaportAction(Request $request){
		$ip = $this->container->getParameter('simatic_server')['ip'];
		$port = $this->container->getParameter('simatic_server')['port'];
		$timeout = $this->container->getParameter('simatic_server')['timeout'];
		$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
		$socket_connect = socket_connect($socket, $ip , $port);
		$processId = ConstProcess::PROCESS1_ID_byte;

		$command = new CommandRaportFull($processId, $socket);
		$responseObject = $command->action();
		$variables = new Variables(['raport'=> $responseObject]);
		$raport = [
				'zmienna_0' => $variables->D_getZmienna0(),
				'zmienna_1' => $variables->D_getZmienna1(),
				'zmienna_2' => $variables->D_getZmienna2(),
				'zmienna_3' => $variables->D_getZmienna3(),
				'wejście_0' => $variables->I_getInput0(),
				'wyjście_0' => $variables->Q_getOutput0()
		];
		var_dump($raport);
		return $this->render('PjplDevBundle:Command:scada-raport.html.twig');
	}
}
