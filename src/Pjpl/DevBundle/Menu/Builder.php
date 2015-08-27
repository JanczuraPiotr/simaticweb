<?php
namespace Pjpl\DevBundle\Menu;
use Knp\Menu\FactoryInterface;
/**
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class Builder {
	public function DevMenu(FactoryInterface $factory , array $options){
		$menu = $factory->createItem('root');
		$menu->setChildrenAttribute('class', 'menu-main');

		$menuSimaticWeb = $menu->addChild('SimaticWeb');
		$menuSimaticWeb->addChild("Przegląd archiwum", [
				'route' => 'dev_przeglad_archiwum'
		] );

		$menuSimaticServer = $menu->addChild('SimaticServer');
		$menuSimaticServer->addChild('test servera',[
				'route' => 'simatic_server'
		]);

		return $menu;

	}
}
