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

		$code = 0x1000;
		echo "code   = " . $code ." jako hex = ". sprintf("%02X", $code)."<br>";
		$pomiar = 123.34;
		echo "pomiar dziesiętnie = " . $pomiar ." jako hex = " .  sprintf("%02X", $pomiar). "<br>";

		$packCode  = pack("s*",$code);
		$packPomiar = pack("f*",$pomiar);
		$strOut = $packCode.$packPomiar;
		var_dump($packPomiar);
		socket_write($socket, $strOut);

		echo "arrOut : <br>";
		echo sprintf("%02X", ( ord( substr($strOut, 0, 1 ) ))) ."<br>";
		echo sprintf("%02X", ( ord( substr($strOut, 1, 1 ) ))) ."<br>";
		echo sprintf("%02X", ( ord( substr($strOut, 2, 1 ) ))) ."<br>";
		echo sprintf("%02X", ( ord( substr($strOut, 3, 1 ) ))) ."<br>";
		echo sprintf("%02X", ( ord( substr($strOut, 4, 1 ) ))) ."<br>";
		echo sprintf("%02X", ( ord( substr($strOut, 5, 1 ) ))) ."<br>";

		return $this->render('PjplSimaticServerBundle:SimaticServer:index.html.twig');
	}
}
