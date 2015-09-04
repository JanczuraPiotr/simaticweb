<?php
namespace Pjpl\SimaticServerBundle\Utils;
use Pjpl\SimaticServerBundle\Entity\Brama;

/**
 * Dostęp do zmiennych bramy na podstawie zrzutu pamięci sterowanika
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class BramaVariables {

	public function __construct(Brama $brama) {
		$this->brama = $brama;
	}
	public function getAll(){
		return [
				'input0' => $this->getInput0(),
				'input1' => $this->getInput1(),
				'input2' => $this->getInput2(),
				'input3' => $this->getInput3(),
				'input4' => $this->getInput4(),
				'input5' => $this->getInput5(),
				'input6' => $this->getInput6(),
				'input7' => $this->getInput7(),
		];
	}
	public function getInput0(){
		return S7::getBitAt($this->brama->getPe(), 0, 0);
	}
	public function getInput1(){
		return S7::getBitAt($this->brama->getPe(), 0, 1);
	}
	public function getInput2(){
		return S7::getBitAt($this->brama->getPe(), 0, 2);
	}
	public function getInput3(){
		return S7::getBitAt($this->brama->getPe(), 0, 3);
	}
	public function getInput4(){
		return S7::getBitAt($this->brama->getPe(), 0, 4);
	}
	public function getInput5(){
		return S7::getBitAt($this->brama->getPe(), 0, 5);
	}
	public function getInput6(){
		return S7::getBitAt($this->brama->getPe(), 0, 6);
	}
	public function getInput7(){
		return S7::getBitAt($this->brama->getPe(), 0, 7);
	}

	/**
	 * @var Brama
	 */
	private $brama;
}
