<?php
namespace Pjpl\SimaticServerBundle\Process;
use Pjpl\SimaticServerBundle\S7\Common\VarOffset;
use Pjpl\lib\BigEndian;

/**
 * @todo Description of Variables
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class VariablesArrays {

	/**
	 * @var int
	 */
	private $buffQlength = 0;

	const SYGNATURA_LENGHT = 5;
	const WYMIARY_LENGTH = 12;
	const NAGLOWEK_LENGTH = 17;
	const DATA_START = 17;
	const D_LENGTH_POS =  5;
	const I_LENGTH_POS =  9;
	const Q_LENGTH_POS =  13;
	/**
	 * @var array
	 */
	private $D;
	/**
	 * @var array
	 */
	private $I;
	/**
	 * @var array
	 */
	private $Q;

	/**
	 * @var byte
	 */
	private $zmiennaByte;
	/**
	 * @var short
	 */
	private $zmiennaInt;
	/**
	 * @var int
	 */
	private $zmiennaDInt;
	/**
	 * @var float
	 */
	private $zmiennaReal;

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
		$this->D = $params['D'];
		$this->I = $params['I'];
		$this->Q = $params['Q'];
		$this->buffDlength = count($this->D);
		$this->buffIlength = count($this->I);
		$this->buffQlength = count($this->Q);
	}
	public function D_getZmiennaByte(){
		if( ! isset($this->zmiennaByte)){
			$this->zmiennaByte = $this->D_getByte(VarOffset::ZMIENNA_BYTE);
		}
		return $this->zmiennaByte;
	}
	public function D_getZmiennaInt(){
		if( ! isset($this->zmiennaInt)){
			$this->zmiennaInt = $this->D_getInt(VarOffset::ZMIENNA_INT);
		}
		return $this->zmiennaInt;
	}
	public function D_getZmiennaDInt(){
		if( ! isset($this->zmiennaDInt)){
			$this->zmiennaDInt = $this->D_getDInt(VarOffset::ZMIENNA_DINT);
		}
		return $this->zmiennaDInt;
	}
	public function D_getZmiennaReal(){
		if( ! isset($this->zmiennaReal)){
			$this->zmiennaReal = $this->D_getReal(VarOffset::ZMIENNA_REAL);
		}
		return $this->zmiennaReal;
	}

	public function get_I_0(){
		return $this->I_getByte(VarOffset::IN_1);
	}
	public function get_I_0_0(){
		if(!isset($this->I_0_0)){
			$this->I_0_0 = ( $this->I_getByte(VarOffset::IN_1) & 0x01 );
		}
		return $this->I_0_0;
	}
	public function get_I_0_1(){
		if(!isset($this->I_0_1)){
			$this->I_0_1 = ( ( $this->I_getByte(VarOffset::IN_1) & 0x02 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_1;
	}
	public function get_I_0_2(){
		if(!isset($this->I_0_2)){
			$this->I_0_2 = ( ( $this->I_getByte(VarOffset::IN_1) & 0x04 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_2;
	}
	public function get_I_0_3(){
		if(!isset($this->I_0_3)){
			$this->I_0_3 = ( ( $this->I_getByte(VarOffset::IN_1) & 0x08 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_3;
	}
	public function get_I_0_4(){
		if(!isset($this->I_0_4)){
			$this->I_0_4 = ( ( $this->I_getByte(VarOffset::IN_1) & 0x10 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_4;
	}
	public function get_I_0_5(){
		if(!isset($this->I_0_5)){
			$this->I_0_5 = ( ( $this->I_getByte(VarOffset::IN_1) & 0x20 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_5;
	}
	public function get_I_0_6(){
		if(!isset($this->I_0_6)){
			$this->I_0_6 = ( ( $this->I_getByte(VarOffset::IN_1) & 0x40 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_6;
	}
	public function get_I_0_7(){
		if(!isset($this->I_0_7)){
			$this->I_0_7 = ( ( $this->I_getByte(VarOffset::IN_1) & 0x80 ) > 0 ? 1 : 0 );
		}
		return $this->I_0_7;
	}

	public function get_Q_0(){
		return  $this->Q_getByte(VarOffset::OUT_1);
	}
	public function get_Q_0_0(){
		if(!isset($this->Q_0_0)){
			$this->Q_0_0 = ( $this->Q_getByte(VarOffset::OUT_1) & 0x01 );
		}
		return $this->Q_0_0;
	}
	public function get_Q_0_1(){
		if(!isset($this->Q_0_1)){
			$this->Q_0_1 = ( ( $this->Q_getByte(VarOffset::OUT_1) & 0x02 ) > 0 ? 1 : 0 );
		}
		return $this->Q_0_1;
	}
	public function get_Q_0_2(){
		if(!isset($this->Q_0_2)){
			$this->Q_0_2 = ( ( $this->Q_getByte(VarOffset::OUT_1) & 0x04 ) > 0 ? 1 : 0 );
		}
		return $this->Q_0_2;
	}
	public function get_Q_0_3(){
		if(!isset($this->Q_0_3)){
			$this->Q_0_3 = ( ( $this->Q_getByte(VarOffset::OUT_1) & 0x08 ) > 0 ? 1 : 0 );
		}
		return $this->Q_0_3;
	}
	public function get_Q_0_4(){
		if(!isset($this->Q_0_4)){
			$this->Q_0_4 = ( ( $this->Q_getByte(VarOffset::OUT_1) & 0x10 ) > 0 ? 1 : 0 );
		}
		return $this->Q_0_4;
	}
	public function get_Q_0_5(){
		if(!isset($this->Q_0_5)){
			$this->Q_0_5 = ( ( $this->Q_getByte(VarOffset::OUT_1) & 0x20 ) > 0 ? 1 : 0 );
		}
		return $this->Q_0_5;
	}

	/**
	 * @param int $start
	 * @return byte
	 */
	private function D_getByte($start){
		return BigEndian::byteFromArray($this->D, $start);
	}
	/**
	 * @param int $start
	 * @return short
	 */
	private function D_getInt($start){
		return BigEndian::shortFromArray($this->D, $start);
	}
	/**
	 * @param int $start
	 * @return int
	 */
	private function D_getDInt($start){
		return BigEndian::intFromArray($this->D, $start);
	}
	/**
	 * @param int $start
	 * @return float
	 */
	private function D_getReal($start){
		return BigEndian::floatFromArray($this->D, $start);
	}
	/**
	 * @param int $start
	 * @param int $length
	 * @return array
	 */
	public function D_getBuff($start, $length){
		$tmp = [];
		for( $i = $start, $l = 0 ; $l < $length ; $i++){
			$tmp[] = $this->D[$i];
		}
		return $tmp;
	}
	public function I_getByte($start){
		return $this->I[$start];
	}
	public function Q_getByte($start){
		return $this->Q[$start];
	}

}
