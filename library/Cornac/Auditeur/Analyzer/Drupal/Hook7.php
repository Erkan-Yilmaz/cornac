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


class Cornac_Auditeur_Analyzer_Drupal_Hook7 extends Cornac_Auditeur_Analyzer {
	protected	$title = 'Spot Drupal hooks';
	protected	$description = 'Spot function with Drupal7 hook suffixes. The more there are, the more likely the file will be a Drupal 7 module';

	function __construct($mid) {
        parent::__construct($mid);
        $this->hook_regexp = '_('.join('|',Cornac_Auditeur_Analyzer::getDrupal7Hooks()).')$';
	}

	function dependsOn() {
	    return array('Functions_Definitions');
	}

	public function analyse() {
        $this->clean_report();

	    $query = <<<SQL
SELECT NULL, T1.file, T1.element, T1.id, '{$this->name}', 0
    FROM <report> T1
    WHERE T1.module = 'Functions_Definitions' AND
          T1.element REGEXP '{$this->hook_regexp}'
SQL;
        $this->exec_query_insert('report', $query);

        return true;
	}
}

?>