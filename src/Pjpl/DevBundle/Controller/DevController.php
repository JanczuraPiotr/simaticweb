<?php

namespace Pjpl\DevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Pjpl\SimaticServerBundle\Logic\ShowArchiwumDump;
use Pjpl\SimaticServerBundle\Logic\ShowArchiwumVariables;

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
		 * @Route("/przeglad-archiwum-dump", name="dev_przeglad_archiwum_dump")
		 */
		public function przegladArchiwumDumpAction(Request $request){
			$paginator = $this->get('knp_paginator');
			$em = $this->getDoctrine()->getManager();
			$bramaRepo = $em->getRepository("PjplSimaticServerBundle:Brama");

			$logic = new ShowArchiwumDump($paginator, $bramaRepo, $request->query->getInt('page', 1), 10);
			$zrzuty = $logic->logic();

			return $this->render('PjplDevBundle:Dev:przeglad-archiwum-dump.html.twig',['zrzuty' => $zrzuty]);
		}
		/**
		 * @Route("/przegladaj-archiwum-variables", name="dev_przeglad_archiwum_variables")
		 */
		public function przegladArchiwumVariablesAction(Request $request){
			$paginator = $this->get('knp_paginator');
			$em = $this->getDoctrine()->getManager();
			$bramaRepo = $em->getRepository('PjplSimaticServerBundle:Brama');

			$logic = new ShowArchiwumDump($paginator, $bramaRepo, $request->query->getInt('page', 1), 10);
			$zrzuty = $logic->logic();

			return $this->render('PjplDevBundle:Dev:przeglad-archiwum-variables.html.twig',['zrzuty' => $zrzuty]);
		}
}
