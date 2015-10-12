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
	}

	/**
	 * @var float
	 */
	private $real;

}
