<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\lib\BigEndian;

/**
 * @todo Description of Q_GetByte
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class Q_GetByte extends Command{
	/**
	 * identyfikator zmiennej
	 * @var short
	 */
	private $varId;

	public function __construct($processId, $varId, $socket) {
		parent::__construct($processId, $socket);
		$this->varId = $varId;
	}

	protected function buildCommandStream() {
		$this->commandStream
				= BigEndian::shortToPack($this->getCommandCode())
				. BigEndian::byteToPack($this->getProcessId())
				. BigEndian::shortToPack($this->getVarId());
	}

	public function getCommandCode() {
		return CommandCode::Q_GET_BYTE_short;
	}

	public function getVarId(){
		return $this->varId;
	}

}
