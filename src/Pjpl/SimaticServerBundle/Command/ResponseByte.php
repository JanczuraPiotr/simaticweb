<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;
/**
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class ResponseByte extends CommandResponse{
	/**
	 * Wartość zwrócona jako parametr odpowiedzi
	 * @return byte
	 */
	public function getByte(){
		return $this->byte;
	}

	protected function parseResponseStream() {
		$this->byte = BigEndian::byteFromPack($this->getResponseStream(),5,1);
	}
	/**
	 * @var byte
	 */
	private $byte;
}
