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
namespace Phramz\Bitcoin\Api\Response;

/**
 * Class ServerInfo
 * @package Phramz\Bitcoin\Api\Response
 */
class ServerInfo extends AbstractResponseProxy
{
    /**
     * Returns the Version
     * @return integer
     */
    public function getVersion()
    {
        return $this->getValue('version');
    }

    /**
     * Returns the protocol version
     * @return integer
     */
    public function getProtocolVersion()
    {
        return $this->getValue('protocolversion');
    }

    /**
     * Returns the wallet version
     * @return integer
     */
    public function getWalletVersion()
    {
        return $this->getValue('walletversion');
    }

    /**
     * Returns the current balance
     * @return float
     */
    public function getBalance()
    {
        return $this->getValue('balance');
    }

    /**
     * Returns the block count
     * @return integer
     */
    public function getBlocks()
    {
        return $this->getValue('blocks');
    }

    /**
     * Returns the time offset
     * @return integer
     */
    public function getTimeOffset()
    {
        return $this->getValue('timeoffset');
    }

    /**
     * Return the connection count
     * @return integer
     */
    public function getConnections()
    {
        return $this->getValue('connections');
    }

    /**
     * Returns the proxy
     * @return string
     */
    public function getProxy()
    {
        return $this->getValue('proxy');
    }

    /**
     * Returns the current difficulty
     * @return float
     */
    public function getDifficulty()
    {
        return $this->getValue('difficulty');
    }

    /**
     * Returns true if testnet is true
     * @return boolean
     */
    public function getTestnet()
    {
        return $this->getValue('testnet');
    }

    /**
     * Returns the timestamp of the oldest keypool entry
     * @return integer
     */
    public function getKeypoolOldest()
    {
        return $this->getValue('keypoololdest');
    }

    /**
     * Returns the size of the keypool
     * @return integer
     */
    public function getKeypoolSize()
    {
        return $this->getValue('keypoolsize');
    }

    /**
     * Returns the current transaction fee
     * @return float
     */
    public function getPayTxFee()
    {
        return $this->getValue('paytxfee');
    }

    /**
     * Returns collected error information
     * @return mixed
     */
    public function getErrors()
    {
        return $this->getValue('errors');
    }
}
