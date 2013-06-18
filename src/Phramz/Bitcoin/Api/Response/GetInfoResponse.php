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
 * Class GetInfoResponse
 * @package Phramz\Bitcoin\Api\Response
 */
class GetInfoResponse extends AbstractResponseProxy
{
    public function getVersion()
    {
        return $this->getValue('version');
    }

    public function getProtocolVersion()
    {
        return $this->getValue('protocolversion');
    }

    public function getWalletVersion()
    {
        return $this->getValue('walletversion');
    }

    public function getBalance()
    {
        return $this->getValue('balance');
    }

    public function getBlocks()
    {
        return $this->getValue('blocks');
    }

    public function getTimeOffset()
    {
        return $this->getValue('timeoffset');
    }

    public function getConnections()
    {
        return $this->getValue('connections');
    }

    public function getProxy()
    {
        return $this->getValue('proxy');
    }

    public function getDifficulty()
    {
        return $this->getValue('difficulty');
    }

    public function getTestnet()
    {
        return $this->getValue('testnet');
    }

    public function getKeypoolOldest()
    {
        return $this->getValue('keypoololdest');
    }

    public function getKeypoolSize()
    {
        return $this->getValue('keypoolsize');
    }

    public function getPayTxFee()
    {
        return $this->getValue('paytxfee');
    }

    public function getErrors()
    {
        return $this->getValue('errors');
    }
}
