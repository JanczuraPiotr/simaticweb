<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;
/**
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class ResponseByte extends CommandResponse{
	/**
	 * @var byte
	 */
	private $byte;

	/**
	 * Wartość zwrócona jako parametr odpowiedzi
	 * @return byte
	 */
	public function getByte(){
		return $this->byte;
	}

	protected function parseResponseStream() {
		$this->byte = BigEndian::byteFromPack(substr($this->getResponseStream(),5,1));
	}
}
