<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;
/**
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class ResponseDInt extends CommandResponse{
	protected function parseResponseStream() {
		$this->dint = BigEndian::intFromPack($this->getResponseStream(), 5);
	}
	public function getDInt(){
		return $this->dint;
	}

	/**
	 * @var int
	 */
	private $dint;
}
