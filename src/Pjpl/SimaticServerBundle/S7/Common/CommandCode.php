<?php
namespace Pjpl\SimaticServerBundle\S7\Common;
/**
 * @todo Description of CommandCode
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class CommandCode {
	const OK_short = 0x0000;
	const NO_short = 0xFFFF;

	// Stałe ogólne
	// 000000000000000B -> 0000111111111111B => 0x0000 -> 0x0FFF => 0 ->  4095

	// Stałe wewnętrzne biblioteki pjpl.s7
	// 000100000000000B -> 0001111111111111B => 0x1000 -> 0x1FFF => 4096 ->  8191

	// nieprzydzielone:
	// 001000000000000B -> 0011111111111111B => 0x2000 -> 0x3FFF =>   8192 -> 16383


	// Kody od 0x8000 wydzielone są dla klas definiujących algorytmy do wykonania w ramach procesu do którego są skierowane.
	// Kod może wymagać parametrów do pracy i te umieszczone są w tym samym buforze zaraz za nim. Obsługą kody wraz z
	// odczytaniem parametrów i wykonaniem algorytmu w ramach procesu zajmują się obiekty klas pochodnych po Command.

	// Kody komend
	// 100000000000000B -> 1011111111111111B => 0x8000 -> 0xBFFF =>  32768 -> 49151
	const I_GET_BYTE_short  = 0x8001;
	const Q_GET_BYTE_short  = 0x8002;
	const Q_SET_BYTE_short  = 0x8003;
	const D_GET_BYTE_short  = 0x8004;
	const D_SET_BYTE_short  = 0x8005;
	const D_GET_INT_short   = 0x8006;
	const D_SET_INT_short   = 0x8007;
	const D_GET_DINT_short  = 0x8008;
	const D_SET_DINT_short  = 0x8009;
	const D_GET_REAL_short  = 0x800A;
	const D_SET_REAL_short  = 0x800B;

	// Kody odpowiedzi na komendy. Definicje w ResponseCode
	// 110000000000000B -> 1111111111111111B => 0xC000 -> 0xCFFF =>  49152 -> 65535
}
