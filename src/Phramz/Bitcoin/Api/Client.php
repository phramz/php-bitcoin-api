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

use Phramz\Bitcoin\Api\Response\Data\Block;
use Phramz\Bitcoin\Api\Response\Data\MiningInfo;
use Phramz\Bitcoin\Api\Response\Data\ServerInfo;
use Phramz\Bitcoin\Api\Response\JsonResponse;

/**
 * Class Client
 * @package Phramz\Bitcoin\Api
 */
interface Client
{
    const NODE_ADD = 'add';
    const NODE_REMOVE = 'remove';
    const NODE_ONETRY = 'onetry';

    /**
     * addmultisigaddress <nrequired> <'["key","key"]'> [account]
     * Add a nrequired-to-sign multisignature address to the wallet"
     * each key is a Bitcoin address or hex-encoded public key
     * If [account] is specified, assign address to [account].
     *
     * @param $nrequired
     * @param array $keys
     * @param string $account
     * @return JsonResponse
     * @throws Exception\BitcoinException
     */
    public function addMultiSigAddress($nrequired, array $keys, $account = null);

    /**
     * createmultisig <nrequired> <'["key","key"]'>
     * Creates a multi-signature address and returns a json object
     *  with keys:
     *  address : bitcoin address
     *  redeemScript : hex-encoded redemption script
     *
     * @param $nrequired
     * @param array $keys
     * @return JsonResponse
     * @throws Exception\BitcoinException
     */
    public function createMultiSig($nrequired, array $keys);

    /**
     * addnode <node> <add|remove|onetry>
     * Attempts add or remove <node> from the addnode list or try a connection to <node> once.
     *
     * @param string $node
     * @param string $action [add|remove|onetry]
     * @return JsonResponse
     * @throws Exception\BitcoinException
     */
    public function addNode($node, $action = self::NODE_ADD);

    /**
     * backupwallet <destination>
     * Safely copies wallet.dat to destination, which can be a directory or a path with filename.
     *
     * @param string $destination
     * @return JsonResponse
     * @throws Exception\BitcoinException
     */
    public function backupWallet($destination);

    /**
     * Returns an object containing various state info.
     *
     * @return ServerInfo
     * @throws Exception\BitcoinException
     */
    public function getInfo();

    /**
     * getbalance [account] [minconf=1]
     * If [account] is not specified, returns the server's total available balance.
     * If [account] is specified, returns the balance in the account.
     *
     * @param string $account
     * @param int $minconf
     * @return float
     * @throws Exception\BitcoinException
     */
    public function getBalance($account = null, $minconf = 1);

    /**
     * Returns Object that has account names as keys, account balances as values.
     *
     * @param int $minconf
     * @return array of {"account" => balance}
     * @throws Exception\BitcoinException
     */
    public function listAccounts($minconf = 1);

    /**
     * Returns a new Bitcoin address for receiving payments.
     * If [account] is specified (recommended), it is added to the address book so payments
     * received with the address will be credited to [account].
     *
     * @param string $account
     * @return string
     * @throws Exception\BitcoinException
     */
    public function getNewAddress($account = null);

    /**
     * getaddressesbyaccount <account>
     * Returns the list of addresses for the given account.
     *
     * @param string $account
     * @return array of accounts
     * @throws Exception\BitcoinException
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
     * @return string txid
     * @throws Exception\BitcoinException
     */
    public function sendToAddress($bitcoinaddress, $amount, $comment = '', $commentTo = '');

    /**
     * createrawtransaction [{"txid":txid,"vout":n},...] {address:amount,...}
     * Create a transaction spending given inputs
     * (array of objects containing transaction id and output number),
     * sending to given address(es).
     * Returns hex-encoded raw transaction.
     * Note that the transaction's inputs are not signed, and
     * it is not stored in the wallet or transmitted to the network.
     *
     * @param array $txIds [{"txid": "foo", "vout": "bar"}, {"txid": "foobar", "vout": "bazz"}]
     * @param array $amounts {"bitcoinaddress1": 0.001, "bitcoinaddress2": 0.009}
     * @return JsonResponse
     * @throws Exception\BitcoinException
     */
    public function createRawTransaction(array $txIds, array $amounts);

    /**
     * decoderawtransaction <hex string>
     * Return a JSON object representing the serialized, hex-encoded transaction.
     *
     * @param string $hexString
     * @return JsonResponse
     * @throws Exception\BitcoinException
     */
    public function decodeRawTransaction($hexString);

