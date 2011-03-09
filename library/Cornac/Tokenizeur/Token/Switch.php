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

class Cornac_Tokenizeur_Token_Switch extends Cornac_Tokenizeur_Token_Instruction {
    protected $tname = '_switch';
    protected $block = null;
    protected $condition = null;
    
    function __construct($expression = null) {
        parent::__construct(array());
        
        $this->condition = $expression[0];
        $this->block = $expression[1];
    }

    function __toString() {
        return $this->getTname()." ".$this->code;
    }

    function getCondition() {
        return $this->condition;
    }

    function getBlock() {
        return $this->block;
    }

    function neutralise() {
        $this->condition->detach();
        $this->block->detach();
    }

    function getRegex(){
        return array('Cornac_Tokenizeur_Regex_Switch_Simple',
                     'Cornac_Tokenizeur_Regex_Switch_Alternative',
                    );
    }

}

?>