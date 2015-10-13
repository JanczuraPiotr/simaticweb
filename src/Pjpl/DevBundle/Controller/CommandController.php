<?php
namespace Pjpl\DevBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Pjpl\SimaticServerBundle\Command\I_GetByte;

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
		// @prace 00 uruchamianie akcji
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
		$form->add('processId','integer',[
			'label' => 'identyfikator procesu'
		]);
		$form->add('pobierz', 'submit');
		$form = $form->getForm();

		$form->handleRequest($request);

		if( $form->isValid()){
//			$processId = $form->get('processId')->getData();
//			$portGroupNr = $form->get('portGroupNr')->getData();
//			$command = new I_GetByte($processId, $portGroupNr, $socket);
//			$resonseObject = $command->action();
//			var_dump($resonseObject);
		}else{

		}

		return $this->render('PjplDevBundle:Command:i-get-byte.html.twig', ['form' => $form->createView(), 'response' => $response]);
	}
	public function qGetByteAction(){
		return $this->render('PjplDevBundle:Command:q-get-byte.html.twig');
	}
	public function qSetByteAction(){
		return $this->render('PjplDevBundle:Command:q-set-byte.html.twig');
	}
	public function dGetByteAction(){
		return $this->render('PjplDevBundle:Command:d-get-byte.html.twig');
	}
	public function dSetByteAction(){
		return $this->render('PjplDevBundle:Command:d-set-byte.html.twig');
	}
	public function dGetIntAction(){
		return $this->render('PjplDevBundle:Command:d-get-int.html.twig');
	}
	public function dSetIntAction(){
		return $this->render('PjplDevBundle:Command:d-set-int.html.twig');
	}
	public function dGetDIntAction(){
		return $this->render('PjplDevBundle:Command:d-get-dint.html.twig');
	}
	public function dSetDIntAction(){
		return $this->render('PjplDevBundle:Command:d-set-dint.html.twig');
	}
	public function dGetRealAction(){
		return $this->render('PjplDevBundle:Command:d-get-real.html.twig');
	}
	public function dSetRealAction(){
		return $this->render('PjplDevBundle:Command:d-set-real.html.twig');

	}
}
