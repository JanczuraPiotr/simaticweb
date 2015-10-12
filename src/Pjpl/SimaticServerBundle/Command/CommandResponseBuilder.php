<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;
use Pjpl\SimaticServerBundle\S7\Common\ResponseCode;
/**
 * Klasa budująca obiekt opisujący odpowiedź nadesłaną z SimaticServer w odpowiedzi na komendę.

 * @author Piotr Janczura <piotr@janczura.pl>
 */
class CommandResponseBuilder {
	/**
	 * @param resurce $socket gniazdo do SimaticServer
	 * @param string $responseStream odpowiedz nadesłana gniazdem
	 */
	public function __construct($socket,$responseStream) {
		$this->socket = $socket;
		$this->responseStream = $responseStream;
	}

	/**
	 * Parsuje odpowiedź i tworzy atrybuty odpowiednie dla klas pochodnych.
	 * Dostęp do tych atrybutów należy udostępnić poprzez metody getXXX
	 */
	public function build(){
		$this->processId = (int)BigEndian::byteFromPack(substr($this->responseStream, 0, 1));
		$this->commandCode = (int)BigEndian::shortFromPack(substr($this->responseStream, 1, 2));
		$this->responseCode = (int)BigEndian::shortFromPack(substr($this->responseStream, 3, 2));

		switch($this->responseCode){
			case ResponseCode::OK_short:
				$this->responseObject = new ResponseOk(
						$this->socket
						, $this->responseStream
						, $this->processId
						, $this->commandCode
						, $this->responseCode
				);
				break;
			case ResponseCode::NO_short:
				$this->responseObject = new ResponseNo(
						$this->socket
						, $this->responseStream
						, $this->processId
						, $this->commandCode
						, $responseCode
				);
				break;
			case ResponseCode::RETURN_GENERAL_short:
				$this->responseObject = new ResponseGeneral(
						$this->socket
						, $this->responseStream
						, $this->processId
						, $this->commandCode
						, $this->responseCode
				);
				break;
			case ResponseCode::RETURN_BYTE_short:
				$this->responseObject = new ResponseByte(
						$this->socket
						, $this->responseStream
						, $this->processId
						, $this->commandCode
						, $this->responseCode
				);
				break;
			case ResponseCode::RETURN_INT_short:
				$this->responseObject = new ResponseInt(
						$this->socket
						, $this->responseStream
						, $this->processId
						, $this->commandCode
						, $this->responseCode
				);
				break;
			case ResponseCode::RETURN_DINT_short:
				$this->responseObject = new ResponseDInt(
						$this->socket
						, $this->responseStream
						, $this->processId
						, $this->commandCode
						, $this->responseCode
				);
				break;
			case ResponseCode::RETURN_REAL_short:
				$this->responseObject = new ResponseReal(
						$this->socket
						, $this->responseStream
						, $this->processId
						, $this->commandCode
						, $this->responseCode
				);
				break;
			case ResponseCode::RETURN_BUFF_short:
				$this->responseObject = new ResponseBuff(
						$this->socket
						, $this->responseStream
						, $this->processId
						, $this->commandCode
						, $this->responseCode
				);
				break;
			default:
				$this->responseObject = new ResponseGeneral(
						$this->socket
						, $this->responseStream
						, $this->processId
						, $this->commandCode
						, $this->responseCode);
		}

		return $this->responseObject;
	}

	public function getSocket(){
		return $this->socket;
	}
	public function getCommandStream(){
		return $this->responseStream;
	}

	//------------------------------------------------------------------------------

	/**
	 * Identyfikator procesu
	 * @var byte
	 */
	private $processId;
	/**
	 * Kod komendy na którą odebrany strumień jest odpowiedzią
	 * @var short
	 */
	private $commandCode;
	/**
	 * Kod odpebranej odpowiedzi
	 * @var short
	 */
	private $responseCode;
	/**
	 * Obiekt odpowiedzi zbudowany na podstawie $this->responseStream
	 * @var CommandResponse
	 */
	private $responseObject = null;
	/**
	 * Gniazdo do SimaticServer
	 * @var resource
	 */
	private $socket;
	/**
	 * Strumień odebrany z SimaticServer zawierający zrzut atrybutów obiektu będącego odpowiedzią na komendę.
	 * @var string
	 */
	private $responseStream;
}
