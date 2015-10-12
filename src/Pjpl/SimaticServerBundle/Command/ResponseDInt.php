<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;
/**
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class ResponseDInt extends CommandResponse{
	protected function parseResponseStream() {
		$this->int = BigEndian::intFromPack($this->getResponseStream(), 5, 4);
	}
	public function getDInt(){
		return $this->dint;
	}

	/**
	 * @var int
	 */
	private $dint;
}
