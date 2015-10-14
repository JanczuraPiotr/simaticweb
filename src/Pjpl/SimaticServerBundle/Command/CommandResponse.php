<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;

/**
 * Odpowiedź nadesłana z SimaticServer w odpowiedzi na komendę.
 *
 * Nagłówek bufora - stała zawartość dla każdego pochodnego CommandResponse
 * buff[0] identyfikator procesu który wygenerował odpowiedź
 *		jeżeli 0x00 < buff[0] < 0xFF identyfikator procesu do którego skierowana jest konenda
 *				buff[1..2] kod komendy
 *		jeżeli 0x00 = buff[0] - komenda dotyczy SimaticServer
 *		jeżeli 0xff = buff[0] - komenda dotyczy Klienta. Nie jest tym samym co odpowiedź na komendę.
 * buff[1..2] kod komendy która była obsługiwana przez process
 * buff[3..5] kod odpowiedzi z jaką zakończyła się praca komendy na którą wygenerowano tą odpowiedź
 * jeżeli buff[3..5] == 0x0000 odpowiedź negatywna na komendę wymagającą tylko potwierdzenia lub niepowodzenie komendy
 * jeżeli buff[3..5] == 0xFFFF odpowiedź tak na komendę wymagającą tylko potwierdzenia
 * jeżeli 0x0000 < buff[3..5] < 0xFFFF specyficzna odpowiedź od której mogą zależeć pozostałe parametry bufora.
 * W zależności od klasy pochodnej mogą być dołączane kolejne parametry definiowane w klasach pochodnych
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
abstract class CommandResponse {
	/**
	 * @param resource $socket Gniazdo do SimaticServer
	 * @param string $responseStream Strumień odebrany z SimaticServer
	 * @param byte $processId identyfikator proces zwracającego komendę
	 * @param short $commandCode Kod komendy która zwróciła odpowiedź
	 * @param short $responseCode Kod zwróconej odpowiedzi.
	 */
	public function __construct($socket, $responseStream, $processId, $commandCode, $responseCode) {
		$this->socket = $socket;
		$this->responseStream = $responseStream;
		$this->processId = $processId;
		$this->commandCode = $commandCode;
		$this->responseCode = $responseCode;
		$this->init();
	}
	/**
	 * Gnizado do SimaticServer
	 * @return socket
	 */
	public function getSocket(){
		return $this->socket;
	}
	/**
	 * Strumień odebrany z SimaticServer
	 * @return string
	 */
	public function getResponseStream(){
		return $this->responseStream;
	}
	/**
	 * Identyfikator procesu który odesłał odpowiedź
	 * @return byte
	 */
	public function getProcessId(){
		return $this->processId;
	}
	/**
	 * Kod komendy która zwróciła odpowiedź
	 * @return short
	 */
	public function getCommandCode(){
		return $this->commandCode;
	}
	/**
	 * Kod zwróconej odpowiedzi.
	 * @return short
	 */
	public function getResponseCode(){
		return $this->responseCode;
	}
	/**
	 * Metoda musi być tak napisana by utworzyć indywidualne dla klasy pochodnej atrybuty odpowiedzi.
	 * Parsowanie rozpoczyna się od piątej pozycji bufora ponieważ pierwsza część została sparsowana przez
	 * CommandResponseBuilder
	 */
	protected abstract function parseResponseStream();
	protected function init(){
		$this->parseResponseStream();
	}

	/**
	 * Gnizado do SimaticServer
	 * @var resource
	 */
	private $socket;
	/**
	 * String zwrócony z SimaticServer jako zrzut attrybutów odpowiedzi.
	 * @var string
	 */
	private $responseStream;
	/**
	 * Identyfikator procesu który odesłał odpowiedź
	 * @var byte
	 */
	private $processId;
	/**
	 * Kod komendy która zwróciła odpowiedź
	 * @var short
	 */
	private $commandCode;
	/**
	 * Kod zwróconej odpowiedzi.
	 * @var short
	 */
	private $responseCode;
}
