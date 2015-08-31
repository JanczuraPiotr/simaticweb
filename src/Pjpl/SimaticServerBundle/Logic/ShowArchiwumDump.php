<?php
namespace Pjpl\SimaticServerBundle\Logic;

use Knp\Component\Pager\Paginator;
use Pjpl\SimaticServerBundle\Entity\BramaRepository;

/**
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class ShowArchiwumDump {

	/**
	 * @param Paginator $paginator
	 * @param BramaRepository $bramaRepo
	 * @param int $pageNr
	 * @param int $itemsPerPage
	 */
	public function __construct(Paginator $paginator, BramaRepository $bramaRepo, $pageNr, $itemsPerPage){
		$this->paginator = $paginator;
		$this->bramaRepo = $bramaRepo;
		$this->pageNr = $pageNr;
		$this->itemsPerPage = $itemsPerPage;
	}

	public function logic(){
		$this->result = $this->paginator->paginate(
				$this->bramaRepo->queryForPaginator(),
				$this->pageNr,
				$this->itemsPerPage
		);
		return $this->result;
	}
	private $result;
	/**
	 * @var Paginator
	 */
	private $paginator;
	/**
	 * @var BramaRepository
	 */
	private $bramaRepo;
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
}
