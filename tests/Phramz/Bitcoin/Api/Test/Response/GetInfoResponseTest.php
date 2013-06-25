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
use Phramz\Bitcoin\Api\Test\AbstractTestCase;

/**
 * Class GetInfoResponse
 * @package Phramz\Bitcoin\Api\Test\Response
 * @covers Phramz\Bitcoin\Api\Response\GetInfoResponse<extended>
 */
class GetInfoResponseTest extends AbstractTestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $response = null;

    /**
     * @var GetInfoResponse
     */
    protected $getInfoResponse = null;

    public function setUp()
    {
        $data = $this->getJsonFixture('response_getinfo');

        $response = $this->getMockBuilder('Phramz\Bitcoin\Api\Response\Response')
            ->getMockForAbstractClass();

        $response->expects($this->any())
            ->method('getResult')
            ->will($this->returnValue($data['result']));

        $response->expects($this->any())
            ->method('getError')
            ->will($this->returnValue('bar'));

        $response->expects($this->any())
            ->method('getId')
            ->will($this->returnValue('bazz'));

        $this->response = $response;
        $this->getInfoResponse = GetInfoResponse::getInstance($response);
    }

    public function testGetInstance()
    {
        $test = $this->getInfoResponse;

        $this->assertInstanceOf('Phramz\Bitcoin\Api\Response\Response', $test);

        $result = array (
            'version' => 80202,
            'protocolversion' => 70001,
            'walletversion' => 60000,
            'balance' => 0,
            'blocks' => 224314,
            'timeoffset' => -1,
            'connections' => 8,
            'proxy' => '',
            'difficulty' => 4367876.0008422,
            'testnet' => false,
            'keypoololdest' => 1371414441,
            'keypoolsize' => 101,
            'paytxfee' => 0,
            'errors' => ''
        );

        $this->assertEquals($result, $test->getResult());
        $this->assertEquals('bar', $test->getError());
        $this->assertEquals('bazz', $test->getId());
    }

    public function testGetErrors()
    {
        $this->assertEquals('', $this->getInfoResponse->getErrors());
    }

    public function testgetPayTxFee()
    {
        $this->assertEquals(0, $this->getInfoResponse->getPayTxFee());
    }

    public function testGetKeypoolSize()
    {
        $this->assertEquals(101, $this->getInfoResponse->getKeypoolSize());
    }

    public function testGetKeypoololdest()
    {
        $this->assertEquals(1371414441, $this->getInfoResponse->getKeypoolOldest());
    }

    public function testGetTestnet()
    {
        $this->assertEquals(false, $this->getInfoResponse->getTestnet());
    }

    public function testGetDifficulty()
    {
        $this->assertEquals(4367876.0008422, $this->getInfoResponse->getDifficulty());
    }

    public function testGetProxy()
    {
        $this->assertEquals('', $this->getInfoResponse->getProxy());
    }

    public function testGetConnections()
    {
        $this->assertEquals(8, $this->getInfoResponse->getConnections());
    }

    public function testGetTimeOffset()
    {
        $this->assertEquals(-1, $this->getInfoResponse->getTimeOffset());
    }

    public function testGetBlocks()
    {
        $this->assertEquals('224314', $this->getInfoResponse->getBlocks());
    }

    public function testGetWalletVersion()
    {
        $this->assertEquals('60000', $this->getInfoResponse->getWalletVersion());
    }

    public function testGetVersion()
    {
        $this->assertEquals('80202', $this->getInfoResponse->getVersion());
    }

    public function testGetBalance()
    {
        $this->assertEquals(0.00000000, $this->getInfoResponse->getBalance());
    }

    public function testGetProtocolVersion()
    {
        $this->assertEquals(70001, $this->getInfoResponse->getProtocolVersion());
    }
}
