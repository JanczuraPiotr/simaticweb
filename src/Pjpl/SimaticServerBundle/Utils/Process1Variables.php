<?php
namespace Pjpl\SimaticServerBundle\Utils;
use Pjpl\S7\S7;
use Pjpl\SimaticServerBundle\Entity\Process1;

/**
 * Dostęp do zmiennych bramy na podstawie zrzutu pamięci sterowanika
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class Process1Variables {

	public function __construct(Process1 $process1) {
		$this->process1 = $process1;
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
		return S7::getBitAt($this->process1->getI(), 0, 0);
	}
	public function getInput1(){
		return S7::getBitAt($this->process1->getI(), 0, 1);
	}
	public function getInput2(){
		return S7::getBitAt($this->process1->getI(), 0, 2);
	}
	public function getInput3(){
		return S7::getBitAt($this->process1->getI(), 0, 3);
	}
	public function getInput4(){
		return S7::getBitAt($this->process1->getI(), 0, 4);
	}
	public function getInput5(){
		return S7::getBitAt($this->process1->getI(), 0, 5);
	}
	public function getInput6(){
		return S7::getBitAt($this->process1->getI(), 0, 6);
	}
	public function getInput7(){
		return S7::getBitAt($this->process1->getI(), 0, 7);
	}

	/**
	 * @var Process1
	 */
	private $process1;
}
