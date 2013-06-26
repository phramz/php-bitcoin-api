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

use Phramz\Bitcoin\Api\Response\GetInfoResponse;
use Phramz\Bitcoin\Api\Response\JsonResponse;

/**
 * Class Client
 * @package Phramz\Bitcoin\Api
 */
interface Client
{
    /**
     * @return JsonResponse
     */
    public function addMultiSigAddress();

    /**
     * Returns an object containing various state info.
     *
     * @return GetInfoResponse
     */
    public function getInfo();

    /**
     * If [account] is not specified, returns the server's total available balance.
     * If [account] is specified, returns the balance in the account.
     *
     * @param string $account
     * @return JsonResponse
     */
    public function getBalance($account = null);

    /**
     * Returns Object that has account names as keys, account balances as values.
     *
     * @param int $minconf
     * @return JsonResponse
     */
    public function listAccounts($minconf = 1);

    /**
     * Returns a new Bitcoin address for receiving payments.
     * If [account] is specified (recommended), it is added to the address book so payments
     * received with the address will be credited to [account].
     *
     * @param string $account
     * @return JsonResponse
     */
    public function getNewAddress($account = null);

    /**
     * Returns the list of addresses for the given account.
     *
     * @param string $account
     * @return JsonResponse
     */
    public function getAddressesByAccount($account);

    /**
     * Send <amount> of Bitcoins to <bitcoinaddress>
     * <amount> is a real and is rounded to the nearest 0.00000001
     *
     * @param string $bitcoinaddress
     * @param double $amount
     * @param string $comment
     * @param string $commentTo
     * @return JsonResponse
     */
    public function sendToAddress($bitcoinaddress, $amount, $comment = '', $commentTo = '');
}
