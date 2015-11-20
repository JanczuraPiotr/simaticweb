<?php
namespace Pjpl\SimaticServerBundle\Process;
use Pjpl\SimaticServerBundle\Command\ResponseRaportFull;
use Pjpl\SimaticServerBundle\S7\Common\VarOffset;

/**
 * @todo Description of Variables
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class VariablesRaport {
	/**
	 * @var ResponseRaportFull
	 */
	private $responseRaportFull;

	private $I_0_0;
	private $I_0_1;
	private $I_0_2;
	private $I_0_3;
	private $I_0_4;
	private $I_0_5;
	private $I_0_6;
	private $I_0_7;
	private $Q_0_0;
	private $Q_0_1;
	private $Q_0_2;
	private $Q_0_3;
	private $Q_0_4;

	public function __construct(array $params) {
		if(isset($params['raport'])){
			$this->setRaport($params['raport']);
		}
	}
	public function setRaport(ResponseRaportFull $raport){
		$this->responseRaportFull = $raport;
	}
	public function D_getZmiennaByte(){
		return $this->responseRaportFull->D_getByte(VarOffset::ZMIENNA_BYTE);
	}
	public function D_getZmiennaInt(){
		return $this->responseRaportFull->D_getInt(VarOffset::ZMIENNA_INT);
	}
	public function D_getZmiennaDInt(){
		return $this->responseRaportFull->D_getDInt(VarOffset::ZMIENNA_DINT);
	}
	public function D_getZmiennaReal(){
		return $this->responseRaportFull->D_getReal(VarOffset::ZMIENNA_REAL);
	}

	public function get_I_0(){
		return $this->responseRaportFull->I_getByte(VarOffset::IN_1);
	}
	public function get_I_0_0(){
		if(!isset($this->I_0_0)){
			$this->I_0_0 = ( $this->responseRaportFull->I_getByte(VarOffset::IN_1) & 0x01 );
		}
		return $this->I_0_0;
	}
	public function get_I_0_1(){
		if(!isset($this->I_0_1)){
			$this->I_0_1 = ( ( $this->responseRaportFull->I_getByte(VarOffset::IN_1) & 0x02 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_1;
	}
	public function get_I_0_2(){
		if(!isset($this->I_0_2)){
			$this->I_0_2 = ( ( $this->responseRaportFull->I_getByte(VarOffset::IN_1) & 0x04 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_2;
	}
	public function get_I_0_3(){
		if(!isset($this->I_0_3)){
			$this->I_0_3 = ( ( $this->responseRaportFull->I_getByte(VarOffset::IN_1) & 0x08 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_3;
	}
	public function get_I_0_4(){
		if(!isset($this->I_0_4)){
			$this->I_0_4 = ( ( $this->responseRaportFull->I_getByte(VarOffset::IN_1) & 0x10 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_4;
	}
	public function get_I_0_5(){
		if(!isset($this->I_0_5)){
			$this->I_0_5 = ( ( $this->responseRaportFull->I_getByte(VarOffset::IN_1) & 0x20 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_5;
	}
	public function get_I_0_6(){
		if(!isset($this->I_0_6)){
			$this->I_0_6 = ( ( $this->responseRaportFull->I_getByte(VarOffset::IN_1) & 0x40 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_6;
	}
	public function get_I_0_7(){
		if(!isset($this->I_0_7)){
			$this->I_0_7 = ( ( $this->responseRaportFull->I_getByte(VarOffset::IN_1) & 0x80 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_7;
	}

	public function get_Q_0(){
		return  $this->responseRaportFull->Q_getByte(VarOffset::OUT_1);
	}
	public function get_Q_0_0(){
		if(!isset($this->Q_0_0)){
			$this->Q_0_0 = ( $this->responseRaportFull->Q_getByte(VarOffset::OUT_1) & 0x01 );
		}
		return $this->Q_0_0;
	}
	public function get_Q_0_1(){
		if(!isset($this->Q_0_1)){
			$this->Q_0_1 = ( ( $this->responseRaportFull->Q_getByte(VarOffset::OUT_1) & 0x02 ) > 0 ? 1 : 0 );
		}
		return $this->Q_0_1;
	}
	public function get_Q_0_2(){
		if(!isset($this->Q_0_2)){
			$this->Q_0_2 = ( ( $this->responseRaportFull->Q_getByte(VarOffset::OUT_1) & 0x04 ) > 0 ? 1 : 0 );
		}
		return $this->Q_0_2;
	}
	public function get_Q_0_3(){
		if(!isset($this->Q_0_3)){
			$this->Q_0_3 = ( ( $this->responseRaportFull->Q_getByte(VarOffset::OUT_1) & 0x08 ) > 0 ? 1 : 0 );
		}
		return $this->Q_0_3;
	}
	public function get_Q_0_4(){
		if(!isset($this->Q_0_4)){
			$this->Q_0_4 = ( ( $this->responseRaportFull->Q_getByte(VarOffset::OUT_1) & 0x10 ) > 0 ? 1 : 0 );
		}
		return $this->Q_0_4;
	}
	public function get_Q_0_5(){
		if(!isset($this->Q_0_5)){
			$this->Q_0_5 = ( ( $this->responseRaportFull->Q_getByte(VarOffset::OUT_1) & 0x20 ) > 0 ? 1 : 0 );
		}
		return $this->Q_0_5;
	}
}
