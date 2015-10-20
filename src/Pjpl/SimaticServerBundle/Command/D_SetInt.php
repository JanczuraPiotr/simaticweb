<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\lib\BigEndian;
/**
 * @todo Description of D_SetInt
 *
 * @author piotr
 */
class D_SetInt extends Command{
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
				. BigEndian::shortToPack($this->getVarVal());
	}

	public function getCommandCode() {
		return CommandCode::D_SET_INT_short;
	}

	/**
	 * @return short
	 */
	public function getVarCode(){
		return $this->varCode;
	}
	/**
	 * @return short
	 */
	public function getVarVal(){
		return $this->varVal;
	}

	/**
	 * kod zmiennej zmiennej
	 * @var short
	 */
	private $varCode;
	/**
	 * wartość zmiennej
	 * @var short
	 */
	private $varVal;
}
