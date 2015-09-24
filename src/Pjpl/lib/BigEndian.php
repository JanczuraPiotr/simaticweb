<?php
namespace Pjpl\lib;
/**
 * Odczyt i zapis danych do bufora w porządku big endian.
 * Zmienne występują w formacie litle endian.
 * Ich obraz w buff lub string zwracany z metod xxxxPack występują w formacie big endian
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class BigEndian {
	public static function byteToArray($byte, array & $buff = null, $start = 0){
		// @todo obsługa błędów w BigEndian
		if( $buff && ( $start < count($buff))){
			$buff[$start] = $byte & 0x000000FF;
		}else{
			return [$byte & 0x000000FF];
		}
	}
	public static function byteToPack($byte){
		// @todo obsługa błędów w BigEndian
		return pack("c",$byte);
	}
	public static function byteFromArray(array $buff, $start){
		// @todo obsługa błędów w BigEndian
		return $buff[$start];
	}
	public static function byteFromPack($pack){
		// @todo obsługa błędów w BigEndian
		return unpack("cbyte", $pack)['byte'];
	}
	public static function shortToArray($short, array &$buff = null, $start = 0){
		// @todo obsługa błędów w BigEndian
		if( $buff && ( $start + 1 < count($buff) ) ){
			$buff[$start] = ( ( $short & 0x0000FF00 ) >> 8 );
			$buff[$start+1] = ( $short & 0x000000FF );
		}else{
			return [
					( $short & 0x0000FF00 ) >> 8 ,
					( $short & 0x000000FF )
			];
		}
	}
	public static function shortToPack($short){
		// @todo obsługa błędów w BigEndian
		return pack("n", $short);
	}
	public static function shortFromArray(array &$buff, $start){
		// @todo obsługa błędów w BigEndian
		return (
				( ($buff[$start] & 0x000000FF ) << 8 )
				+ ( $buff[$start+1] & 0x000000FF )
		);
	}
	public static function shortFromPack($pack){
		// @todo obsługa błędów w BigEndian
		return unpack("nshort",$pack)['short'];
	}
	public static function intToArray($int, array &$buff = null, $start = 0){
		// @todo obsługa błędów w BigEndian
		if( $buff && ( $start + 3 < count($buff)) ){
			$buff[$start]     = ( ($int >> 24) & 0x000000FF );
			$buff[$start + 1] = ( ($int >> 16) & 0x000000FF );
			$buff[$start + 2] = ( ($int >> 8 ) & 0x000000FF );
			$buff[$start + 3] = ( ($int)       & 0x000000FF );
		}else{
			return [
					( ($int >> 24) & 0x000000FF ),
					( ($int >> 16) & 0x000000FF ),
					( ($int >> 8 ) & 0x000000FF ),
					( ($int)       & 0x000000FF )
			];
		}
	}
	public static function intToPack($int){
		// @todo obsługa błędów w BigEndian
		return pack("N", $int);
	}
	public static function intFromArray(array &$buff, $start){
		// @todo obsługa błędów w BigEndian
		return (
				( ( $buff[$start] & 0x000000FF ) << 24 )
				+ ( ( $buff[$start  + 1] & 0x000000FF ) << 16 )
				+ ( ( $buff[$start  + 2] & 0x000000FF ) << 8 )
				+ ( ( $buff[$start  + 3] & 0x000000FF ) )
		);

	}
	public static function intFromPack($pack){
		// @todo obsługa błędów w BigEndian
		return unpack("Nint", $pack)['int'];
	}
	public static function floatToArray($float, array &$buff, $start){
		// @todo obsługa błędów w BigEndian
		$pack = pack("f",$float);
		$packSize = strlen($pack);
		if($buff && ( $start + 3 < count($buff))){
			for( $i = $packSize - 1; $i >= 0; $i--){
				$buff[$start++] = ord(substr($pack,$i,1));
			}
		}else{
			$ret = [];
			for( $i = $packSize - 1; $i >= 0; $i--){
				$ret[] = ord(substr($pack,$i,1));
			}
			return $ret;
		}
	}
	public static function floatToPack($float){
		// @todo obsługa błędów w BigEndian
		$tmp = pack("f",$float);
		for( $i = strlen($tmp) - 1; $i >= 0; $i--){
			$pack[] = substr($tmp, $i,1);
		}
		return implode("", $pack);
	}
	public static function floatFromArray(array &$buff, $start){
		// @todo obsługa błędów w BigEndian
		$arr = [];
		for( $i = $start + 3 ; $i >= $start; $i-- ){
			$arr[] = chr($buff[$i]);
		}
		$pack = implode("", $arr);
		return unpack("ffloat", $pack)["float"];
	}
	public static function floatFromPack($pack){
		// @todo obsługa błędów w BigEndian
		$tmp = $pack;
		$pack = [];
		$tmpCount = strlen($tmp);
		for( $i = $tmpCount; $i >= 0; $i-- ){
			$pack[] = substr($tmp, $i,1);
		}
		$pack = implode("", $pack);
		return unpack("ffloat", $pack)['float'];
	}






//  @todo problem z BigEndian::long
//  @todo problem z BigEndian::double
//	public static function longToArray($long, array $buff = null, $start = 0){
//		// @todo obsługa błędów w BigEndian
//		if( $buff && ( $start + 8 < count($buff)) ){
//			$buff[$start]     = ( ($int >> 56) & 0x00000000000000FF );
//			$buff[$start + 1] = ( ($int >> 48) & 0x00000000000000FF );
//			$buff[$start + 2] = ( ($int >> 40) & 0x00000000000000FF );
//			$buff[$start + 3] = ( ($int >> 32) & 0x00000000000000FF );
//			$buff[$start + 4] = ( ($int >> 24) & 0x00000000000000FF );
//			$buff[$start + 5] = ( ($int >> 16) & 0x00000000000000FF );
//			$buff[$start + 6] = ( ($int >> 8 ) & 0x00000000000000FF );
//			$buff[$start + 7] = ( ($int)       & 0x00000000000000FF );
//		}else{
//			return [
//					($int >> 56) & 0x00000000000000FF ,
//					($int >> 48) & 0x00000000000000FF ,
//					($int >> 40) & 0x00000000000000FF ,
//					($int >> 32) & 0x00000000000000FF ,
//					($int >> 24) & 0x00000000000000FF ,
//					($int >> 16) & 0x00000000000000FF ,
//					($int >> 8 ) & 0x00000000000000FF ,
//					($int)       & 0x00000000000000FF
//			];
//		}
//	}
//	public static function longToPack($long){
//		// @todo obsługa błędów w BigEndian
//		return pack("J",$long);
//	}
//	public static function longFromArray(array $buff, $start){
//		// @todo obsługa błędów w BigEndian
//		return (
//				  ( ($buff[$start]     & 0x00000000000000FF) << 56)
//				+ ( ($buff[$start + 1] & 0x00000000000000FF) << 48)
//				+ ( ($buff[$start + 2] & 0x00000000000000FF) << 40)
//				+ ( ($buff[$start + 3] & 0x00000000000000FF) << 32)
//				+ ( ($buff[$start + 4] & 0x00000000000000FF) << 24)
//				+ ( ($buff[$start + 5] & 0x00000000000000FF) << 16)
//				+ ( ($buff[$start + 6] & 0x00000000000000FF) << 8 )
//				+ ( ($buff[$start + 7] & 0x00000000000000FF))
//		);
//	}
//	public static function longFromPack($pack){
//		// @todo obsługa błędów w BigEndian
//		return unpack("Jlong", $pack)['long'];
//	}
//
}
