<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;
/**
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class ResponseInt extends CommandResponse{
	/**
	 * @var short
	 */
	private $int;
	
	protected function parseResponseStream() {
		$this->int = BigEndian::shortFromPack(substr($this->getResponseStream(),5,2));
	}
	public function getInt(){
		return $this->int;
	}

}
