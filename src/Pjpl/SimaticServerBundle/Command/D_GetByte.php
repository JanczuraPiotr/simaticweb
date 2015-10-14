<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\lib\BigEndian;

/**
 * @todo Description of D_GetByte
 *
 * @author piotr
 */
class D_GetByte extends Command{

	/**
	 * @param byte $processId identyfikator procesu dla którym ma być wykonana komenda
	 * @param short $addr adres komórki pamięci
	 * @param socket gniazdo do SimaticServer
	 */
	public function __construct($processId, $addr, $socket) {
		parent::__construct($processId, $socket);
		$this->addr = $addr;
	}

	protected function buildCommandStream() {
		$this->commandStream
				= BigEndian::shortToPack($this->getCommandCode())
				. BigEndian::byteToPack($this->getProcessId())
				. BigEndian::shortToPack($this->getAddr());
	}

	public function getCommandCode() {
		return CommandCode::D_GET_BYTE_short;
	}

	public function getAddr(){
		return $this->addr;
	}

	/**
	 * adres komórki pamięci
	 * @var short
	 */
	private $addr;
}