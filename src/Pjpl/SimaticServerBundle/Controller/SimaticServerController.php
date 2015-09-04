<?php

namespace Pjpl\SimaticServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
	public function indexAction()
	{
		$socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
		$socket_connect = socket_connect($socket, "192.168.1.104", 9999);
		$code = 0xABCD;
		$codeHi = ( 0x0000ff00 & $code ) >> 8;
		$codeLo = ( 0x000000ff & $code );
		echo ("code   = " . $code);
		var_dump(sprintf("code   = %02X", $code));
		var_dump(sprintf("codeLo = %02X", $codeLo));
		var_dump(sprintf("codeHi = %02X", $codeHi));
		$arrOut = [
				chr($codeLo),
				chr($codeHi)
		];
		$strOut = chr($codeLo).chr($codeHi);
		$packOut = pack("c*",$arrOut);

		echo "arrOut<br>";
		var_dump($arrOut);
		echo "packOut<br>";
		var_dump($packOut);
		var_dump(socket_write($socket, $strOut));
		return $this->render('PjplSimaticServerBundle:SimaticServer:index.html.twig');
	}
}
