<?php

namespace Pjpl\SimaticServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PjplSimaticServerBundle:Default:index.html.twig', array('name' => $name));
    }
}
