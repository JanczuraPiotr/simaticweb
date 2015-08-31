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
		$menuSimaticWeb->addChild("Przegląd archiwum zrzutów", [
				'route' => 'dev_przeglad_archiwum_dump'
		] );
		$menuSimaticWeb->addChild("Przegląd archiwum zmiennych",[
				'route' => 'dev_przeglad_archiwum_variables'
		]);

		$menuSimaticServer = $menu->addChild('SimaticServer');
		$menuSimaticServer->addChild('test servera',[
				'route' => 'simatic_server'
		]);

		return $menu;

	}
}
