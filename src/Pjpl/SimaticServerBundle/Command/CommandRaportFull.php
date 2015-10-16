<?php
namespace Pjpl\SimaticServerBundle\Command;
use Pjpl\SimaticServerBundle\S7\Common\CommandCode;
use Pjpl\lib\BigEndian;
/**
 * @todo Description of CommandRaportFull
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class CommandRaportFull extends Command{

	protected function buildCommandStream() {
		$this->commandStream
				= BigEndian::shortToPack($this->getCommandCode())
				. BigEndian::byteToPack($this->getProcessId())
				;
	}

	public function getCommandCode() {
		return CommandCode::RAPORT_FULL_short;
	}

}
