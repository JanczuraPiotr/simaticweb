<?php
namespace Pjpl\ScadaBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Pjpl\SimaticServerBundle\Command\CommandRaportFull;
use Pjpl\SimaticServerBundle\S7\Common\ConstProcess;
use Pjpl\SimaticServerBundle\Process\Variables;
/**
 * @todo Description of AjaxController
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class AjaxController extends Controller{

	public function setPortAction(Request $request){
//		$ip = $this->container->getParameter('simatic_server')['ip'];
//		$port = $this->container->getParameter('simatic_server')['port'];
//		$timeout_sek = $this->container->getParameter('simatic_server')['timeout_sek'];
//		$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
//		socket_set_option($socket,SOL_SOCKET, SO_RCVTIMEO, array("sec"=>$timeout_sek, "usec"=>0));
//		$socket_connect = socket_connect($socket, $ip , $port);
//		$processId = ConstProcess::PROCESS1_ID_byte;

		$request = $this->container->get('request');
		$port = $request->query->get('port');
		$bit = $request->query->get('bit');
		$onOff = $request->get('onOff');

		$json = [
				'port' => $port,
				'bit' => $bit,
				'onOff' => $onOff
		];

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		return new Response($json ,200, ['Content-Type'=>'application/json']);
	}

	public function raportAction(Request $request){

		$ip = $this->container->getParameter('simatic_server')['ip'];
		$port = $this->container->getParameter('simatic_server')['port'];
		$timeout_sek = $this->container->getParameter('simatic_server')['timeout_sek'];
		$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
		socket_set_option($socket,SOL_SOCKET, SO_RCVTIMEO, array("sec"=>$timeout_sek, "usec"=>0));
		$socket_connect = socket_connect($socket, $ip , $port);
		$processId = ConstProcess::PROCESS1_ID_byte;

		$command = new CommandRaportFull($processId, $socket);
		$responseObject = $command->action();
		$variables = new Variables(['raport'=> $responseObject]);
		$json = [
				'D' => [
						'Byte' => $variables->D_getZmienna0(),
						'Int' => $variables->D_getZmienna1(),
						'DInt' => $variables->D_getZmienna2(),
						'Real' => $variables->D_getZmienna3(),
				],
				'I' => [
						0 => [
								0 => $variables->get_I_0_0(),
								1 => $variables->get_I_0_1(),
								2 => $variables->get_I_0_2(),
								3 => $variables->get_I_0_3(),
								4 => $variables->get_I_0_4(),
								5 => $variables->get_I_0_5(),
								6 => $variables->get_I_0_6(),
								7 => $variables->get_I_0_7(),
						]
				],
				'Q' => [
						0 => [
								0 => $variables->get_Q_0_0(),
								1 => $variables->get_Q_0_1(),
								2 => $variables->get_Q_0_2(),
								3 => $variables->get_Q_0_3(),
								4 => $variables->get_Q_0_4(),
								5 => $variables->get_Q_0_5(),
						]
				]
		];
		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		return new Response($json ,200, ['Content-Type'=>'application/json']);
	}
}
