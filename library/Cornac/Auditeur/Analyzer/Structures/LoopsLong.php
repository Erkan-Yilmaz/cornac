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


class Cornac_Auditeur_Analyzer_Structures_LoopsLong extends Cornac_Auditeur_Analyzer
 {
	protected	$title = 'Long loops';
	protected	$description = 'Spot loops that have too many lines (more than 10).';
	protected   $tags = array('quality');

	function __construct($mid) {
        parent::__construct($mid);
	}

	function dependsOn() {
	    return array();
	}

	public function analyse() {
        $this->clean_report();

	    $query = <<<SQL
SELECT NULL, T1.file, TC.code, T1.id, '{$this->name}', 0
FROM <tokens> T1
JOIN <tokens> T2
    ON T2.file = T1.file AND
       T2.left = T1.right + 1
JOIN <tokens_cache> TC
    ON T1.id = TC.id
WHERE T1.type IN ('_for','_while','_do','_foreach') AND
      T2.line - T1.line > 10
SQL;
        $this->exec_query_insert('report', $query);

        return true;
	}
}

?>