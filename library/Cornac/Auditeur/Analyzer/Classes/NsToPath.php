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
   | Author: Damien Seguy <damien.seguy@alterway.fr>                      |
   +----------------------------------------------------------------------+
 */


class Cornac_Auditeur_Analyzer_Classes_NsToPath extends Cornac_Auditeur_Analyzer
 {
	protected	$title = 'Namespace In Path';
	protected	$description = 'PHP 5.2 way of organizing files : namespace in the class name. A_B_C => A/B/C.php';

	function __construct($mid) {
        parent::__construct($mid);
	}

	public function analyse() {
        $this->clean_report();

	    $query = <<<SQL
SELECT NULL, T1.file, T1.code, T1.id, '{$this->name}', 0
FROM <tokens> T1
WHERE T1.type='_classname_' AND
      T1.file NOT REGEXP concat(replace(code, '_', '/'),'.php')
SQL;
        $this->exec_query_insert('report', $query);

        return true;
	}
}

?>