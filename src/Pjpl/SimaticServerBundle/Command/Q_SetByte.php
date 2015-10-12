<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
/**
 * Description of Q_SetByte
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class Q_SetByte extends Command{
	/**
	 * @param byte processId identyfikator procesu dla którym ma być wykonana komenda
	 * @param int $addr adres zmiennej wyjściowej
	 * @param byte $val nowa wartość zmiennej wyjściowej
	 * @param resource $socket gniazdo do SimaticServer
	 */
	public function __construct($processId, $addr, $val, $socket) {
		parent::__construct($processId, $socket);
		$this->addr = $addr;
		$this->val = $val;
	}
	/**
	 * @return int
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
	protected function buildCommandStream() {
		$this->commandStream
				= BigEndian::shortToPack($this->getCommandCode())
				. BigEndian::byteToPack($this->getProcessId())
				. BigEndian::shortToPack($this->getAddr())
				. BigEndian::byteToPack($this->getVal());
	}

	public function getCommandCode() {
		return CommandCode::Q_SET_BYTE_short;
	}

	/**
	 * @var int
	 */
	private $addr;
	/**
	 * @var byte
	 */
	private $val;
}
