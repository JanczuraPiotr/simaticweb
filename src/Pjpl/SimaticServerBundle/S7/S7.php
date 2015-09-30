<?php

namespace Pjpl\SimaticServerBundle\S7;


class S7 {
    // S7 ID Area (Area that we want to read/write)
    const S7AreaPE = 0x81; // I, E - wejście
    const S7AreaPA = 0x82; // Q, A - wyjście
    const S7AreaMK = 0x83; // F, M - flaga / marker
    const S7AreaDB = 0x84; // D, D - dane
    const S7AreaCT = 0x1C; // C, Z - licznik
    const S7AreaTM = 0x1D; // T, T - timer

		const I = 0x81; // I, E - wejście
    const Q = 0x82; // Q, A - wyjście
    const F = 0x83; // F, M - flaga / marker
    const D = 0x84; // D, D - dane
    const C = 0x1C; // C, Z - licznik
    const T = 0x1D; // T, T - timer

		// Connection types
    const PG = 0x01;
    const OP = 0x02;
    const S7_BASIC = 0x03;
    // Block type
    const Block_OB   = 0x38;
    const Block_DB   = 0x41;
    const Block_SDB  = 0x42;
    const Block_FC   = 0x43;
    const Block_SFC  = 0x44;
    const Block_FB   = 0x45;
    const Block_SFB  = 0x46;
    // Sub Block Type
    const SubBlk_OB  = 0x08;
    const SubBlk_DB  = 0x0A;
    const SubBlk_SDB = 0x0B;
    const SubBlk_FC  = 0x0C;
    const SubBlk_SFC = 0x0D;
    const SubBlk_FB  = 0x0E;
    const SubBlk_SFB = 0x0F;
    // Block languages
    const BlockLangAWL       = 0x01;
    const BlockLangKOP       = 0x02;
    const BlockLangFUP       = 0x03;
    const BlockLangSCL       = 0x04;
    const BlockLangDB        = 0x05;
    const BlockLangGRAPH     = 0x06;
    // PLC Status
    const S7CpuStatusUnknown = 0x00;
    const S7CpuStatusRun     = 0x08;
    const S7CpuStatusStop    = 0x04;
    // Type Var
    const S7TypeBool = 1;
    const S7TypeInt = 1;
		private static $maskByte = [ 0x01,0x02,0x04,0x08,0x10,0x20,0x40,0x80];

		/**
		 * @param array $buffer
		 * @param int $pos
		 * @param int $bit
		 * @return boolean
		 */
    public static function getBitAt(array $buffer, $pos, $bit) {
			$value = $buffer[$pos] & 0x0FF;
			if ( $bit < 0 ){
				$bit = 0;
			}
			if ($bit > 7 ) {
				$bit = 7;
			}
			return (boolean)( ( $value & static::$maskByte[$bit] ) != 0 );
    }
    /**
     * Returns a 16 bit signed value : from -32768 to 32767
     * @param Buffer
     * @param Pos start position
     * @return
     */
    public static function getIntAt(array $buffer, $pos){
			$hi = ($buffer[$pos] & 0x00FF);
			$lo = ($buffer[$pos+1] & 0x00FF);
			return ( $hi << 8 ) + $lo;
    }
		/**
		 * Returns a 32 bit signed value : from 0 to 4294967295 (2^32-1)
		 * @return int
		 */
    public static function getDIntAt(array $buffer, $pos){
			$result;
			$result =  $buffer[$pos];
			$result <<= 8;
			$result += ($buffer[$pos+1] & 0x0FF);
			$result <<= 8;
			$result += ($buffer[$pos+2] & 0x0FF);
			$result <<= 8;
			$result += ($buffer[$pos+3] & 0x0FF);
			return $result;
    }
		/**
		 * Returns a 32 bit floating point
		 * @return decimal
		 */
    public static function getRealAt(array $buffer, $pos){
			$intFloat = $this->getDIntAt($buffer, $pos);
			return floatval($intFloat);
    }

