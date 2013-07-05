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
use Phramz\Bitcoin\Api\Exception\BitcoinException;

/**
 * Class JsonResponse
 * @package Phramz\Bitcoin\Api\Response
 */
class JsonResponse extends AbstractResponse
{
    /**
     * @var string
     */
    protected $content = null;

    /**
     * @param string $json The raw json response
     * @throws BitcoinException
     */
    public function __construct($json)
    {
        $this->content = $json;

        $this->parseJson();

        if (!$this->getId()) {
            throw new BitcoinException("unexpected reponse data: " . $json);
        }
    }

    /**
     * Parses the raw json response to the member variables result, error and id
     */
    protected function parseJson()
    {
        $data = json_decode($this->content, true);

        $this->result = isset($data['result']) ? $data['result'] : null;
        $this->error = isset($data['error']) ? $data['error'] : null;
        $this->id = isset($data['id']) ? $data['id'] : null;
    }
}
