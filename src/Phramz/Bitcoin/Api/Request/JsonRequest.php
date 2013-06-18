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

namespace Phramz\Bitcoin\Api\Request;

/**
 * Class JsonRequest
 * @package Phramz\Bitcoin\Api\Request
 */
class JsonRequest implements Request
{
    protected $id = null;
    protected $method = null;
    protected $params = null;

    /**
     * @param string $method the method name
     * @param array $params the parameters [optional]
     * @param mixed $id the id [optional]
     */
    public function __construct($method, array $params = array(), $id = null)
    {
        $this->id = $id ? $id : md5(microtime() . '|' . mt_rand());
        $this->method = $method;
        $this->params = $params;
    }
    /**
     * Returns the method name
     *
     * @return string method name
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Returns the parameters as array
     *
     * @return array parameters array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Returns the id of this request
     *
     * @return mixed the id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string the json string representing this request
     */
    public function toJson()
    {
        $data = array(
            'jsonrpc' => '1.0',
            'id' => $this->getId(),
            'method' => $this->getMethod(),
            'params' => $this->getParams()
        );

        if ($this instanceof Notification) {
            unset($data['id']);
        }

        return json_encode($data);
    }
}
