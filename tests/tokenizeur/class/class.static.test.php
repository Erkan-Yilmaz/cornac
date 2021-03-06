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
include_once('../../library/Cornac/Autoload.php');
spl_autoload_register('Cornac_Autoload::autoload');

class Static_Test extends Cornac_Tests_Tokenizeur
{
    /* 8 methodes */
    public function testStatic1()  { $this->generic_test('static.1'); }
    public function testStatic2()  { $this->generic_test('static.2'); }
    public function testStatic3()  { $this->generic_test('static.3'); }
    public function testStatic4()  { $this->generic_test('static.4'); }
    public function testStatic5()  { $this->generic_test('static.5'); }
    public function testStatic6()  { $this->generic_test('static.6'); }
    public function testStatic7()  { $this->generic_test('static.7'); }
    public function testStatic8()  { $this->generic_test('static.8'); }

}

?>