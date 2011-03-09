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

class Cornac_Tokenizeur_Token_Staticproperty extends Cornac_Tokenizeur_Token {
    protected $tname = 'property_static';

    protected $class = null;
    protected $property = null;
    
    function __construct($expression) {
        parent::__construct();
        
        if ($expression[0]->checkClass('Token')) {
            $this->class = $this->makeProcessed('_classname_', $expression[0]);
        } else {
            $this->class = $expression[0];
        }
        $this->property = $expression[1];
    }

    function getClass() {  
        return $this->class;
    }

    function getProperty() {
        return $this->property;
    }

    function neutralise() {
        $this->class->detach();
        $this->property->detach();
    }

    function __toString() {
        return $this->getTname()." ".$this->class."::".$this->property;
    }

    function getRegex(){
        return array('Cornac_Tokenizeur_Regex_Staticproperty');
    }

}

?>