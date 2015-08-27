<?php
/**
 * Description of BramaRepository
 *
 * @author piotr
 */

namespace Pjpl\SimaticServerBundle\Entity;
use Doctrine\ORM\EntityRepository;

class BramaRepository extends EntityRepository{

	public function queryForPaginator(){
		$dql = "SELECT b FROM PjplSimaticServerBundle:Brama b";
		return $this->getEntityManager()->createQuery($dql);
	}
}
