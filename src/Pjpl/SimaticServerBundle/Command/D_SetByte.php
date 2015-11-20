<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\lib\BigEndian;
/**
 * @todo Description of D_SetByte
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class D_SetByte extends Command{
	/**
	 * adres zmiennej
	 * @var short
	 */
	private $addr;
	/**
	 * wartość zmiennej
	 * @var byte
	 */
	private $val;

	/**
	 * @param byte $processId identyfikator procesu dla którym ma być wykonana komenda
	 * @param short $addr adres modyfikowanej komórki pamięci
	 * @param byte $val nowa wartość komórki pamięci.
	 * @param socket $socket gniazdo do SimaticServer
	 */
	public function __construct($processId, $addr, $val, $socket) {
		parent::__construct($processId, $socket);
		$this->addr = $addr;
		$this->val = $val;
	}

	protected function buildCommandStream() {
		$this->commandStream
				= BigEndian::shortToPack($this->getCommandCode())
				. BigEndian::byteToPack($this->getProcessId())
				. BigEndian::shortToPack($this->getAddr())
				. BigEndian::byteToPack($this->getVal());
	}

	public function getCommandCode() {
		return CommandCode::D_SET_BYTE_short;
	}

	/**
	 * @return short
	 */
	public function getAddr(){
		return $this->addr;
	}
	/**
	 * @return byte
	 */
	public function getVal(){
		return $this->val;
	}

}
