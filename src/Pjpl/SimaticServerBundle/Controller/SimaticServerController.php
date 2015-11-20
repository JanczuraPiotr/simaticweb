<?php

namespace Pjpl\SimaticServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\SimaticServerBundle\S7\Common\ConstProcess;
use Symfony\Component\HttpFoundation\Response;


class SimaticServerController extends Controller
{
	public function indexAction(){
		$processId = ConstProcess::PROCESS1_ID_byte;
		$simaticServerSocket = $this->get('simatic_server_socket');
		$socket = $simaticServerSocket->getSocket();

		$commandCode = CommandCode::Q_SET_BYTE_short; //
		$processId = ConstProcess::PROCESS1_ID_byte; // Process1
		$addr = 0;

		$command = new \Pjpl\SimaticServerBundle\Command\Q_GetByte($processId, $addr, $socket);
		$response = $command->action();

		$json = json_encode(
				[
						'status' => 'OK',
						'klasa odpowiedzi' => get_class($response)
				]
				, JSON_PRETTY_PRINT
		);
		return new Response($json, 200, ['Content-Type'=>'application/json']);
	}

}
