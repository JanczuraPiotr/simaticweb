<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\lib\BigEndian;

/**
 * @todo Description of ResponseRaportFull
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class ResponseRaportFull extends CommandResponse{
	protected function parseResponseStream() {
		$this->startD = 17;
		$this->buffDlength = BigEndian::intFromPack($this->getResponseStream(), static::D_LENGTH_POS);
		$this->startI = $this->startD + $this->buffDlength;
		$this->buffIlength = BigEndian::intFromPack($this->getResponseStream(), static::I_LENGTH_POS);
		$this->startQ = $this->startI + $this->buffIlength;
		$this->buffQlength = BigEndian::intFromPack($this->getResponseStream(), static::Q_LENGTH_POS);
	}
	/**
	 * @param int $start
	 * @return byte
	 */
	public function D_getByte($start){
		return BigEndian::byteFromPack($this->getResponseStream(), $this->startD + $start);
	}
	/**
	 * @param int $start
	 * @return short
	 */
	public function D_getInt($start){
		return BigEndian::shortFromPack($this->getResponseStream(), $this->startD + $start);
	}
	/**
	 * @param int $start
	 * @return int
	 */
	public function D_getDInt($start){
		return BigEndian::intFromPack($this->getResponseStream(), $this->startD + $start);
	}
	/**
	 * @param int $start
	 * @return float
	 */
	public function D_getReal($start){
		return BigEndian::floatFromPack($this->getResponseStream(),  $this->startD + $start);
	}
	/**
	 * @param int $start
	 * @param int $length
	 * @return string
	 */
	public function D_getBuff($start, $length){
		return substr($this->getResponseStream(), $start, $length);
	}
	public function I_getByte($start){
		return BigEndian::byteFromPack($this->getResponseStream(), $this->startI + $start);
	}
	public function Q_getByte($start){
		return BigEndian::byteFromPack($this->getResponseStream(), $this->startQ + $start);
	}

	/**
	 * @var int
	 */
	private $startD;
	/**
	 * @var int
	 */
	private $buffDlength = 0;
	/**
	 * @var int
	 */
	private $startI;
	/**
	 * @var int
	 */
	private $buffIlength = 0;
	/**
	 * @var int
	 */
	private $startQ;
	/**
	 * @var int
	 */
	private $buffQlength = 0;

	const SYGNATURA_LENGHT = 5;
	const WYMIARY_LENGTH = 12;
	const NAGLOWEK_LENGTH = 17;
	const D_LENGTH_POS =  5;
	const I_LENGTH_POS =  9;
	const Q_LENGTH_POS =  13;
}
