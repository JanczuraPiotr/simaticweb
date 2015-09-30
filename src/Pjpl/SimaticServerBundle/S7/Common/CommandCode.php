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

	const GET_I_BYTE_short  = 0x8001;
	const GET_Q_BYTE_short  = 0x8002;
	const SET_Q_BYTE_short  = 0x8003;
	const GET_D_BYTE_short  = 0x8004;
	const SET_D_BYTE_short  = 0x8005;
	const GET_D_INT_short   = 0x8006;
	const SET_D_INT_short   = 0x8007;
	const GET_D_DINT_short  = 0x8008;
	const SET_D_DINT_short  = 0x8009;
	const GET_D_REAL_short  = 0x800A;
	const SET_D_REAL_short  = 0x800B;
}
