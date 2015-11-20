<?php
namespace Pjpl\AnalizaBundle\Logic;

use Knp\Component\Pager\Paginator;
use Pjpl\SimaticServerBundle\Entity\Process1Repository;

/**
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class ShowArchiwumDump {
	private $result;
	/**
	 * @var Paginator
	 */
	private $paginator;
	/**
	 * @var Process1Repository
	 */
	private $process1Repo;
	/**
	 * numer strony
	 * @var int
	 */
	private $pageNr;
	/**
	 * ilość elementów na stronę
	 * @var int
	 */
	private $itemsPerPage;
	
	/**
	 * @param Paginator $paginator
	 * @param BramaRepository $process1Repo
	 * @param int $pageNr
	 * @param int $itemsPerPage
	 */
	public function __construct(Paginator $paginator, Process1Repository $process1Repo, $pageNr, $itemsPerPage){
		$this->paginator = $paginator;
		$this->process1Repo = $process1Repo;
		$this->pageNr = $pageNr;
		$this->itemsPerPage = $itemsPerPage;
	}

	public function logic(){
		$this->result = $this->paginator->paginate(
				$this->process1Repo->queryForPaginator(),
				$this->pageNr,
				$this->itemsPerPage
		);
		return $this->result;
	}

}
