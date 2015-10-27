<?php
namespace Pjpl\SimaticServerBundle\S7\Common;

class ResponseCode {

	const NO_short = 0x0000;
	const OK_short = 0xFFFF;

	const RETURN_GENERAL_short = 0xC000;
	const RETURN_BUFF_short    = 0xC100;
	const RETURN_BYTE_short    = 0xC101;
	const RETURN_INT_short     = 0xC102;
	const RETURN_DINT_short    = 0xC103;
	const RETURN_LONG_short    = 0xC104;
	const RETURN_REAL_short    = 0xC105;
	const RETURN_LREAL_short   = 0xC106;
	const RAPORT_FULL_short    = 0xC107;

}
