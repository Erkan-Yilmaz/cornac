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

class Cornac_Tokenizeur_Token_Use extends Cornac_Tokenizeur_Token_Instruction {
    protected $tname = '_use';
    protected $namespace = null;
    protected $alias = null;
    
    function __construct($expression) {
        parent::__construct(array());
        
        $this->namespace = $expression[0];
        
        if (isset($expression[1])) {
            $this->alias = $this->makeProcessed('_usednsname_', $expression[1]);
        }
    }

    function __toString() {
        $return = "use ".$this->namespace;
        if (!is_null($this->alias)) {
            $return .= " as ".$this->alias;
        }
        return $return;
    }

    function getNamespace() {
        return $this->namespace;
    }

    function getAlias() {
        return $this->alias;
    }

    function neutralise() {
        $this->namespace->detach();
        if (!is_null($this->alias)) {
            $this->alias->detach();
        }
    }

    function getRegex(){
        return array('Cornac_Tokenizeur_Regex_Use_Simple',
                    );
    }

}

?>