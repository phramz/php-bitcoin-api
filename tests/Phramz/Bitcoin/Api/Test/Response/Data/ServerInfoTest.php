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
namespace Phramz\Bitcoin\Api\Test\Response\Data;

use Phramz\Bitcoin\Api\Response\Data\ServerInfo;
use Phramz\Bitcoin\Api\Test\AbstractTestCase;

/**
 * Class ServerInfoTest
 * @package Phramz\Bitcoin\Api\Test\Response\Data
 * @covers Phramz\Bitcoin\Api\Response\Data\ServerInfo<extended>
 */
class ServerInfoTest extends AbstractTestCase
{
    /**
     * @var ServerInfo
     */
    protected $serverInfo = null;

    protected $fixture = null;

    public function setUp()
    {
        $this->fixture = $this->getJsonFixture('response_getinfo');
        $this->serverInfo = new ServerInfo($this->fixture['result']);
    }

    public function testConstruct()
    {
        $test = $this->serverInfo;

        $this->assertInstanceOf('Phramz\Bitcoin\Api\Response\Data\AbstractData', $test);
    }

    public function testGetErrors()
    {
        $this->assertEquals($this->fixture['result']['errors'], $this->serverInfo->getErrors());
    }

    public function testgetPayTxFee()
    {
        $this->assertEquals($this->fixture['result']['paytxfee'], $this->serverInfo->getPayTxFee());
    }

    public function testGetKeypoolSize()
    {
        $this->assertEquals($this->fixture['result']['keypoolsize'], $this->serverInfo->getKeypoolSize());
    }

    public function testGetKeypoololdest()
    {
        $this->assertEquals($this->fixture['result']['keypoololdest'], $this->serverInfo->getKeypoolOldest());
    }

    public function testIsTestnet()
    {
        $this->assertEquals($this->fixture['result']['testnet'], $this->serverInfo->isTestnet());
    }

    public function testGetDifficulty()
    {
        $this->assertEquals($this->fixture['result']['difficulty'], $this->serverInfo->getDifficulty());
    }

    public function testGetProxy()
    {
        $this->assertEquals($this->fixture['result']['proxy'], $this->serverInfo->getProxy());
    }

    public function testGetConnections()
    {
        $this->assertEquals($this->fixture['result']['connections'], $this->serverInfo->getConnections());
    }

    public function testGetTimeOffset()
    {
        $this->assertEquals($this->fixture['result']['timeoffset'], $this->serverInfo->getTimeOffset());
    }

    public function testGetBlocks()
    {
        $this->assertEquals($this->fixture['result']['blocks'], $this->serverInfo->getBlocks());
    }

    public function testGetWalletVersion()
    {
        $this->assertEquals($this->fixture['result']['walletversion'], $this->serverInfo->getWalletVersion());
    }

    public function testGetVersion()
    {
        $this->assertEquals($this->fixture['result']['version'], $this->serverInfo->getVersion());
    }

    public function testGetBalance()
    {
        $this->assertEquals($this->fixture['result']['balance'], $this->serverInfo->getBalance());
    }

    public function testGetProtocolVersion()
    {
        $this->assertEquals($this->fixture['result']['protocolversion'], $this->serverInfo->getProtocolVersion());
    }
}
