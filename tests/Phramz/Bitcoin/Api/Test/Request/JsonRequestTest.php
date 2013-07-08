<?php
/**
 * Copyright (c) 2012-2013 Maximilian Reichel <info@phramz.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Phramz\Bitcoin\Api\Test\Request;

use Phramz\Bitcoin\Api\Request\JsonRequest;

/**
 * Class JsonRequestTest
 * @package Phramz\Bitcoin\Api\Test\Request
 * @covers Phramz\Bitcoin\Api\Request\JsonRequest<extended>
 */
class JsonRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $test = new JsonRequest('test', array('foo'), 'bar');

        $this->assertInstanceOf('Phramz\Bitcoin\Api\Request\Request', $test);
        $this->assertEquals('test', $test->getMethod());
        $this->assertEquals(array('foo'), $test->getParams());
        $this->assertEquals('bar', $test->getId());

        $test = new JsonRequest('test', array('foo'), null);
        $this->assertEquals('test', $test->getMethod());
        $this->assertEquals(array('foo'), $test->getParams());
        $this->assertNotEmpty($test->getId());
    }

    public function testGetMethod()
    {
        $test = new JsonRequest('test', array('foo'), 'bar');

        $this->assertEquals('test', $test->getMethod());
    }

    public function testGetParams()
    {
        $test = new JsonRequest('test', array('foo'), 'bar');

        $this->assertEquals(array('foo'), $test->getParams());
    }

    public function testGetId()
    {
        $test = new JsonRequest('test', array('foo'), 'bar');

        $this->assertEquals('bar', $test->getId());
    }

    public function testToJson()
    {
        $test = new JsonRequest('test', array('foo'), 'bar');

        $this->assertEquals('{"jsonrpc":"1.0","id":"bar","method":"test","params":["foo"]}', $test->toJson());
        $this->assertEquals('{"jsonrpc":"1.0","id":"bar","method":"test","params":["foo"]}', $test->getContent());
    }
}
