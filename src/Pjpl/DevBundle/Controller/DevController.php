<?php

namespace Pjpl\DevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/dev", name="dev")
 */
class DevController extends Controller
{
    /**
     * @Route("/", name="dev_index")
     */
    public function indexAction(){
        return $this->render('PjplDevBundle:Dev:index.html.twig');
    }
}
