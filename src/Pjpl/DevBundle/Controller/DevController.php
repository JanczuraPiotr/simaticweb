<?php
namespace Pjpl\DevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DevController extends Controller
{

    public function indexAction(){
			return $this->render('PjplDevBundle:Dev:index.html.twig');
    }

}
