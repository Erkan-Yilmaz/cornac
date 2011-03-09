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

class Cornac_Tokenizeur_Token_Nsname extends Cornac_Tokenizeur_Token_Instruction {
    protected $tname = '_nsname';
    protected $namespace = array();
    
    function __construct($expression) {
        parent::__construct(array());
        
        foreach($expression as $e) {
            if ($e->checkToken(T_NS_SEPARATOR)) {
                $f = $this->makeProcessed('_nsseparator_',$e);
                $this->namespace[] = $f;
                $f->setCode('\\');
            } elseif ($e->checkClass('Token')) {
                $this->namespace[] = $this->makeProcessed('_nsname_', $e);
            } else {
                $this->namespace[] = $e;
            }
        }
    }

    function __toString() {
        return join('\\', $this->namespace);
    }

    function getNamespace() {
        return $this->namespace;
    }

    function neutralise() {
        foreach($this->namespace as $e) {
            $e->detach();
        }
    }

    function getRegex(){
        return array('Cornac_Tokenizeur_Regex_Nsname',
                    );
    }
    
    function getToken() {
        return T_NAMESPACED_NAME;
    }
}

?>