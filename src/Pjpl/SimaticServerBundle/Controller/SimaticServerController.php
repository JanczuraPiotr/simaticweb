<?php

namespace Pjpl\SimaticServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\SimaticServerBundle\S7\Common\ConstProcess;
use Symfony\Component\HttpFoundation\Response;


class SimaticServerController extends Controller
{
	public function indexAction(){
		$ip = $this->container->getParameter('simatic_server')['ip'];
		$port = $this->container->getParameter('simatic_server')['port'];
		$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
		$socket_connect = socket_connect($socket, $ip , $port);


		$commandCode = CommandCode::Q_SET_BYTE_short; //
		$processId = ConstProcess::PROCESS1_ID_byte; // Process1
		$addr = 0;
		$val = 13;

		$command = new \Pjpl\SimaticServerBundle\Command\Q_SetByte($processId, $addr, $val, $socket);
		$response = $command->action();

		$json = json_encode(
				[
						'status' => 'OK',
						'klasa odpowiedzi' => get_class($response)
				]
				, JSON_PRETTY_PRINT
		);
		return new Response($json,200, ['Content-Type'=>'application/json']);
	}

}
