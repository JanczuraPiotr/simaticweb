<?php

namespace Pjpl\SimaticServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/simatic-server", name="simatic_server")
 */
class SimaticServerController extends Controller
{
	/**
	 * @Route("/", name="simatic_server")
	 * @Route("/index", name="simatic_server_index")
	 */
	public function indexAction()
	{
			return $this->render('PjplSimaticServerBundle:SimaticServer:index.html.twig');
	}
}
