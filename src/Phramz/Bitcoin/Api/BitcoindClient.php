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
use Phramz\Bitcoin\Api\Request\Request;
use Phramz\Bitcoin\Api\Response\Response;

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

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param Request $request
     * @param Connection $connection
     * @return Response the response
     */
    public function query(Request $request, Connection $connection)
    {

    }

    public function addMultiSigAddress()
    {

    }

    public function getInfo()
    {
        $request = new JsonRequest('getinfo');
        $response = $this->query($request, $this->connection);


    }
}
