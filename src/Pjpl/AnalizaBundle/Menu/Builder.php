<?php
namespace Pjpl\AnalizaBundle\Menu;
use Knp\Menu\FactoryInterface;
/**
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class Builder {
	public function AnalizaMenu(FactoryInterface $factory , array $options){
		$menu = $factory->createItem('root');
		$menu->setChildrenAttribute('class', 'menu-main');

		$menuSimaticWeb = $menu->addChild('Analiza',[
				'route' => 'analiza'
		]);

//		$menuSimaticWeb->addChild("Przegląd archiwum zrzutów", [
//				'route' => 'dev_przeglad_archiwum_dump'
//		] );
//		$menuSimaticWeb->addChild("Przegląd archiwum zmiennych",[
//				'route' => 'dev_przeglad_archiwum_variables'
//		]);

		$menuScada = $menu->addChild("SCADA",[
				'route' => 'scada'
		]);


		return $menu;

	}
}
