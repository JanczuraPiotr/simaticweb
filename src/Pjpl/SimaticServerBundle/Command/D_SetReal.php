<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\lib\BigEndian;
/**
 * @todo Description of D_SetReal
 *
 * @author piotr
 */
class D_SetReal extends Command{
	/**
	 * kod zmiennej zmiennej
	 * @var short
	 */
	private $varCode;
	/**
	 * wartość zmiennej
	 * @var float
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
				. BigEndian::floatToPack($this->getVarVal());
	}

	public function getCommandCode() {
		return CommandCode::D_SET_REAL_short;
	}

	/**
	 * @return short
	 */
	public function getVarCode(){
		return $this->varCode;
	}
	/**
	 * @return float
	 */
	public function getVarVal(){
		return $this->varVal;
	}
}
