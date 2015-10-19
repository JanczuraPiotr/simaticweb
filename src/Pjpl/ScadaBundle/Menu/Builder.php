<?php
namespace Pjpl\ScadaBundle\Menu;
use Knp\Menu\FactoryInterface;
/**
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class Builder {
	public function ScadaMenu(FactoryInterface $factory , array $options){
		$menu = $factory->createItem('root');
		$menu->setChildrenAttribute('class', 'menu-main');


		$menuScada = $menu->addChild('Panel',[
				'route' => 'scada_panel'
		]);

		$menuScada = $menu->addChild("Analiza",[
				'route' => 'analiza'
		]);


		return $menu;

	}
}
