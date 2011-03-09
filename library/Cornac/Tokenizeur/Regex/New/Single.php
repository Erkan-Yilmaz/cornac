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

class Cornac_Tokenizeur_Regex_New_Single extends Cornac_Tokenizeur_Regex {
    protected $tname = 'new_single_regex';

    function __construct() {
        parent::__construct(array());
    }

    function getTokens() {
        return array(T_NEW);
    }
    
    function check($t) {
        if (!$t->hasNext()) { return false; }

        if ($t->getNext()->checkNotClass('_constant')) { return false; }

        $this->args = array(1);
        $this->remove = array(1);

        Cornac_Log::getInstance('tokenizer')->log(get_class($t)." => ".$this->getTname());
        return true; 
    }
}
?>