<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\lib\BigEndian;
/**
 * Odczytuje ośmiobitową grupę portów.
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class I_GetByte extends Command{
	/**
	 * @param byte $processId identyfikator procesu dla którym ma być wykonana komenda
	 * @param short $portGroup numer ośmobitowej grupy portów
	 * @param socket $socket gniazdo do SimaticServer
	 */
	public function __construct($processId, $portGroup, $socket) {
		parent::__construct($processId, $socket);
		$this->portGroup = $portGroup;
	}
	public function getPortGroup(){
		return $this->portGroup;
	}

	protected function buildCommandStream() {
		$this->commandStream
				= BigEndian::shortToPack($this->getCommandCode())
				. BigEndian::byteToPack($this->getProcessId())
				. BigEndian::shortToPack($this->getPortGroup());
	}

	public function getCommandCode() {
		return CommandCode::I_GET_BYTE_short;
	}

	/**
	 * numer ośmobitowej grupy portów
	 * @var short
	 */
	private $portGroup;
}
