<?php

namespace Pjpl\DevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Pjpl\SimaticServerBundle\Utils\S7;

/**
 * @Route("/dev", name="dev")
 */
class DevController extends Controller
{
    /**
     * @Route("/", name="dev")
     * @Route("/index", name="dev_index")
     */
    public function indexAction(){
			return $this->render('PjplDevBundle:Dev:index.html.twig');
    }
		/**
		 * @Route("/przeglad-archiwum", name="dev_przeglad_archiwum")
		 */
		public function przegladArchiwumAction(\Symfony\Component\HttpFoundation\Request $request){
			$paginator = $this->get('knp_paginator');
			$em = $this->getDoctrine()->getManager();
			$BramaRepo = $em->getRepository("PjplSimaticServerBundle:Brama");

			$zrzuty = $paginator->paginate(
					$BramaRepo->queryForPaginator(),
					$request->query->getInt('page', 1),
					10
			);

			return $this->render('PjplDevBundle:Dev:przeglad-archiwum.html.twig',['zrzuty' => $zrzuty]);
		}
}
