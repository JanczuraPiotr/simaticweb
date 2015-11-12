<?php
namespace Pjpl\DevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pjpl\AnalizaBundle\Logic\ShowArchiwumVariables;
use Pjpl\SimaticServerBundle\Process\VariablesArrays;
/**
 * @todo Description of AnalizaController
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class AnalizaController extends Controller{
	public function zmienneArchiwalneAction(\Symfony\Component\HttpFoundation\Request $request){
		$paginator = $this->get('knp_paginator');
		$em = $this->getDoctrine()->getManager();
		$process1Repo = $em->getRepository('PjplSimaticServerBundle:Process1');


		$logic = new ShowArchiwumVariables($paginator, $process1Repo, $request->query->getInt('page', 1), 10);
		$paginator = $logic->logic();
		$items = $paginator->getItems();
		dump($items);
		foreach ($items as $key => $rec) {

			$variables = new VariablesArrays ([
					'D' => $rec->getD(),
					'I' => $rec->getI(),
					'Q' => $rec->getQ()
					]);

			$pozycja = [
					'id' => $rec->getId(),
					'timestamp' => $rec->getTimestamp(),
					'D' => [
							'Byte' => $variables->D_getZmiennaByte(),
							'Int' => $variables->D_getZmiennaInt(),
							'DInt' => $variables->D_getZmiennaDInt(),
							'Real' => $variables->D_getZmiennaReal(),
					],
					'I' => [
							0 => [
									0 => $variables->get_I_0_0(),
									1 => $variables->get_I_0_1(),
									2 => $variables->get_I_0_2(),
									3 => $variables->get_I_0_3(),
									4 => $variables->get_I_0_4(),
									5 => $variables->get_I_0_5(),
									6 => $variables->get_I_0_6(),
									7 => $variables->get_I_0_7(),
							]
					],
					'Q' => [
							0 => [
									0 => $variables->get_Q_0_0(),
									1 => $variables->get_Q_0_1(),
									2 => $variables->get_Q_0_2(),
									3 => $variables->get_Q_0_3(),
									4 => $variables->get_Q_0_4(),
									5 => $variables->get_Q_0_5(),
							]
					]
			];
			$items[$key] = $pozycja;
		}
		return $this->render('PjplDevBundle:Analiza:zmienne-archiwalne.html.twig',['paginator' => $paginator, 'items' => $items]);
	}
}
