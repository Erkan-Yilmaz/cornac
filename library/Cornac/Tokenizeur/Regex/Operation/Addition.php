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

class Cornac_Tokenizeur_Regex_Operation_Addition extends Cornac_Tokenizeur_Regex {
    protected $tname = 'operation_addition_regex';

    function __construct() {
        parent::__construct(array());
    }

    function getTokens() {
        return array('+','-');
    }    
    function check($t) {
        if (!$t->hasPrev() ) { return false; }
        if (!$t->hasNext(1)) { return false; }

        if ($t->checkNotCode(array('+','-'))) { return false;}
        if ($t->checkNotClass("Token")) { return false;} 
        if ($t->getPrev()->checkClass(array('Token','arglist'))) { return false;}
        if ($t->getNext()->checkClass('Token')) { return false;}
        
        if (
            $t->getNext(1)->checkNotCode(array('*','/','%','[','->','::','{','(','++','--')) &&
            !$t->getNext(1)->checkForAssignation() &&
            $t->getPrev(1)->checkBeginInstruction()
            
            ) {

            $this->args = array(-1, 0, 1);
            $this->remove = array(-1, 1);

            Cornac_Log::getInstance('tokenizer')->log(get_class($t)." => operation addition  (".$this->getTname().")");
            return true; 
        } 
        return false;
    }
}
?>