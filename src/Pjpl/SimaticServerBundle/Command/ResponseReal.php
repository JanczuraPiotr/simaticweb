<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;
/**
 * Description of ResponseReal
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class ResponseReal extends CommandResponse{

	public function getReal(){
		return $this->real;
	}

	protected function parseResponseStream() {
		$this->real = BigEndian::floatFromPack($this->getResponseStream(), 5, 4);
		$stream = $this->getResponseStream();
		for( $i = 0 ; $i < strlen($stream); $i++ ){
			echo sprintf("buff[%d] = 0x%02X <br>",$i, BigEndian::byteFromPack($stream,$i));
		}
	}

	/**
	 * @var float
	 */
	private $real;

}
