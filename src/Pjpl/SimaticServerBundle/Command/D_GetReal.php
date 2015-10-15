<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\lib\BigEndian;

/**
 * @todo Description of D_GetReal
 *
 * @author piotr
 */
class D_GetReal extends Command{

	/**
	 * @param byte $processId identyfikator procesu dla którym ma być wykonana komenda
	 * @param short $varCode kod zmiennej
	 * @param socket gniazdo do SimaticServer
	 */
	public function __construct($processId, $varCode, $socket) {
		parent::__construct($processId, $socket);
		$this->varCode = $varCode;
	}

	protected function buildCommandStream() {
		$this->commandStream
				= BigEndian::shortToPack($this->getCommandCode())
				. BigEndian::byteToPack($this->getProcessId())
				. BigEndian::shortToPack($this->getVarCode());
	}

	public function getCommandCode() {
		return CommandCode::D_GET_REAL_short;
	}

	public function getVarCode(){
		return $this->varCode;
	}

	/**
	 * adres komórki pamięci
	 * @var float
	 */
	private $varCode;
}