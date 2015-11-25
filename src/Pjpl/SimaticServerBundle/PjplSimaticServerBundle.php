<?php

namespace Pjpl\SimaticServerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

class PjplSimaticServerBundle extends Bundle
{
	public function build(\Symfony\Component\DependencyInjection\ContainerBuilder $container) {
		$loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/Resources/config'));
		$loader->load('parameters.yml');
	}
}
