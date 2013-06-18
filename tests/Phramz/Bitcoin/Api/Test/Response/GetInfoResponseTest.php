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

namespace Phramz\Bitcoin\Api\Test\Response;

use Phramz\Bitcoin\Api\Response\GetInfoResponse;

/**
 * Class GetInfoResponse
 * @package Phramz\Bitcoin\Api\Test\Response
 * @covers Phramz\Bitcoin\Api\Response\GetInfoResponse<extended>
 */
class GetInfoResponseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @param string $json
     */
    public function testGetInstance()
    {
        $response = $this->getMockBuilder('Phramz\Bitcoin\Api\Response\Response')
            ->getMockForAbstractClass();

        $response->expects($this->any())
            ->method('getResult')
            ->will($this->returnValue('foo'));

        $response->expects($this->any())
            ->method('getError')
            ->will($this->returnValue('bar'));

        $response->expects($this->any())
            ->method('getId')
            ->will($this->returnValue('bazz'));

        $test = GetInfoResponse::getInstance($response);

        $this->assertInstanceOf('Phramz\Bitcoin\Api\Response\Response', $test);

        $this->assertEquals('foo', $test->getResult());
        $this->assertEquals('bar', $test->getError());
        $this->assertEquals('bazz', $test->getId());
    }

    public function jsonDataProvider()
    {
        return array(
            array('{"result":{"version":80202,"protocolversion":70001,"walletversion":60000,"balance":0.00000000,"blocks":224314,"timeoffset":-1,"connections":8,"proxy":"","difficulty":4367876.00084220,"testnet":false,"keypoololdest":1371414441,"keypoolsize":101,"paytxfee":0.00000000,"errors":""},"error":null,"id":"curltest"}')
        );
    }
}
