<?php

namespace Pjpl\DevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DirectController extends Controller{
	public function scadaAction(){
		return $this->render('PjplDevBundle:Direct:scada.html.twig');
	}
}
