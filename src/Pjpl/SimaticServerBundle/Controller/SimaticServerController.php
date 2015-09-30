<?php

namespace Pjpl\SimaticServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Pjpl\lib\BigEndian;
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
		$socket_connect = socket_connect($socket, "192.168.1.103", 9000);

		$commandCode = CommandCode::SET_Q_BYTE_short; //
		$processId = ConstProcess::PROCESS1_ID_byte; // Process1
		$addr = 0;
		$val = 1;

		$packCommandCode = BigEndian::shortToPack($commandCode);
		$packProcessId = BigEndian::byteToPack($processId);
		$packAddr = BigEndian::shortToPack($addr);
		$packVal = BigEndian::byteToPack($val);


		$pack = $packCommandCode.$packProcessId.$packAddr.$packVal;

		socket_write($socket, $pack);
		$response = socket_read($socket, 1000);

		echo '//------------------------------------------------------------------------------<br>';
		echo 'odpowiedć z SimaticServer<br>';


		$processId = BigEndian::byteFromPack(substr($response, 0, 1));
		if($processId > 0 ){
			$commandCode = BigEndian::shortFromPack(substr($response, 1,2));
			$responseCode = BigEndian::shortFromPack(substr($response,3,2));
			echo sprintf("commandCode = 0x%04X <br>",$commandCode);
			echo sprintf("responseCode = 0x%04X <br>",$responseCode);
			$responseVal;

			switch ($responseCode){
				case ResponseCode::OK_short:
					echo sprintf("wykonanno komendę : 0x%04X <br>",$commandCode);
					echo "resposeCode = OK<br>";
					break;
				case ResponseCode::NO_short:
					echo sprintf("wykonanno komendę : 0x%04X <br>",$commandCode);
					echo "resposeCode = NO<br>";
					break;
				case ResponseCode::RETURN_BUFF_short:
//					$responseVal = BigEndian::byteFromPack(substr($response,5,1));
//					echo sprintf("wykonanno komendę : 0x%04X <br>",$commandCode);
//					echo "resposeCode = ".sprintf("0x%04X",$responseCode)."<br>";
//					echo "addr = ".sprintf("0x%04X",$addr)."<br>";
//					echo "responseVal = ".sprintf("0x%04X",$responseVal)."<br>";
					break;
				case ResponseCode::RETURN_BYTE_short :
					$responseVal = BigEndian::byteFromPack(substr($response,5,1));
					echo sprintf("wykonanno komendę : 0x%04X <br>",$commandCode);
					echo "resposeCode = ".sprintf("0x%04X",$responseCode)."<br>";
					echo "addr = ".sprintf("0x%04X",$addr)."<br>";
					echo "responseVal = ".sprintf("0x%04X",$responseVal)."<br>";
					break;
				case ResponseCode::RETURN_INT_short :
					$responseVal = BigEndian::shortFromPack(substr($response,5,2));
					echo sprintf("wykonanno komendę : 0x%04X <br>",$commandCode);
					echo "resposeCode = ".sprintf("0x%04X",$responseCode)."<br>";
					echo "addr = ".sprintf("0x%04X",$addr)."<br>";
					echo "responseVal = ".sprintf("0x%04X",$responseVal)."<br>";
					break;
				case ResponseCode::RETURN_DINT_short   :
					$responseVal = BigEndian::intFromPack(substr($response,5,4));
					echo sprintf("wykonanno komendę : 0x%04X <br>",$commandCode);
					echo "resposeCode = ".sprintf("0x%04X",$responseCode)."<br>";
					echo "addr = ".sprintf("0x%04X",$addr)."<br>";
					echo "responseVal = ".sprintf("0x%04X",$responseVal)."<br>";
					break;
//				case ResponseCode::RETURN_LONG_short  :
//					$responseVal = BigEndian::byteFromPack(substr($response,5,1));
//					echo sprintf("wykonanno komendę : 0x%04X <br>",$commandCode);
//					echo "resposeCode = ".sprintf("0x%04X",$responseCode)."<br>";
//					echo "addr = ".sprintf("0x%04X",$addr)."<br>";
//					echo "responseVal = ".sprintf("0x%04X",$responseVal)."<br>";
//					break;
				case ResponseCode::RETURN_REAL_short :
					$responseVal = BigEndian::floatFromPack(substr($response,5,4));
					echo sprintf("wykonanno komendę : 0x%04X <br>",$commandCode);
					echo "resposeCode = ".sprintf("0x%04X",$responseCode)."<br>";
					echo "addr = ".sprintf("0x%04X",$addr)."<br>";
					echo "responseVal = ".sprintf("0x%04X",$responseVal)."<br>";
					break;
//				case ResponseCode::RETURN_LREAL_short:
//					$responseVal = BigEndian::byteFromPack(substr($response,5,1));
//					echo sprintf("wykonanno komendę : 0x%04X <br>",$commandCode);
//					echo "resposeCode = ".sprintf("0x%04X",$responseCode)."<br>";
//					echo "addr = ".sprintf("0x%04X",$addr)."<br>";
//					echo "responseVal = ".sprintf("0x%04X",$responseVal)."<br>";
//					break;

			}
		}else{
			var_dump($response);
		}



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
