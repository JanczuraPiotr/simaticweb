<?php

namespace Pjpl\ScadaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ScadaController extends Controller
{
    public function indexAction()
    {
        return $this->render('PjplScadaBundle:Scada:index.html.twig');
    }
		public function panelAction(){
			return $this->render('PjplScadaBundle:Scada:panel.html.twig');
		}
}
