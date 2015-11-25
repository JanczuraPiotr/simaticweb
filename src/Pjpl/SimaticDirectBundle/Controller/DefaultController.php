<?php

namespace Pjpl\SimaticDirectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SimaticDirectBundle:Default:index.html.twig', array('name' => $name));
    }
}
