<?php

namespace Sabre\XML;

/**
 * Test for the ContextStackTrait
 * 
 * @copyright Copyright (C) 2007-2014 fruux GmbH. All rights reserved.
 * @author Evert Pot (http://evertpot.com/) 
 * @license http://sabre.io/license/ Modified BSD License
 */
class ContextStackTest extends \PHPUnit_Framework_TestCase {

    function setUp() {

        $this->stack = $this->getMockForTrait('Sabre\\XML\\ContextStackTrait');

    }

    function testPushAndPull() {

        $this->stack->baseUri = '/foo/bar';
        $this->stack->elementMap['{DAV:}foo'] = 'Bar';
        $this->stack->namespaceMap['DAV:'] = 'd';

        $this->stack->pushContext();

        $this->assertEquals('/foo/bar', $this->stack->baseUri);
        $this->assertEquals('Bar', $this->stack->elementMap['{DAV:}foo']);
        $this->assertEquals('d', $this->stack->namespaceMap['DAV:']);

        $this->stack->baseUri = '/gir/zim';
        $this->stack->elementMap['{DAV:}foo'] = 'newBar';
        $this->stack->namespaceMap['DAV:'] = 'dd';

        $this->stack->popContext();

        $this->assertEquals('/foo/bar', $this->stack->baseUri);
        $this->assertEquals('Bar', $this->stack->elementMap['{DAV:}foo']);
        $this->assertEquals('d', $this->stack->namespaceMap['DAV:']);

    }

}
