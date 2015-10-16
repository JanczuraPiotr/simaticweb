<?php
namespace Pjpl\SimaticServerBundle\Process;
use Pjpl\SimaticServerBundle\Command\ResponseRaportFull;

/**
 * @todo Description of Variables
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class Variables {
	public function __construct(array $params) {
		if(isset($params['raport'])){
			$this->setRaport($params['raport']);
		}
	}
	public function setRaport(ResponseRaportFull $raport){
		$this->raport = $raport;
	}
	public function D_getZmienna0(){
		return $this->raport->D_getByte(0);
	}
	public function D_getZmienna1(){
		return $this->raport->D_getInt(1);
	}
	public function D_getZmienna2(){
		return $this->raport->D_getDInt(3);
	}
	public function D_getZmienna3(){
		return $this->raport->D_getReal(7);
	}
	public function I_getInput0(){
		return $this->raport->I_getByte(0);
	}
	public function Q_getOutput0(){
		return $this->raport->Q_getByte(0);
	}

	/**
	 * @var ResponseRaportFull
	 */
	private $raport;
}
