<?php
namespace Pjpl\SimaticServerBundle\S7\Common;
/**
 * Description of CommandCode
 *
 * @author piotr
 */
class CommandCode {
	const OK_short = 0x0000;
	const NO_short = 0xFFFF;

	const SET_BYTE_OUT_short = 0x8008;
}
