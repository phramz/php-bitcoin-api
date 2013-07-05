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
namespace Phramz\Bitcoin\Api\Response\Data;

/**
 * Class PeerInfo
 * @package Phramz\Bitcoin\Api\Response\Data
 */
class PeerInfo extends AbstractData
{
    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->getValue('addr');
    }

    /**
     * @return string
     */
    public function getServices()
    {
        return $this->getValue('services');
    }

    /**
     * @return \DateTime|null
     */
    public function getLastSend()
    {
        return $this->getValueAsDateTime('lastsend');
    }

    /**
     * @return \DateTime|null
     */
    public function getLastReceived()
    {
        return $this->getValueAsDateTime('lastrecv');
    }

    /**
     * @return integer
     */
    public function getBytesSend()
    {
        return $this->getValue('bytessent');
    }

    /**
     * @return integer
     */
    public function getBytesReceived()
    {
        return $this->getValue('bytesrecv');
    }

    /**
     * @return \DateTime|null
     */
    public function getConnectTime()
    {
        return $this->getValueAsDateTime('conntime');
    }

    /**
     * @return integer
     */
    public function getVersion()
    {
        return $this->getValue('version');
    }

    /**
     * @return string
     */
    public function getSubVersion()
    {
        return $this->getValue('subver');
    }

    /**
     * @return boolean
     */
    public function isInbound()
    {
        return $this->getValue('inbound', false);
    }

    /**
     * @return integer
     */
    public function getStartingHeight()
    {
        return $this->getValue('startingheight');
    }

    /**
     * @return integer
     */
    public function getBanScore()
    {
        return $this->getValue('banscore');
    }

    /**
     * @return boolean
     */
    public function isSyncNode()
    {
        return $this->getValue('syncnode', false);
    }
}
