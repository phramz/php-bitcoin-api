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
 * Class MiningInfo
 * @package Phramz\Bitcoin\Api\Response\Data
 */
class MiningInfo extends AbstractData
{
    /**
     * Returns the number of blocks
     * @return integer
     */
    public function getBlocks()
    {
        return $this->getValue('blocks');
    }

    /**
     * Returns the current block-size
     * @return integer
     */
    public function getCurrentBlockSize()
    {
        return $this->getValue('currentblocksize');
    }

    /**
     * Returns the current block-transactions
     * @return integer
     */
    public function getWalletVersion()
    {
        return $this->getValue('currentblocktx');
    }

    /**
     * Returns the difficulty
     * @return float
     */
    public function getDifficulty()
    {
        return $this->getValue('difficulty');
    }

    /**
     * Returns the block count
     * @return boolean
     */
    public function isGenerate()
    {
        return $this->getValue('generate');
    }

    /**
     * Returns the mining process limit
     * @return integer
     */
    public function getGenProcLimit()
    {
        return $this->getValue('genproclimit');
    }

    /**
     * Return the number of hashes per second
     * @return integer
     */
    public function getHashesPerSecond()
    {
        return $this->getValue('hashespersec');
    }

    /**
     * Returns the number of pooled transactions
     * @return integer
     */
    public function getPooledTransactions()
    {
        return $this->getValue('pooledtx');
    }

    /**
     * Returns true if testnet is true
     * @return boolean
     */
    public function isTestnet()
    {
        return $this->getValue('testnet');
    }

    /**
     * Returns collected error information
     * @return string
     */
    public function getErrors()
    {
        return $this->getValue('errors');
    }
}
