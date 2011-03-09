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

class Cornac_Tokenizeur_Regex_Return_Empty extends Cornac_Tokenizeur_Regex {
    protected $tname = 'return_empty_regex';

    function __construct() {
        parent::__construct(array());
    }

    function getTokens() {
        return array(T_RETURN);
    }
    
    function check($t) {
        if (!$t->hasNext(1)) { return false; }

        if ($t->checkToken(array(T_RETURN)) &&
            $t->getNext()->checkCode(';')
            ) {
              $this->args = array();
              $this->remove = array();
  
              Cornac_Log::getInstance('tokenizer')->log(get_class($t)." => ".$this->getTname());
              return true;
        } else {
            return false;
        }
    }
}

?>