    public static function SetBitAt(array $buffer, $pos, $bit, $value){

        if ($bit<0) $bit=0;
        if ($bit>7) $bit=7;

        if ($value){
					$buffer[$pos]= ($buffer[$pos] | static::$mask[$bit]);
				}else{
					$buffer[$pos]= ($buffer[$pos] & ~ static::$mask[$bit]);
				}
    }
    public static function SetIntAt(array $buffer, $pos, $value){
        $buffer[$pos]   = ($value >> 8);
        $buffer[$pos+1] = ($value & 0x00FF);
    }
    public static function SetDIntAt(array $buffer, $pos, $value){
        $buffer[$pos+3] = ( $value &0xFF);
        $buffer[$pos+2] = (($value >> 8) &0xFF);
        $buffer[$pos+1] = (($value >> 16) &0xFF);
        $buffer[$pos]   = (($value >> 24) &0xFF);
    }
    public static function SetFloatAt(array $buffer, $pos, $value){
        $DInt = Float.floatToIntBits(Value);
        SetDIntAt(Buffer, Pos, DInt);
    }
















//    // Returns a 32 bit unsigned value : from 0 to 4294967295 (2^32-1)
//		/**
//		 * @return long
//		 */
//    public static function getDWordAt(array $buffer, $pos)
//    {
//			$result = 0;
//			$result = ($buffer[$pos] & 0x0FF );
//			$result <<= 8;
//			$result += ($buffer[$pos+1] & 0x0FF);
//			$result <<= 8;
//			$result += ($buffer[$pos+2] & 0x0FF);
//			$result <<= 8;
//			$result += ($buffer[$pos+3] & 0x0FF);
//			return $result;
//    }



//     //Returns an ASCII string
//    public static function getStringAt(array $buffer, $pos, $maxLen)
//    {
//			$strBuffer = array_splice($buffer, $pos, $maxLen);
//			$s = implode($strBuffer);
//			return $s;
//    }

//		/**
//		 * @return string
//		 */
//    public static function getPrintableStringAt(array $buffer, $pos, $maxLen)
//    {
//			$strBuffer = array_splice($buffer, $pos, $maxLen);
//
//        for (int c = 0; c < MaxLen; c++)
//        {
//            if ((StrBuffer[c]<31) || (StrBuffer[c]>126))
//                StrBuffer[c]=46; // '.'
//        }
//        String S;
//        try {
//            S = new String(StrBuffer, "UTF-8"); // the charset is UTF-8
//        } catch (UnsupportedEncodingException ex) {
//            S = "";
//        }
//        return S;
//    }

//    public static Date GetDateAt(byte[] Buffer, int Pos)
//    {
//        int Year, Month, Day, Hour, Min, Sec;
//        Calendar S7Date = Calendar.getInstance();
//
//        Year = S7.BCDtoByte(Buffer[Pos]);
//        if (Year<90)
//            Year+=2000;
//        else
//            Year+=1900;
//
//        Month=S7.BCDtoByte(Buffer[Pos+1])-1;
//        Day  =S7.BCDtoByte(Buffer[Pos+2]);
//        Hour =S7.BCDtoByte(Buffer[Pos+3]);
//        Min  =S7.BCDtoByte(Buffer[Pos+4]);
//        Sec  =S7.BCDtoByte(Buffer[Pos+5]);
//
//        S7Date.set(Year, Month, Day, Hour, Min, Sec);
//
//        return S7Date.getTime();
//    }

//    public static void SetWordAt(byte[] Buffer, int Pos, int Value)
//    {
//        int Word = Value & 0x0FFFF;
//        Buffer[Pos]   = (byte) (Word >> 8);
//        Buffer[Pos+1] = (byte) (Word & 0x00FF);
//    }

//    public static void SetDWordAt(byte[] Buffer, int Pos, long Value)
//    {
//        long DWord = Value &0x0FFFFFFFF;
//        Buffer[Pos+3] = (byte) (DWord &0xFF);
//        Buffer[Pos+2] = (byte) ((DWord >> 8) &0xFF);
//        Buffer[Pos+1] = (byte) ((DWord >> 16) &0xFF);
//        Buffer[Pos]   = (byte) ((DWord >> 24) &0xFF);
//    }




//    public static void SetDateAt(byte[] Buffer, int Pos, Date DateTime)
//    {
//        int Year, Month, Day, Hour, Min, Sec, Dow;
//        Calendar S7Date = Calendar.getInstance();
//        S7Date.setTime(DateTime);
//
//        Year  = S7Date.get(Calendar.YEAR);
//        Month = S7Date.get(Calendar.MONTH)+1;
//        Day   = S7Date.get(Calendar.DAY_OF_MONTH);
//        Hour  = S7Date.get(Calendar.HOUR_OF_DAY);
//        Min   = S7Date.get(Calendar.MINUTE);
//        Sec   = S7Date.get(Calendar.SECOND);
//        Dow   = S7Date.get(Calendar.DAY_OF_WEEK);
//
//        if (Year>1999)
//            Year-=2000;
//
//        Buffer[Pos]  =ByteToBCD(Year);
//        Buffer[Pos+1]=ByteToBCD(Month);
//        Buffer[Pos+2]=ByteToBCD(Day);
//        Buffer[Pos+3]=ByteToBCD(Hour);
//        Buffer[Pos+4]=ByteToBCD(Min);
//        Buffer[Pos+5]=ByteToBCD(Sec);
//        Buffer[Pos+6]=0;
//        Buffer[Pos+7]=ByteToBCD(Dow);
//    }

//    public static int BCDtoByte(byte B)
//    {
//        return ((B >> 4) * 10) + (B & 0x0F);
//    }

//    public static byte ByteToBCD(int Value)
//    {
//        return (byte) (((Value / 10) << 4) | (Value % 10));
//    }

}
