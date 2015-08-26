<?php

namespace Pjpl\SimaticServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Brama
 *
 * @ORM\Table(name="brama")
 * @ORM\Entity
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
     *
     * @ORM\Column(name="db", type="blob", nullable=false)
     */
    private $db;

    /**
     * @var string
     *
     * @ORM\Column(name="pa", type="blob", nullable=false)
     */
    private $pa;

    /**
     * @var string
     *
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
     * @return string 
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
     * @return string 
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
     * @return string 
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
}
