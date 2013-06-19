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
 * Class AbstractResponseProxy
 * @package Phramz\Bitcoin\Api\Response
 */
abstract class AbstractResponseProxy extends AbstractResponse
{
    /**
     * @var Response
     */
    protected $response = null;

    /**
     * @param Response $response
     */
    final private function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @param Response $response
     * @return GetInfoResponse
     */
    final public static function getInstance(Response $response)
    {
        return new static($response);
    }

    /**
     * (non-PHPdoc)
     * @see Response::getResult()
     */
    public function getResult()
    {
        return $this->response->getResult();
    }

    /**
     * (non-PHPdoc)
     * @see Response::getError()
     */
    public function getError()
    {
        return $this->response->getError();
    }

    /**
     * (non-PHPdoc)
     * @see Response::getId()
     */
    public function getId()
    {
        return $this->response->getId();
    }

    /**
     * (non-PHPdoc)
     * @see Response::getContent()
     */
    public function getContent()
    {
        return $this->response->getContent();
    }
}
