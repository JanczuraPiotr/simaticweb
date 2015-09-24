<?php
/**
 * @author Piotr Janczura <piotr@janczura.pl>
 */
$constBuilderCommandAutoincrement = 1;
define('READ_DB_BLOCK'        , $constBuilderCommandAutoincrement++ );
define('READ_DB_BYTE'         , $constBuilderCommandAutoincrement++ );
define('READ_DB_WORD'         , $constBuilderCommandAutoincrement++ );

define('WRITE_DB_BLOCK'       , $constBuilderCommandAutoincrement++ );
define('WRITE_DB_BYTE'        , $constBuilderCommandAutoincrement++ );
define('WRITE_DB_WORD'        , $constBuilderCommandAutoincrement++ );

class BuilderCommand {
	const READ_DB_BLOCK         = READ_DB_BLOCK;
	const READ_DB_BYTE          = READ_DB_BYTE;
	const READ_DB_WORD          = READ_DB_WORD;
	const WRITE_DB_BLOCK        = WRITE_DB_BLOCK;
	const WRITE_DB_BYTE         = WRITE_DB_BYTE;
	const WRITE_DB_WORD         = WRITE_DB_WORD;
}
