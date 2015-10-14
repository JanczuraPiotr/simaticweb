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


//	/**
//	 * @prace prawdopodobnie poniższe stałe zostały zapisane na wyrost i nie będą używane
//	 */
//	const I_GET_BYTE_short  = 0xC001;
//	const Q_GET_BYTE_short  = 0xC002;
//	const Q_SET_BYTE_short  = 0xC003;
//	const D_GET_BYTE_short  = 0xC004;
//	const D_SET_BYTE_short  = 0xC005;
//	const D_GET_INT_short   = 0xC006;
//	const D_SET_INT_short   = 0xC007;
//	const D_GET_DINT_short  = 0xC008;
//	const D_SET_DINT_short  = 0xC009;
//	const D_GET_REAL_short  = 0xC00A;
//	const D_SET_REAL_short  = 0xC00B;

}
