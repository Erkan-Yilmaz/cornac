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

class Cornac_Tokenizeur_Token_Cast extends Cornac_Tokenizeur_Token_Instruction {
    protected $tname = 'cast';
    protected $cast = null;
    protected $expression = null;
    
    function __construct($expression) {
        parent::__construct(array());

        $this->cast = $this->makeProcessed('_cast_', $expression[0]);
        $this->expression = $expression[1];
    }

    function __toString() {
        return $this->getTname()." ".$this->code;
    }

    function getCast() {
        return $this->cast;
    }

    function getExpression() {
        return $this->expression;
    }

    function neutralise() {
        $this->cast->detach();
        $this->expression->detach();
    }

    function getRegex(){
        return array('Cornac_Tokenizeur_Regex_Cast'
                    );
    }

}

?>