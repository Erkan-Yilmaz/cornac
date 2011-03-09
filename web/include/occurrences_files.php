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
 
 $query = <<<SQL
 SELECT element AS file, 
                       file AS element, 
                       COUNT(*) AS nb,
                       id,
                       COUNT(*) = SUM(checked) AS checked
                   FROM <report> 
                   WHERE module='{$_CLEAN['module']}'
                   GROUP BY element, file
SQL;
    $res = $DATABASE->query($query);
    
    $rows = array();
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $rows[$row['file']][] = $row; 
    }
        
    print get_html_level2($rows, $_CLEAN['module']);
?>