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
use Phramz\Bitcoin\Api\Request\JsonRequest;
use Phramz\Bitcoin\Api\Response\GetInfoResponse;

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
     * @see Client::addMultiSigAddress()
     */
    public function addMultiSigAddress()
    {

    }

    /**
     * (non-PHPdoc)
     * @see Client::getInfo()
     */
    public function getInfo()
    {
        $request = new JsonRequest('getinfo');
        $response = $this->connection->query($request);

        return GetInfoResponse::getInstance($response);
    }

    /**
     * (non-PHPdoc)
     * @see Client::getBalance()
     */
    public function getBalance($account = null)
    {
        $param = $account ? array($account) : array();

        $request = new JsonRequest('getbalance', $param);
        $response = $this->connection->query($request);

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
        $response = $this->connection->query($request);

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
        $response = $this->connection->query($request);

        return $response;
    }

    /**
     * (non-PHPdoc)
     * @see Client::getAddressesByAccount()
     */
    public function getAddressesByAccount($account = null)
    {
        $param = $account ? array($account) : array();

        $request = new JsonRequest('getaddressesbyaccount', $param);
        $response = $this->connection->query($request);

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
        $response = $this->connection->query($request);

        return $response;
    }
}
