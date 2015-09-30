<?php
namespace Pjpl\SimaticServerBundle\S7\Common;

class TypeCode {
	const BIT   = 0;
	const BYTE  = 1;
	const INT   = 2;
	const DINT  = 3;
	const REAL  = 4;
	const LREAL = 5;

	const size = [
			BIT   => 1,
			INT   => 2,
			DINT  => 4,
			REAL  => 4,
			LREAL => 8
	];

	const name = [
			BIT   => 'Byte',
			INT   => 'Int',
			DINT  => 'DInt',
			REAL  => 'Real',
			LREAL => 'LReal'
	];
}
