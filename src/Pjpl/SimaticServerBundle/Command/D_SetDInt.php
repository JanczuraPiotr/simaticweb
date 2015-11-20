<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\lib\BigEndian;
/**
 * @todo Description of D_SetDInt
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class D_SetDInt extends Command{
	/**
	 * kod zmiennej zmiennej
	 * @var short
	 */
	private $varCode;
	/**
	 * wartość zmiennej
	 * @var int
	 */
	private $varVal;

	public function __construct($processId, $varCode, $varVal, $socket) {
		parent::__construct($processId, $socket);
		$this->varCode = $varCode;
		$this->varVal = $varVal;
	}

	protected function buildCommandStream() {
		$this->commandStream
				= BigEndian::shortToPack($this->getCommandCode())
				. BigEndian::byteToPack($this->getProcessId())
				. BigEndian::shortToPack($this->getVarCode())
				. BigEndian::intToPack($this->getVarVal());
	}

	public function getCommandCode() {
		return CommandCode::D_SET_DINT_short;
	}

	/**
	 * @return short
	 */
	public function getVarCode(){
		return $this->varCode;
	}
	/**
	 * @return int
	 */
	public function getVarVal(){
		return $this->varVal;
	}


}
