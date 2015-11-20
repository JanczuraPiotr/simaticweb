<?php
namespace Pjpl\SimaticServerBundle\Command;
/**
 * Komenda wysyłana do procesu.
 * Na podstawie atrybutów komend pochodnych tworzy strumień bajtowy rzutowany na string.
 *
 * Domyślny format bufora - stała zawartość dla każdego pochodnego Command
 * buff[0]
 * jeżeli 0x00 < buff[0] < 0xFF identyfikator procesu do którego skierowana jest konenda
 *		buff[1..2] kod komendy
 * jeżeli 0x00 = buff[0] - komenda dotyczy SimaticServer
 * jeżeli 0xff = buff[0] - komenda dotyczy Klienta. Nie jest tym samym co odpowiedź na komendę.
 *
 * W zależności od klasy pochodnej mogą być dołączane kolejne parametry definiowane w klasach pochgodnych
 * @author Piotr Janczura <piotr@janczura.pl>
 */
abstract class Command {
	const MAX_SOCKET_RECEIVE = 100000; //!?
	/**
	 * Gniazdo do SimaticServer
	 * @var socket
	 */
	protected $socket;
	/**
	 * String zawierający bufor do którego spakowano atrybuty komendy
	 * @var string
	 */
	protected $commandStream = '';
	/**
	 * String zwrócony z SimaticServer jako zrzut atrybutów odpowiedzi.
	 * @var string
	 */
	protected $responseStream = '';
	/**
	 * Budowniczy obiektu zawierającego odpowiedź na komendę
	 * @var CommandResponseBuilder
	 */
	protected $responseBuilder;
	/**
	 * @var CommandResponse
	 */
	protected $commandResponse;
	/**
	 * Obiekt odpowiedzi zbudowany na podstawie $this->responseStream
	 * @var CommandResponse
	 */
	protected $responseObject;
	/**
	 * Identyfikator procesu, który powinien wykonać komendę
	 * Wartość zmiennej przekazywana jest w parametrach komendy w buforze za kodem Komendy.
	 * @var byte
	 */
	private $processId;

	/**
	 * @param byte processId identyfikator procesu dla którym ma być wykonana komenda
	 * @param socket gniazdo do SimaticServer
	 */
	public function __construct($processId, $socket){
		$this->processId = $processId;
		$this->socket = $socket;
	}
	/**
	 * Zwraca kod komendy obsługiwanej przez obiekt
	 * @return short
	 */
	public abstract function getCommandCode();
	public function getCommandStream(){
		return $this->commandStream;
	}
	/**
	 * @return byte
	 */
	public function getProcessId(){
		return $this->processId;
	}
	/**
	 * Na pamięci przekazanej za pomocą memClip wykonuje zadania opisane w swojej definicji.
	 * @return CommandResponseBuilder
	 */
	public function action(){
		// @todo obsłużyć błędy
		$this->buildCommandStream();
		socket_write($this->socket, $this->getCommandStream());
		$this->responseStream = socket_read($this->socket, static::MAX_SOCKET_RECEIVE);
		$this->responseBuilder = new CommandResponseBuilder($this->socket, $this->responseStream);
		$this->responseObject = $this->responseBuilder->build();
		return $this->responseObject;
	}

	/**
	 * Z atrybutów obiektu pochodnego i $this->processId oraz $this->getCommandCode() buduje responseStream
	 * 		$this->commandStream
	 *			= BigEndian::shortToPack($this->getCommandCode())
	 *			. BigEndian::byteToPack($this->getProcessId())
	 *			. BigEndian::shortToPack($this->getJakasWartosc())
	 *			. BigEndian::byteToPack($this->getJakasKolejnaWartosc());
	 */
	protected abstract function buildCommandStream();

}
