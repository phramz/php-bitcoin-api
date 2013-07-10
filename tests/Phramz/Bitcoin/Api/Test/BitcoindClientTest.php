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
namespace Phramz\Bitcoin\Api\Test;

use Phramz\Bitcoin\Api\BitcoindClient;

/**
 * Class BitcoindClientTest
 * @package Phramz\Bitcoin\Api\Test
 * @covers Phramz\Bitcoin\Api\BitcoindClient<extended>
 */
class BitcoindClientTest extends AbstractTestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $connection = null;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $response = null;

    protected $fixture = null;

    private function setUpFixture($fixture)
    {
        $this->fixture = $this->getJsonFixture($fixture);

        $this->response->expects($this->any())
            ->method('getContent')
            ->will($this->returnValue($this->fixture));

        $this->response->expects($this->any())
            ->method('getError')
            ->will($this->returnValue($this->fixture['error']));

        $this->response->expects($this->any())
            ->method('getResult')
            ->will($this->returnValue($this->fixture['result']));
    }

    public function setUp()
    {
        $this->response = $this->getMockBuilder('Phramz\Bitcoin\Api\Response\Response')
            ->getMockForAbstractClass();

        $this->connection = $this->getMockBuilder('Phramz\Bitcoin\Api\Connection\Connection')
            ->getMockForAbstractClass();

        $this->connection->expects($this->any())
            ->method('query')
            ->with($this->isInstanceOf('Phramz\Bitcoin\Api\Request\Request'))
            ->will($this->returnValue($this->response));
    }

    public function testConstruct()
    {
        $test = new BitcoindClient($this->connection);

        $this->assertInstanceOf('Phramz\Bitcoin\Api\Client', $test);
    }

    public function testGetInfo()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getinfo');

        $response = $test->getInfo();

        $this->assertInstanceOf('Phramz\Bitcoin\Api\Response\Data\ServerInfo', $response);
    }

    public function testGetBalance()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getbalance');

        $this->assertEquals($this->fixture['result'], $test->getBalance());
    }

    public function testListAccounts()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_listaccounts');

        $this->assertEquals($this->fixture['result'], $test->listAccounts());
    }

    public function testGetNewAddress()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getnewaddress');

        $this->assertEquals($this->fixture['result'], $test->getNewAddress());
    }

    public function testGetAddressesByAccount()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getaddressesbyaccount');

        $this->assertEquals($this->fixture['result'], $test->getAddressesByAccount('foo'));
    }

    public function testSendToAddress()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_sendtoaddress');

        $this->assertEquals($this->fixture['result'], $test->sendToAddress('foo', 0.01, 'bar', 'bazz'));
    }

    public function testDumpPrivateKey()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_dumpprivkey');

        $this->assertEquals($this->fixture['result'], $test->dumpPrivateKey('foo'));
    }

    public function testGetAccount()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getaccount');

        $this->assertEquals($this->fixture['result'], $test->getAccount('foo'));
    }

    public function testGetAccountAddress()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getaccountaddress');

        $this->assertEquals($this->fixture['result'], $test->getAccountAddress('foobar'));
    }

    public function testGetBlock()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getblock');

        $result = $test->getBlock('fooo');

        $this->assertInstanceOf('Phramz\Bitcoin\Api\Response\Data\Block', $result);
    }

    public function testGetBlockCount()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getblockcount');

        $this->assertEquals($this->fixture['result'], $test->getBlockCount());
    }

    public function testGetBlockHash()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getblockhash');

        $this->assertEquals($this->fixture['result'], $test->getBlockHash(2));
    }

    public function testGetConnectionCount()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getconnectioncount');

        $this->assertEquals($this->fixture['result'], $test->getConnectionCount());
    }

    public function testGetDifficulty()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getdifficulty');

        $this->assertEquals($this->fixture['result'], $test->getDifficulty());
    }

    public function testIsGenerate()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getgenerate');

        $this->assertEquals($this->fixture['result'], $test->isGenerate());
    }

    public function testGetHashesPerSecond()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_gethashespersec');

        $this->assertEquals($this->fixture['result'], $test->getHashesPerSecond());
    }

    public function testGetMiningInfo()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getmininginfo');

        $result = $test->getMiningInfo();

        $this->assertInstanceOf('Phramz\Bitcoin\Api\Response\Data\MiningInfo', $result);
    }

    public function testGetPeerInfo()
    {
        $test = new BitcoindClient($this->connection);
        $this->setUpFixture('response_getpeerinfo');

        $result = $test->getPeerInfo();

        $this->assertInternalType('array', $result);
        $this->assertCount(count($this->fixture['result']), $result);

        for ($i=0; $i < count($this->fixture['result']); $i++) {
            $this->assertInstanceOf('Phramz\Bitcoin\Api\Response\Data\PeerInfo', $result[$i]);
        }
    }

}
