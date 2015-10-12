<?php

namespace Pjpl\SimaticServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\SimaticServerBundle\S7\Common\ResponseCode;
use Pjpl\SimaticServerBundle\S7\Common\ConstProcess;

/**
 * @Route("/simatic-server", name="simatic_server")
 */
class SimaticServerController extends Controller
{
	/**
	 * Podstawowe informacje o SimaticServer
	 * @Route("/", name="simatic_server")
	 * @Route("/index", name="simatic_server_index")
	 */
	public function indexAction(){

		$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
		$socket_connect = socket_connect($socket, "192.168.1.101", 9000);


		$commandCode = CommandCode::Q_SET_BYTE_short; //
		$processId = ConstProcess::PROCESS1_ID_byte; // Process1
		$addr = 0;
		$val = 1;

		$command = new \Pjpl\SimaticServerBundle\Command\Q_SetByte($processId, $addr, $val, $socket);
		$response = $command->action();
		echo "response ".get_class($response)."<br>";
		return $this->render('PjplSimaticServerBundle:SimaticServer:index.html.twig');
	}

}
