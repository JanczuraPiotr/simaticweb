<?php

namespace Pjpl\DevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Pjpl\SimaticServerBundle\Logic\ShowArchiwumDump;

class DevController extends Controller
{

    public function indexAction(){
			return $this->render('PjplDevBundle:Dev:index.html.twig');
    }

}
