<?php

namespace Pjpl\SimaticServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Pjpl\lib\BigEndian;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
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
		$socket_connect = socket_connect($socket, "192.168.1.103", 9000);

		$commandCode = CommandCode::SET_BYTE_OUT_short; //
		$commandAddr = ConstProcess::PROCESS1_ID_byte; // Process1
		$zmienna_1   = 1072601497; // 0x3fee9999;
		$zmienna_2   =  680053930; // 0x2888ccaa;
		$zmienna_3   =  1239.4309; // 0x449AEDCA;
//		$long   = 0x332ea55528DFE598;

		echo "Code      = ".$commandCode."<br>";
		echo "Addr      = ".$commandAddr."<br>";
		echo "Zmienna_1 = ".$zmienna_1."<br>";
		echo "Zmienna_2 = ".$zmienna_2."<br>";
		echo "Zmienna_3 = ".$zmienna_3."<br>";

		echo sprintf(" Code      = %04X", $commandCode ) ."<br>";
		echo sprintf(" Addr      = %04X", $commandAddr ) ."<br>";
		echo sprintf(" Zmienna_1 = %04X", $zmienna_1 ) ."<br>";
		echo sprintf(" Zmienna_2 = %04X", $zmienna_2 ) ."<br>";
		echo sprintf(" Zmienna_3 = %04X", $zmienna_3 ) ."<br>";


		$packCode = BigEndian::shortToPack($commandCode);
		$packAddr = BigEndian::byteToPack($commandAddr);
		$packZmienna_1 = BigEndian::intToPack($zmienna_1);
		$packZmienna_2 = BigEndian::intToPack($zmienna_2);
		$packZmienna_3 = BigEndian::floatToPack($zmienna_3);
		$pack = $packCode.$packAddr.$packZmienna_1.$packZmienna_2.$packZmienna_3;

//		echo "//------------------------------------------------------------------------------<br>";
//		echo "zmienne jako tabela znaków : <br>";
//		$packLength = strlen($pack);
//		echo '$packLength = '.$packLength."<br>";
//		for( $i = 0 ; $i < $packLength ; $i++ ){
//			echo sprintf("%02X",  ord( substr($pack, $i, 1) ) )."<br>";
//		}

		echo "//------------------------------------------------------------------------------<br>";
		echo "zmienne po rozpakowaniu : <br>";


		$unpackCode = BigEndian::shortFromPack($packCode);
		$unpackAddr = BigEndian::byteFromPack($packAddr);
		$unpackZmienna_1 = BigEndian::intFromPack($packZmienna_1);
		$unpackZmienna_2 = BigEndian::intFromPack($packZmienna_2);
		$unpackZmienna_3 = BigEndian::floatFromPack($packZmienna_3);
		var_dump($packAddr);


		echo "unpackCode = ".$unpackCode."<br>";
		echo "unpackAddr = ".$unpackAddr."<br>";
		echo "unpackZmienna_1 = ".$unpackZmienna_1."<br>";
		echo "unpackZmienna_2 = ".$unpackZmienna_2."<br>";
		echo "unpackZmienna_3 = ".$unpackZmienna_3."<br>";

//		dump($pack);
//		$pack = pack("ssiif", $commandCode, $commandAddr, $zmienna_1, $zmienna_2, $zmienna_3);
		dump($pack);
//		$unpack = unpack("ncommandCode/ncommandAddr/izmienna_1/izmienna_2/fzmienna_3",$pack);
//		var_dump($unpack);

		socket_write($socket, $pack);


		$arr = [1,2,3,4];
		BigEndian::floatToArray(9, $arr,0);
		var_dump(BigEndian::floatFromArray($arr,0));
		var_dump($arr);
		BigEndian::floatToArray($zmienna_3, $arr, 0);
		var_dump($arr);
		$f = BigEndian::floatFromArray($arr,0);
		echo "FLOAT = ".$f."<br>";


//		$code = 0x1000;
//		echo "code   = " . $code ." jako hex = ". sprintf("%02X", $code)."<br>";
//		$pomiar = 123.34;
//		echo "pomiar dziesiętnie = " . $pomiar ." jako hex = " .  sprintf("%02X", $pomiar). "<br>";
//
//		$strOut = pack("cf",$code, $pomiar);
//		var_dump($strOut);
//
//		echo "arrOut : <br>";
//		echo sprintf("%02X", ( ord( substr($strOut, 0, 1 ) ))) ."<br>";
//		echo sprintf("%02X", ( ord( substr($strOut, 1, 1 ) ))) ."<br>";
//		echo sprintf("%02X", ( ord( substr($strOut, 2, 1 ) ))) ."<br>";
//		echo sprintf("%02X", ( ord( substr($strOut, 3, 1 ) ))) ."<br>";
//		echo sprintf("%02X", ( ord( substr($strOut, 4, 1 ) ))) ."<br>";
//		echo sprintf("%02X", ( ord( substr($strOut, 5, 1 ) ))) ."<br>";


//		$mem = [0x00,0x10,0x14,0xAE,0xF6,0x42];
//		dump($this->getRealAt($mem, 2));
//
//		$mem = [0x00,0x00,0x00,0x00,0x00,0x00];
//
//
//		$this->setRealAt($mem, 0, $code);
//		dump($mem);
//
//		echo "packPomiar = ".$packPomiar."<br>";
//		var_dump(unpack("f", $packPomiar));
//		echo "unpack $packPomiar = ".unpack("f", $packPomiar)."<br>";

//		socket_write($socket, $strOut);

		return $this->render('PjplSimaticServerBundle:SimaticServer:index.html.twig');
	}
  public function getRealAt(array $buffer, $pos){
		$intFloat = $this->getDIntAt($buffer, $pos);
		return floatval($intFloat);
	}

	public function setRealAt(array $buffer, $pos, /*float*/$value){

	}
	public function getDIntAt(array $buffer, $pos){
		$result;
		$result =  $buffer[$pos];
		$result <<= 8;
		$result += ($buffer[$pos+1] & 0x0FF);
		$result <<= 8;
		$result += ($buffer[$pos+2] & 0x0FF);
		$result <<= 8;
		$result += ($buffer[$pos+3] & 0x0FF);
		return $result;
	}
}
