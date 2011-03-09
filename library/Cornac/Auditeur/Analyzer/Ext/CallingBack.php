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


class Cornac_Auditeur_Analyzer_Ext_CallingBack extends Cornac_Auditeur_Analyzer
 {
	protected	$title = 'Function CallingBack';
	protected	$description = 'List of PHP function that uses callback functions.';

	function __construct($mid) {
        parent::__construct($mid);
	}

	function dependsOn() {
	    return array('Functions_Php');
	}

	public function analyse() {
        $this->clean_report();

        $functions = array();
        // callback is in second position
        $functions[1] = array('array_map',
                              'call_user_func',
                              'call_user_func_array');
        // callback is in second position
        $functions[2] = array('usort', 
                              'preg_replace_callback',
                              'uasort',
                              'uksort',
                              'array_reduce',
                              'array_walk',
                              'array_walk_recursive',
                              'mysqli_set_local_infile_handler',
                              );
        // callback is in last position
        $functions[-1] = array('array_diff_uassoc',
                               'array_diff_ukey',
                               'array_intersect_uassoc',
                               'array_intersect_ukey',
                               'array_udiff_assoc',
                               'array_udiff_uassoc',
                               'array_udiff',
                               'array_uintersect_assoc',
                               'array_uintersect_uassoc',
                               'array_uintersect',
                               'array_filter',
                               'array_reduce',
                            );

        $functions = array_merge($functions[1], $functions[2], $functions[-1]);
        
        $functions = "'".join("', '", $functions)."'";

	    $query = <<<SQL
SELECT NULL, TR1.file, TR1.element, TR1.token_id, '{$this->name}', 0
FROM <report> TR1
WHERE TR1.module="Functions_Php" AND 
      TR1.element IN ($functions)
SQL;
        $this->exec_query_insert('report', $query);
        return true;
	}
}

?>