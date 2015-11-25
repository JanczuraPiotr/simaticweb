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

		$menuDevCommands = $menu->addChild('Commands');
		$menuDevCommands->addChild('I_GET_BYTE', ['route' => 'dev_command_I_GET_BYTE']);
		$menuDevCommands->addChild('Q_GET_BYTE', ['route' => 'dev_command_Q_GET_BYTE']);
		$menuDevCommands->addChild('Q_SET_BYTE', ['route' => 'dev_command_Q_SET_BYTE']);
		$menuDevCommands->addChild('D_GET_BYTE', ['route' => 'dev_command_D_GET_BYTE']);
		$menuDevCommands->addChild('D_SET_BYTE', ['route' => 'dev_command_D_SET_BYTE']);
		$menuDevCommands->addChild('D_GET_INT',  ['route' => 'dev_command_D_GET_INT']);
		$menuDevCommands->addChild('D_SET_INT',  ['route' => 'dev_command_D_SET_INT']);
		$menuDevCommands->addChild('D_GET_DINT', ['route' => 'dev_command_D_GET_DINT']);
		$menuDevCommands->addChild('D_SET_DINT', ['route' => 'dev_command_D_SET_DINT']);
		$menuDevCommands->addChild('D_GET_REAL', ['route' => 'dev_command_D_GET_REAL']);
		$menuDevCommands->addChild('D_SET_REAL', ['route' => 'dev_command_D_SET_REAL']);
		$menuDevCommands->addChild('Raport dla scada', ['route' => 'dev_command_scada_raport']);

		$menuDirectController = $menu->addChild('Direct');
		$menuDirectController->addChild('SCADA', [
				'route' => 'dev_direct_scada'
		]);

		$menuDevAnaliza = $menu->addChild('Analiza');
		$menuDevAnaliza->addChild('Zmienne archiwalne', [
				'route' => 'dev_analiza_zmienne_archiwalne'
		]);

		$menuExit = $menu->addChild('| Wyjście z dev');
		$menuExit->addChild("Analiza",[
				'route' => 'analiza'
		]);
		$menuExit->addChild("SCADA",[
				'route' => 'scada'
		]);

		$menuSimaticServer = $menuExit->addChild('SimaticServer');
		$menuSimaticServer->addChild('test servera',[
				'route' => 'server'
		]);

		return $menu;

	}
}