    /**
     * dumpprivkey <bitcoinaddress>
     * Reveals the private key corresponding to <bitcoinaddress>.
     *
     * @param string $bitcoinaddress
     * @return JsonResponse
     * @throws Exception\BitcoinException
     */
    public function dumpPrivateKey($bitcoinaddress);

    /**
     * encryptwallet <passphrase>
     * Encrypts the wallet with <passphrase>.
     *
     * @param string $passphrase
     * @return JsonResponse
     * @throws Exception\BitcoinException
     */
    public function encryptWallet($passphrase);

    /**
     * getaccount <bitcoinaddress>
     * Returns the account associated with the given address.
     *
     * @param string $bitcoinaddress
     * @return JsonResponse
     * @throws Exception\BitcoinException
     */
    public function getAccount($bitcoinaddress);

    /**
     * getaccountaddress <account>
     * Returns the current Bitcoin address for receiving payments to this account.
     *
     * @param string $account
     * @return JsonResponse
     * @throws Exception\BitcoinException
     */
    public function getAccountAddress($account);

    /**
     * getaddednodeinfo <dns> [node]
     * Returns information about the given added node, or all added nodes
     * (note that onetry addnodes are not listed here)
     * If dns is false, only a list of added nodes will be provided,
     * otherwise connected information will also be available.
     *
     * @param string $dns
     * @param null $node
     * @return JsonResponse
     * @throws Exception\BitcoinException
     */
    public function getAddedNodeInfo($dns, $node = null);

    /**
     * getblock <hash>
     * Returns details of a block with given block-hash.
     *
     * @param string $hash
     * @return Block
     * @throws Exception\BitcoinException
     */
    public function getBlock($hash);

    /**
     * getblockcount
     * Returns the number of blocks in the longest block chain.
     *
     * @return integer
     * @throws Exception\BitcoinException
     */
    public function getBlockCount();

    /**
     * getblockhash <index>
     * Returns hash of block in best-block-chain at <index>.
     *
     * @param int $index
     * @return string
     * @throws Exception\BitcoinException
     */
    public function getBlockHash($index);

    /**
     * getblocktemplate [params]
     * Returns data needed to construct a block to work on:
     * "version" : block version
     * "previousblockhash" : hash of current highest block
     * "transactions" : contents of non-coinbase transactions that should be included in the next block
     * "coinbaseaux" : data that should be included in coinbase
     * "coinbasevalue" : maximum allowable input to coinbase transaction, including the generation award
     *                   and transaction fees
     * "target" : hash target
     * "mintime" : minimum timestamp appropriate for next block
     * "curtime" : current timestamp
     * "mutable" : list of ways the block template may be changed
     * "noncerange" : range of valid nonces
     * "sigoplimit" : limit of sigops in blocks
     * "sizelimit" : limit of block size
     * "bits" : compressed target of next block
     * "height" : height of the next block
     *
     * @param array $params
     * @return JsonResponse
     * @throws Exception\BitcoinException
     * @see https://en.bitcoin.it/wiki/BIP_0022
     */
    public function getBlockTemplate(array $params);

    /**
     * getconncount
     * Returns the number of connections to other nodes.
     *
     * @return integer
     * @throws Exception\BitcoinException
     */
    public function getConnectionCount();

    /**
     * getdifficulty
     * Returns the proof-of-work difficulty as a multiple of the minimum difficulty.
     *
     * @return double
     * @throws Exception\BitcoinException
     */
    public function getDifficulty();

    /**
     * getgenerate
     * Returns true or false if block generation is enabled or not
     *
     * @return boolean
     * @throws Exception\BitcoinException
     */
    public function isGenerate();

    /**
     * gethashespersec
     * Returns a recent hashes per second performance measurement while generating.
     *
     * @return integer
     * @throws Exception\BitcoinException
     */
    public function getHashesPerSecond();

    /**
     * getmininginfo
     * Returns an object containing mining-related information.
     *
     * @return MiningInfo
     * @throws Exception\BitcoinException
     */
    public function getMiningInfo();

    /**
     * getpeerinfo
     * Returns data about each connected network node.
     *
     * @return array of PeerInfo
     * @throws Exception\BitcoinException
     */
    public function getPeerInfo();
}
