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
			// kontroler generuje stronę z javascriptem 
			return $this->render('PjplScadaBundle:Scada:panel.html.twig');
		}
}
