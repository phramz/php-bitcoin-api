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
namespace Phramz\Bitcoin\Api;

use Phramz\Bitcoin\Api\Connection\Connection;
use Phramz\Bitcoin\Api\Exception\BitcoinException;
use Phramz\Bitcoin\Api\Request\JsonRequest;
use Phramz\Bitcoin\Api\Request\Request;
use Phramz\Bitcoin\Api\Response\ServerInfo;

/**
 * Class BitcoindClient
 * @package Phramz\Bitcoin\Api
 */
class BitcoindClient implements Client
{
    /**
     * @var Connection
     */
    protected $connection = null;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * (non-PHPdoc)
     * @see Client::getInfo()
     */
    public function getInfo()
    {
        $request = new JsonRequest('getinfo');
        $response = $this->query($request);

        return ServerInfo::getInstance($response);
    }

    /**
     * (non-PHPdoc)
     * @see Client::getBalance()
     */
    public function getBalance($account = null, $minconf = 1)
    {
        $param = $account ? array($account) : array();
        if ($minconf != 1) {
            $param[] = $minconf;
        }

        $request = new JsonRequest('getbalance', $param);
        $response = $this->query($request);

        return $response;
    }

    /**
     * (non-PHPdoc)
     * @see Client::listAccounts()
     */
    public function listAccounts($minconf = 1)
    {
        $param = $minconf ? array($minconf) : array();

        $request = new JsonRequest('listaccounts', $param);
        $response = $this->query($request);

        return $response;
    }

    /**
     * (non-PHPdoc)
     * @see Client::getNewAddress()
     */
    public function getNewAddress($account = null)
    {
        $param = $account ? array($account) : array();

        $request = new JsonRequest('getnewaddress', $param);
        $response = $this->query($request);

        return $response;
    }

    /**
     * (non-PHPdoc)
     * @see Client::getAddressesByAccount()
     */
    public function getAddressesByAccount($account)
    {
        $param = $account ? array($account) : array();

        $request = new JsonRequest('getaddressesbyaccount', $param);
        $response = $this->query($request);

        return $response;
    }

    /**
     * (non-PHPdoc)
     * @see Client::sendToAddress()
     */
    public function sendToAddress($bitcoinaddress, $amount, $comment = '', $commentTo = '')
    {
        $param = array($bitcoinaddress, $amount, $comment, $commentTo);

        $request = new JsonRequest('sendtoaddress', $param);
        $response = $this->query($request);

        return $response;
    }

    /**
     * (non-PHPdoc)
     * @see Client::addMultiSigAddress()
     */
    public function addMultiSigAddress($nrequired, array $keys, $account = null)
    {
        // TODO: Implement addMultiSigAddress() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::createMultiSig()
     */
    public function createMultiSig($nrequired, array $keys)
    {
        // TODO: Implement createMultiSig() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::addNode()
     */
    public function addNode($node, $action = self::NODE_ADD)
    {
        // TODO: Implement addNode() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::backupWallet()
     */
    public function backupWallet($destination)
    {
        // TODO: Implement backupWallet() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::createRawTransaction()
     */
    public function createRawTransaction(array $txIds, array $amounts)
    {
        // TODO: Implement createRawTransaction() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::decodeRawTransaction()
     */
    public function decodeRawTransaction($hexString)
    {
        // TODO: Implement decodeRawTransaction() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::dumpPrivateKey()
     */
    public function dumpPrivateKey($bitcoinaddress)
    {
        // TODO: Implement dumpPrivateKey() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::encryptWallet()
     */
    public function encryptWallet($passphrase)
    {
        // TODO: Implement encryptWallet() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getAccount()
     */
    public function getAccount($bitcoinaddress)
    {
        // TODO: Implement getAccount() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getAccountAddress()
     */
    public function getAccountAddress($account)
    {
        // TODO: Implement getAccountAddress() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getAddedNodeInfo()
     */
    public function getAddedNodeInfo($dns, $node = null)
    {
        // TODO: Implement getAddedNodeInfo() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getBlock()
     */
    public function getBlock($hash)
    {
        // TODO: Implement getBlock() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getBlockCount()
     */
    public function getBlockCount()
    {
        // TODO: Implement getBlockCount() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getBlockHash()
     */
    public function getBlockHash($index)
    {
        // TODO: Implement getBlockHash() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getBlockTemplate()
     */
    public function getBlockTemplate(array $params)
    {
        // TODO: Implement getBlockTemplate() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getConnectionCount()
     */
    public function getConnectionCount()
    {
        // TODO: Implement getConnectionCount() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getDifficulty()
     */
    public function getDifficulty()
    {
        // TODO: Implement getDifficulty() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::isGenerate()
     */
    public function isGenerate()
    {
        // TODO: Implement isGenerate() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getHashesPerSecond()
     */
    public function getHashesPerSecond()
    {
        // TODO: Implement getHashesPerSecond() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getMiningInfo()
     */
    public function getMiningInfo()
    {
        // TODO: Implement getMiningInfo() method.
    }

    /**
     * (non-PHPdoc)
     * @see Client::getPeerInfo()
     */
    public function getPeerInfo()
    {
        // TODO: Implement getPeerInfo() method.
    }

    /**
     * Wrapper for connection->query ... implicit failure detection
     *
     * @param Request $request
     * @return Response\Response
     * @throws Exception\BitcoinException
     */
    protected function query(Request $request)
    {
        $response = null;

        try {
            $response = $this->connection->query($request);
        } catch (\Exception $ex) {
            throw new BitcoinException(
                "query failed due to underlaying exception: " . $ex->getMessage(),
                $ex->getCode(),
                $ex
            );
        }

        if (!$response) {
            throw new BitcoinException("query returned an empty response!");
        }

        if ($response->getError()) {
            $error = $response->getError();
            $msg = "query failed: " . (isset($error['message']) ? $error['message'] : json_encode($error));
            $code = isset($error['code']) ? $error['code'] : 0;
            throw new BitcoinException($msg, $code);
        }

        return $response;
    }
}
