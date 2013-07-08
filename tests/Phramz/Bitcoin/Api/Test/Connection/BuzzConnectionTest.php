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
use Phramz\Bitcoin\Api\Test\AbstractTestCase;

/**
 * Class BuzzConnectionTest
 * @package Phramz\Bitcoin\Api\Test\Connection
 * @covers Phramz\Bitcoin\Api\Connection\BuzzConnection<extended>
 */
class BuzzConnectionTest extends AbstractTestCase
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

    /**
     * @expectedException \Phramz\Bitcoin\Api\Exception\TransportException
     */
    public function testQueryTransportException()
    {
        $this->browser->expects($this->any())
            ->method('post')
            ->will($this->throwException(new \Exception('foo')));

        $test = new BuzzConnection($this->browser, 'foo', 'bar', 'bazz', 'foobar');
        $test->query($this->request);
    }

    /**
     * @expectedException \Phramz\Bitcoin\Api\Exception\AuthenticationException
     */
    public function testQueryAuthenticationException()
    {
        $this->browser->expects($this->any())
            ->method('post')
            ->will($this->returnValue($this->response));

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->will($this->returnValue(401));

        $test = new BuzzConnection($this->browser, 'foo', 'bar', 'bazz', 'foobar');
        $test->query($this->request);
    }

    /**
     * @expectedException \Phramz\Bitcoin\Api\Exception\TransportException
     */
    public function testQueryTransportExceptionInvalidStatusCode()
    {
        $json = $this->getJsonFixtureRaw('response_getbalance');

        $this->browser->expects($this->any())
            ->method('post')
            ->will($this->returnValue($this->response));

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->will($this->returnValue(500));

        $this->response->expects($this->atLeastOnce())
            ->method('getContent')
            ->will($this->returnValue($json));

        $test = new BuzzConnection($this->browser, 'foo', 'bar', 'bazz', 'foobar');
        $test->query($this->request);
    }

    /**
     * @expectedException \Phramz\Bitcoin\Api\Exception\TransportException
     */
    public function testQueryTransportExceptionInvalidResponse()
    {
        $this->browser->expects($this->any())
            ->method('post')
            ->will($this->returnValue(new \stdClass()));

        $test = new BuzzConnection($this->browser, 'foo', 'bar', 'bazz', 'foobar');
        $test->query($this->request);
    }

    public function testQuery()
    {
        $host = '127.0.0.1';
        $port = '1234';
        $username = 'foo';
        $password = 'bar';

        $json = $this->getJsonFixtureRaw('response_getbalance');

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->will($this->returnValue(200));

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
