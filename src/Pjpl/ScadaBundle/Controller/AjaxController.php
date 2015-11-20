<?php
namespace Pjpl\ScadaBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Pjpl\SimaticServerBundle\Command\BitSwitch;
use Pjpl\SimaticServerBundle\Command\CommandRaportFull;
use Pjpl\SimaticServerBundle\S7\Common\ConstProcess;
use Pjpl\SimaticServerBundle\Process\VariablesRaport;
use Pjpl\SimaticServerBundle\S7\Common\TypeCode;
/**
 * @todo Description of AjaxController
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class AjaxController extends Controller{


	public function setDAction(Request $request){
		$processId = ConstProcess::PROCESS1_ID_byte;
		$simaticServerSocket = $this->get('simatic_server_socket');
		$socket = $simaticServerSocket->getSocket();

		$request = $this->container->get('request');
		$memType = $request->query->get('memType');
		$varType = $request->query->get('varType');
		$varCode = (int)$request->query->get('varCode');
		$varVal = $request->query->get('varVal');
		$onOff = $request->get('onOff');

		$json = [
				'memType' => $memType,
				'varCode' => $varCode,
				'varVal'  => $varVal,
		];

		switch ($varType){
			case TypeCode::BYTE:
				$command = new \Pjpl\SimaticServerBundle\Command\D_SetByte($processId, $varCode, $varVal, $socket);
				$responseObject = $command->action();
				break;
			case TypeCode::INT:
				$command = new \Pjpl\SimaticServerBundle\Command\D_SetInt($processId, $varCode, $varVal, $socket);
				$responseObject = $command->action();
				break;
			case TypeCode::DINT:
				$command = new \Pjpl\SimaticServerBundle\Command\D_SetDInt($processId, $varCode, $varVal, $socket);
				$responseObject = $command->action();
				break;
			case TypeCode::REAL:
				$command = new \Pjpl\SimaticServerBundle\Command\D_SetReal($processId, $varCode, $varVal, $socket);
				$responseObject = $command->action();
				break;
		}

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		return new Response($json ,200, ['Content-Type'=>'application/json']);
	}

	public function switchPortAction(Request $request){
		$processId = ConstProcess::PROCESS1_ID_byte;

		$request = $this->container->get('request');
		$memType = $request->query->get('memType');
		$varCode = $request->query->get('varCode');
		$bit = $request->query->get('bit');
		$onOff = $request->get('onOff');

		$json = [
				'memType' => $memType,
				'varCode' => $varCode,
				'bit' => $bit,
		];

		$socket = $this->get('simatic_server_socket')->getSocket();
		$command = new BitSwitch($processId, $memType, $varCode, $bit, $socket);
		$responseObject = $command->action();

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		return new Response($json ,200, ['Content-Type'=>'application/json']);
	}

	public function setPortAction(Request $request){
		$port = $request->query->get('port');
		$bit = $request->query->get('bit');
		$onOff = $request->get('onOff');

		// @prace akcja nie wysyła komendy do servera

		$arr = [
				'port' => $port,
				'bit' => $bit,
				'onOff' => $onOff
		];

		$json = json_encode($arr, JSON_UNESCAPED_UNICODE);
		return new Response($json, 200, ['Content-Type'=>'application/json']);
	}

	public function raportAction(Request $request){
		$processId = ConstProcess::PROCESS1_ID_byte;

		$simaticServerSocket = $this->get('simatic_server_socket');
		$command = new CommandRaportFull($processId, $simaticServerSocket->getSocket());
		$responseObject = $command->action();

		$variables = new VariablesRaport(['raport'=> $responseObject]);
		$json = [
				'D' => [
						'Byte' => $variables->D_getZmiennaByte(),
						'Int' => $variables->D_getZmiennaInt(),
						'DInt' => $variables->D_getZmiennaDInt(),
						'Real' => $variables->D_getZmiennaReal(),
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
