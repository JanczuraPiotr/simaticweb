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
	public function __construct($processId, $varCode, $val, $socket) {
		parent::__construct($processId, $socket);
		$this->varCode = $varCode;
		$this->val = $val;
	}

	protected function buildCommandStream() {
		$this->commandStream
				= BigEndian::shortToPack($this->getCommandCode())
				. BigEndian::byteToPack($this->getProcessId())
				. BigEndian::shortToPack($this->getVarCode())
				. BigEndian::floatToPack($this->getVal());
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
	public function getVal(){
		return $this->val;
	}

	/**
	 * kod zmiennej zmiennej
	 * @var short
	 */
	private $varCode;
	/**
	 * wartość zmiennej
	 * @var float
	 */
	private $val;
}
