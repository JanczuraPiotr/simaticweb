<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\lib\BigEndian;
/**
 * @todo Description of BitSwitch
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class BitSwitch extends Command{
	/**
	 * @param byte $processId
	 * @param byte $memType
	 * @param short $varCode
	 * @param byte $bit
	 * @param Socket $socket
	 */
	public function __construct($processId, $memType, $varCode, $bit, $socket) {
		parent::__construct($processId, $socket);
		$this->memType = $memType;
		$this->varCode = $varCode;
		$this->bit = $bit;
	}
	/**
	 * @return byte
	 */
	public function getMemType(){
		return $this->memType;
	}
	/**
	 * @return short
	 */
	public function getVarCode(){
		return $this->varCode;
	}
	/**
	 * @return byte
	 */
	public function getBit(){
		return $this->bit;
	}
	protected function buildCommandStream() {
		$this->commandStream
				= BigEndian::shortToPack($this->getCommandCode())
				. BigEndian::byteToPack($this->getProcessId())
				. BigEndian::byteToPack($this->getMemType())
				. BigEndian::shortToPack($this->getVarCode())
				. BigEndian::byteToPack($this->getBit());
	}

	public function getCommandCode() {
		return CommandCode::BIT_SWITCH_short;
	}

	/**
	 * @var byte
	 */
	private $memType;
	/**
	 * @var short
	 */
	private $varCode;
	/**
	 * @var byte
	 */
	private $bit;
}
