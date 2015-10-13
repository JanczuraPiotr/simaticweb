<?php

namespace Pjpl\AnalizaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnalizaController extends Controller
{
    public function indexAction()
    {
        return $this->render('PjplAnalizaBundle:Analiza:index.html.twig');
    }
		public function przegladArchiwumDumpAction(Request $request){
			$paginator = $this->get('knp_paginator');
			$em = $this->getDoctrine()->getManager();
			$process1Repo = $em->getRepository("PjplSimaticServerBundle:Process1");

			$logic = new ShowArchiwumDump($paginator, $process1Repo, $request->query->getInt('page', 1), 10);
			$zrzuty = $logic->logic();

			return $this->render('PjplDevBundle:Dev:przeglad-archiwum-dump.html.twig',['zrzuty' => $zrzuty]);
		}
		public function przegladArchiwumVariablesAction(Request $request){
			$paginator = $this->get('knp_paginator');
			$em = $this->getDoctrine()->getManager();
			$process1Repo = $em->getRepository('PjplSimaticServerBundle:Process1');

			$logic = new ShowArchiwumDump($paginator, $process1Repo, $request->query->getInt('page', 1), 10);
			$zrzuty = $logic->logic();

			return $this->render('PjplDevBundle:Dev:przeglad-archiwum-variables.html.twig',['zrzuty' => $zrzuty]);
		}
}
