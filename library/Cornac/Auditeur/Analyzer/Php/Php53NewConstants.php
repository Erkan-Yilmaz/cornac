<?php
/*
   +----------------------------------------------------------------------+
   | Cornac, PHP code inventory                                           |
   +----------------------------------------------------------------------+
   | Copyright (c) 2010 - 2011                                            |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.php.net/license/3_01.txt                                  |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Author: Damien Seguy <damien.seguy@gmail.com>                        |
   +----------------------------------------------------------------------+
 */


class Cornac_Auditeur_Analyzer_Php_Php53NewConstants extends Cornac_Auditeur_Analyzer
 {
	protected	$title = 'Title for Php_Php53NewConstants';
	protected	$description = 'This is the special analyzer Php_Php53NewConstants (default doc).';

	function __construct($mid) {
        parent::__construct($mid);
	}

// @doc if this analyzer is based on previous result, use this to make sure the results are here
	function dependsOn() {
	    return array("Constants_Definitions");
	}

	public function analyse() {
        $this->clean_report();

        $in = '"'.join("','", array(
'__DIR__',
'__NAMESPACE__',
'E_DEPRECATED',
'E_USER_DEPRECATED',
'INI_SCANNER_NORMAL',
'INI_SCANNER_RAW',
'PHP_MAXPATHLEN',
'PHP_WINDOWS_NT_DOMAIN_CONTROLLER',
'PHP_WINDOWS_NT_SERVER',
'PHP_WINDOWS_NT_WORKSTATION',
'PHP_WINDOWS_VERSION_BUILD',
'PHP_WINDOWS_VERSION_MAJOR',
'PHP_WINDOWS_VERSION_MINOR',
'PHP_WINDOWS_VERSION_PLATFORM',
'PHP_WINDOWS_VERSION_PRODUCTTYPE',
'PHP_WINDOWS_VERSION_SP_MAJOR',
'PHP_WINDOWS_VERSION_SP_MINOR',
'PHP_WINDOWS_VERSION_SUITEMASK',
'CURLOPT_PROGRESSFUNCTION',
'IMG_FILTER_PIXELATE',
'JSON_ERROR_CTRL_CHAR',
'JSON_ERROR_DEPTH',
'JSON_ERROR_NONE',
'JSON_ERROR_STATE_MISMATCH',
'JSON_ERROR_SYNTAX',
'JSON_FORCE_OBJECT',
'JSON_HEX_TAG',
'JSON_HEX_AMP',
'JSON_HEX_APOS',
'JSON_HEX_QUOT',
'LDAP_OPT_NETWORK_TIMEOUT',
'LIBXML_LOADED_VERSION',
'PREG_BAD_UTF8_OFFSET_ERROR',
'BUS_ADRALN',
'BUS_ADRERR',
'BUS_OBJERR',
'CLD_CONTIUNED',
'CLD_DUMPED',
'CLD_EXITED',
'CLD_KILLED',
'CLD_STOPPED',
'CLD_TRAPPED',
'FPE_FLTDIV',
'FPE_FLTINV',
'FPE_FLTOVF',
'FPE_FLTRES',
'FPE_FLTSUB',
'FPE_FLTUND',
'FPE_INTDIV',
'FPE_INTOVF',
'ILL_BADSTK',
'ILL_COPROC',
'ILL_ILLADR',
'ILL_ILLOPC',
'ILL_ILLOPN',
'ILL_ILLTRP',
'ILL_PRVOPC',
'ILL_PRVREG',
'POLL_ERR',
'POLL_HUP',
'POLL_IN',
'POLL_MSG',
'POLL_OUT',
'POLL_PRI',
'SEGV_ACCERR',
'SEGV_MAPERR',
'SI_ASYNCIO',
'SI_KERNEL',
'SI_MESGQ',
'SI_NOINFO',
'SI_QUEUE',
'SI_SIGIO',
'SI_TIMER',
'SI_TKILL',
'SI_USER',
'SIG_BLOCK',
'SIG_SETMASK',
'SIG_UNBLOCK',
'TRAP_BRKPT',
'TRAP_TRACE',)).'"';

	    $query = <<<SQL
SELECT NULL, T1.file, T1.element, T1.id, '{$this->name}', 0
FROM <report> T1
WHERE T1.element IN ($in)
SQL;
        $this->exec_query_insert('report', $query);

        return true;
	}
}

?>