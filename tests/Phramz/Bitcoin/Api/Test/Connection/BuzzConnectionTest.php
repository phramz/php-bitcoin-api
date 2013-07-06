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
namespace Phramz\Bitcoin\Api\Test\Connection;

use Phramz\Bitcoin\Api\Connection\BuzzConnection;

/**
 * Class BuzzConnectionTest
 * @package Phramz\Bitcoin\Api\Test\Connection
 * @covers Phramz\Bitcoin\Api\Connection\BuzzConnection<extended>
 */
class BuzzConnectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $browser = null;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $request = null;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $response = null;

    public function setUp()
    {
        $this->request = $this->getMockBuilder('Phramz\Bitcoin\Api\Request\Request')
            ->getMockForAbstractClass();

        $this->response = $this->getMockBuilder('Buzz\Message\Response')
            ->setMethods(array('getContent', 'getStatusCode'))
            ->getMock();

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->will($this->returnValue(200));

        $this->browser = $this->getMockBuilder('Buzz\Browser')
            ->disableOriginalConstructor()
            ->setMethods(array('post'))
            ->getMock();
    }

    public function testConstruct()
    {
        $host = '127.0.0.1';
        $port = '1234';
        $username = 'foo';
        $password = 'bar';

        $test = new BuzzConnection($this->browser, $host, $port, $username, $password);
        $this->assertInstanceOf('Phramz\Bitcoin\Api\Connection\Connection', $test);
        $this->assertEquals($host, $test->getHost());
        $this->assertEquals($port, $test->getPort());
        $this->assertEquals($username, $test->getUsername());
        $this->assertEquals($password, $test->getPassword());
    }

    public function testQuery()
    {
        $host = '127.0.0.1';
        $port = '1234';
        $username = 'foo';
        $password = 'bar';

        $json = '{"result":0.00000000,"error":null,"id":"d3d10d420ee9184b5b05be7ea46aa828"}';

        $this->request->expects($this->atLeastOnce())
            ->method('getContent')
            ->will($this->returnValue('foobar'));

        $this->response->expects($this->atLeastOnce())
            ->method('getContent')
            ->will($this->returnValue($json));

        $this->browser->expects($this->atLeastOnce())
            ->method('post')
            ->with(
                'http://'. $host . ':' . $port,
                array (
                    'Content-type' => 'application/json',
                    'Authorization: Basic '.base64_encode($username.':'.$password)
                ),
                'foobar'
            )
            ->will($this->returnValue($this->response));

        $test = new BuzzConnection($this->browser, $host, $port, $username, $password);
        $response = $test->query($this->request);

        $this->assertInstanceOf('Phramz\Bitcoin\Api\Response\Response', $response);
        $this->assertEquals($json, $response->getContent());
    }
}
