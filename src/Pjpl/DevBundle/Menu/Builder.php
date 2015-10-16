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

		$menuCommands = $menu->addChild('Commands');
		$menuCommands->addChild('I_GET_BYTE', ['route' => 'dev_command_I_GET_BYTE']);
		$menuCommands->addChild('Q_GET_BYTE', ['route' => 'dev_command_Q_GET_BYTE']);
		$menuCommands->addChild('Q_SET_BYTE', ['route' => 'dev_command_Q_SET_BYTE']);
		$menuCommands->addChild('D_GET_BYTE', ['route' => 'dev_command_D_GET_BYTE']);
		$menuCommands->addChild('D_SET_BYTE', ['route' => 'dev_command_D_SET_BYTE']);
		$menuCommands->addChild('D_GET_INT',  ['route' => 'dev_command_D_GET_INT']);
		$menuCommands->addChild('D_SET_INT',  ['route' => 'dev_command_D_SET_INT']);
		$menuCommands->addChild('D_GET_DINT', ['route' => 'dev_command_D_GET_DINT']);
		$menuCommands->addChild('D_SET_DINT', ['route' => 'dev_command_D_SET_DINT']);
		$menuCommands->addChild('D_GET_REAL', ['route' => 'dev_command_D_GET_REAL']);
		$menuCommands->addChild('D_SET_REAL', ['route' => 'dev_command_D_SET_REAL']);
		$menuCommands->addChild('Raport dla scada', ['route' => 'dev_command_scada_raport']);

		$menuAnaliza = $menu->addChild("Analiza",[
				'route' => 'analiza'
		]);
		$menuScada = $menu->addChild("SCADA",[
				'route' => 'scada'
		]);

		$menuSimaticServer = $menu->addChild('SimaticServer');
		$menuSimaticServer->addChild('test servera',[
				'route' => 'server'
		]);

		return $menu;

	}
}
