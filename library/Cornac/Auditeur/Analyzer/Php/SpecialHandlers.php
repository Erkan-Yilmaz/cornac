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


class Cornac_Auditeur_Analyzer_Php_SpecialHandlers extends Cornac_Auditeur_Analyzer
 {
	protected	$title = 'Php special handlers';
	protected	$description = 'Spot usage of PHP special handlers, such as session handler, error handler, etc.';

	function __construct($mid) {
        parent::__construct($mid);
	}

	function dependsOn() {
	    return array('Functions_Php');
	}

	public function analyse() {
        $this->clean_report();

        $in = Cornac_Auditeur_Analyzer::getPHPHandlers();
        $this->in = '"'.join('", "', $in).'"';

	    $query = <<<SQL
SELECT NULL, T1.file, T1.element, T1.id, '{$this->name}', 0
FROM <report> T1
WHERE T1.module = 'Functions_Php' AND
      T1.element IN ({$this->in})
SQL;
        $this->exec_query_insert('report', $query);

        return true;
	}
}

?>