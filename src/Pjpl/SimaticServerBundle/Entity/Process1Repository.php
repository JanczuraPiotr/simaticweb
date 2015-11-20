<?php
/**
 * @todo Description of Process1Repository
 */

namespace Pjpl\SimaticServerBundle\Entity;
use Doctrine\ORM\EntityRepository;

class Process1Repository extends EntityRepository{

	public function queryForPaginator(){
		$dql = "SELECT p FROM PjplSimaticServerBundle:Process1 p";
		return $this->getEntityManager()->createQuery($dql);
	}
}
