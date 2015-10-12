<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;
/**
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class ResponseInt extends CommandResponse{
	protected function parseResponseStream() {
		$this->int = BigEndian::intFromPack($this->getResponseStream(),5,2);
	}
	public function getInt(){
		return $this->int;
	}

	/**
	 * @var short
	 */
	private $int;
}
