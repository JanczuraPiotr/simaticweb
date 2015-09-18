<?php

namespace Pjpl\SimaticServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Pjpl\SimaticServerBundle\Utils\Process1Variables;
/**
 * Brama
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="process1")
 * @ORM\Entity(repositoryClass="Pjpl\SimaticServerBundle\Entity\Process1Repository")
 */
class Process1
{
    /**
     * @var integer
     *
     * @ORM\Column(name="timestamp", type="bigint", nullable=false)
     */
    private $timestamp;

    /**
     * @var string
     * @ORM\Column(name="D", type="blob", nullable=false)
     */
    private $D;

    /**
     * @var string
     * @ORM\Column(name="I", type="blob", nullable=false)
     */
    private $I;

    /**
     * @var string
     * @ORM\Column(name="Q", type="blob", nullable=false)
     */
    private $Q;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set timestamp
     *
     * @param integer $timestamp
     * @return Process1
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return integer
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set D
     *
     * @param string $D
     * @return Process1
     */
    public function setD($D)
    {
        $this->D = $D;

        return $this;
    }

    /**
     * Get D
     *
     */
    public function getD()
    {
        return $this->D;
    }

    /**
     * Set I
     *
     * @param string $I
     * @return Process1
     */
    public function setPa($I)
    {
        $this->I = $I;

        return $this;
    }

    /**
     * Get I
     *
     */
    public function getI()
    {
			return $this->I;
    }

    /**
     * Set Q
     *
     * @param string $Q
     * @return Process1
     */
    public function setQ($Q)
    {
        $this->Q = $Q;

        return $this;
    }

    /**
     * Get Q
     */
    public function getQ()
    {
			return $this->Q;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

		/**
		 * @ORM\PostLoad
		 */
		public function postLoad(){
			$this->D = unpack("C*",stream_get_contents($this->D));
			$this->D = array_splice($this->D, 0);
			$this->I = unpack("C*",stream_get_contents($this->I));
			$this->I = array_splice($this->I, 0);
			$this->Q = unpack("C*",stream_get_contents($this->Q));
			$this->Q = array_splice($this->Q, 0);
		}
		/**
		 * @return Process1Variables
		 */
		public function getVariablesAccess(){
			if( ! isset($this->variablesAccess)){
				$this->variablesAccess = new Process1Variables($this);
			}
			return $this->variablesAccess;
		}

		public function getStrHexD(){
			if( null === $this->strHexD ){
				foreach ($this->D as $k => $v){
					$this->strHexD[] = sprintf("%02X", $v);
				}
			}
			return $this->strHexD;
		}
		public function getStrHexI(){
			if( null === $this->strHexI ){
				foreach ($this->I as $k => $v){
					$this->strHexI[] = sprintf("%02X", $v);
				}
			}
			return $this->strHexI;
		}
		public function getStrHexQ(){
			if( null === $this->strHexQ ){
				foreach ($this->Q as $k => $v){
					$this->strHexQ[] = sprintf("%02X", $v);
				}
			}
			return $this->strHexQ;
		}

		private $strHexD = null;
		private $strHexI = null;
		private $strHexQ = null;
		/**
		 * @var Process1Variables
		 */
		private $variablesAccess;
}
