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

class Cornac_Tokenizeur_Regex_Class extends Cornac_Tokenizeur_Regex {
    function __construct() {
        parent::__construct(array());
    }

    function getTokens() {
        return array(T_CLASS);
    }
    
    function check($t) {
        if (!$t->hasNext(1)) { return false; }


        if ($t->getNext()->checkToken(T_STRING)) {
              $this->args = array(1);
              $this->remove = array(1);
              $pos = 1;
              $var = $t->getNext(1);
              
              if ($var->checkToken(T_EXTENDS)) {
                  $pos++;
                  $this->args[]   = $pos;
                  $this->remove[] = $pos;

                  $pos++;
                  $this->args[]   = $pos;
                  $this->remove[] = $pos;

                  $var = $var->getNext(1);
              }
              
              if ($var->checkToken(T_IMPLEMENTS)) {
                  $pos++;
                  $this->args[]   = $pos;
                  $this->remove[] = $pos;

                  $pos++;
                  $this->args[]   = $pos;
                  $this->remove[] = $pos;

                  $var = $var->getNext(1);
                  
                  while($var->checkCode(',')) {
                      $pos++;
                      $this->args[]   = $pos;
                      $this->remove[] = $pos;

                      $pos++;
                      $this->args[]   = $pos;
                      $this->remove[] = $pos;

                      $var = $var->getNext(1);
                  }
              }
              
              if ($var->checkClass('block')) {
                  $pos++;
                  $this->args[]   = $pos;
                  $this->remove[] = $pos;
                  
                  if ($t->hasPrev() && $t->getPrev()->checkToken(array(T_ABSTRACT, T_FINAL))) {
                      $this->args[] = -1;
                      $this->remove[] = -1;
                      
                      sort($this->args);
                      sort($this->remove);
                  }

                  Cornac_Log::getInstance('tokenizer')->log(get_class($t)." => ".$this->getTname());
                  return true;
              }
              
              // @note we couldn't understand this. Aborting
              $this->args = array();
              $this->remove = array();
              return false;
        } else {
            return false;
        }
    }
}

?>