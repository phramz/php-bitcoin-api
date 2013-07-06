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

namespace Phramz\Bitcoin\Api\Connection;

use Buzz\Browser;
use Buzz\Message\Response;
use Phramz\Bitcoin\Api\Exception\AuthenticationException;
use Phramz\Bitcoin\Api\Exception\TransportException;
use Phramz\Bitcoin\Api\Request\Request;
use Phramz\Bitcoin\Api\Response\JsonResponse;

/**
 * Class BuzzConnection
 * @package Phramz\Bitcoin\Api\Connection
 */
class BuzzConnection extends AbstractConnection
{
    /**
     * @var Browser
     */
    protected $browser = null;

    public function __construct(Browser $browser, $host, $port, $username, $password)
    {
        $this->browser = $browser;

        parent::__construct($host, $port, $username, $password);
    }

    /**
     * (non-PHPdoc)
     * @see Connection::query()
     */
    public function query(Request $request)
    {
        $response = null;

        try {
            $response = $this->browser->post(
                'http://'. $this->host . ':' . $this->port,
                array (
                    'Content-type' => 'application/json',
                    'Authorization: Basic '.base64_encode($this->username.':'.$this->password)
                ),
                $request->getContent()
            );
        } catch (\Exception $ex) {
            throw new TransportException(
                "query failed due to underlaying error: " . $ex->getMessage(),
                $ex->getCode(),
                $ex
            );
        }

        if ($response instanceof Response) {
            if ($response->getStatusCode() == 401) {
                throw new AuthenticationException("authentication failed!");
            }

            $jsonResponse = new JsonResponse($response->getContent());

            if ($response->getStatusCode() == 200 || $jsonResponse->getError()) {
                return $jsonResponse;
            }

            throw new TransportException(
                "query failed due to invalid response status! [".$response->getStatusCode()."]",
                $response->getStatusCode()
            );
        }

        throw new TransportException("query failed due to empty response message!");
    }
}
