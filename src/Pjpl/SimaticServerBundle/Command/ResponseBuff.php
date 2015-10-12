<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;
/**
 * Description of ResponseBuff
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class ResponseBuff extends CommandResponse{

	public function getBuffSize(){
		return $this->buffSize;
	}
	public function getBuff(){
		return $this->buff;
	}

	protected function parseResponseStream() {
		$this->buffSize = BigEndian::shortFromPack($this->getResponseStream(), 5, 2);
		$tmp = substr($this->getResponseStream(), 7, $this->buffSize);
		$this->buff = [];
		foreach ($tmp as $key => $value) {
			$this->buff[] = ord($value);
		}
	}

	/**
	 * @var int
	 */
	private $buffSize;
	/**
	 * @var array
	 */
	private $buff;
}
