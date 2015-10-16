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

	public function raportAction(Request $request){

		$ip = $this->container->getParameter('simatic_server')['ip'];
		$port = $this->container->getParameter('simatic_server')['port'];
		$timeout = $this->container->getParameter('simatic_server')['timeout'];
		$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
		$socket_connect = socket_connect($socket, $ip , $port);
		$processId = ConstProcess::PROCESS1_ID_byte;

		$command = new CommandRaportFull($processId, $socket);
		$responseObject = $command->action();
		$variables = new Variables(['raport'=> $responseObject]);
		$json = [
				'zmienna_0' => $variables->D_getZmienna0(),
				'zmienna_1' => $variables->D_getZmienna1(),
				'zmienna_2' => $variables->D_getZmienna2(),
				'zmienna_3' => $variables->D_getZmienna3(),
				'wejście_0' => $variables->I_getInput0(),
				'wyjście_0' => $variables->Q_getOutput0()
		];
		$json = json_encode($json);
		return new Response($json ,200, ['Content-Type'=>'application/json']);
	}
}
