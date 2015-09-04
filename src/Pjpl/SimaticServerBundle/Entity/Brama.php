<?php

namespace Pjpl\SimaticServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Pjpl\SimaticServerBundle\Utils\BramaVariables;
/**
 * Brama
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="brama")
 * @ORM\Entity(repositoryClass="Pjpl\SimaticServerBundle\Entity\BramaRepository")
 */
class Brama
{
    /**
     * @var integer
     *
     * @ORM\Column(name="timestamp", type="bigint", nullable=false)
     */
    private $timestamp;

    /**
     * @var string
     * @ORM\Column(name="db", type="blob", nullable=false)
     */
    private $db;

    /**
     * @var string
     * @ORM\Column(name="pa", type="blob", nullable=false)
     */
    private $pa;

    /**
     * @var string
     * @ORM\Column(name="pe", type="blob", nullable=false)
     */
    private $pe;

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
     * @return Brama
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
     * Set db
     *
     * @param string $db
     * @return Brama
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    /**
     * Get db
     *

     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set pa
     *
     * @param string $pa
     * @return Brama
     */
    public function setPa($pa)
    {
        $this->pa = $pa;

        return $this;
    }

    /**
     * Get pa
     *
     */
    public function getPa()
    {
			return $this->pa;
    }

    /**
     * Set pe
     *
     * @param string $pe
     * @return Brama
     */
    public function setPe($pe)
    {
        $this->pe = $pe;

        return $this;
    }

    /**
     * Get pe
     *

     */
    public function getPe()
    {
			return $this->pe;
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
			$this->db = unpack("C*",stream_get_contents($this->db));
			$this->db = array_splice($this->db, 0);
			$this->pa = unpack("C*",stream_get_contents($this->pa));
			$this->pa = array_splice($this->pa, 0);
			$this->pe = unpack("C*",stream_get_contents($this->pe));
			$this->pe = array_splice($this->pe, 0);
		}
		/**
		 * @return BramaVariables
		 */
		public function getVariablesAccess(){
			if( ! isset($this->variablesAccess)){
				$this->variablesAccess = new BramaVariables($this);
			}
			return $this->variablesAccess;
		}

		public function getStrHexDb(){
			if( null === $this->strHexDb ){
				foreach ($this->db as $k => $v){
					$this->strHexDb[] = sprintf("%02X", $v);
				}
			}
			return $this->strHexDb;
		}
		public function getStrHexPa(){
			if( null === $this->strHexPa ){
				foreach ($this->pa as $k => $v){
					$this->strHexPa[] = sprintf("%02X", $v);
				}
			}
			return $this->strHexPa;
		}
		public function getStrHexPe(){
			if( null === $this->strHexPe ){
				foreach ($this->pe as $k => $v){
					$this->strHexPe[] = sprintf("%02X", $v);
				}
			}
			return $this->strHexPe;
		}

		private $strHexDb = null;
		private $strHexPa = null;
		private $strHexPe = null;
		/**
		 * @var BramaVariables
		 */
		private $variablesAccess;
}
