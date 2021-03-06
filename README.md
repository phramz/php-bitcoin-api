# phramz/php-bitcoin-api [![Build Status](https://travis-ci.org/phramz/php-bitcoin-api.png?branch=master)](https://travis-ci.org/phramz/php-bitcoin-api)

This is (or will be) a full-blown implementation of the bitcoind JSON-RPC API written in PHP.
Please be aware that this is still early alpha! Not all features are implemented yet and the interfaces are not stable.
Anyways ... the basic features should already work as expected ;-)

Install
------

It's easy if you use composer!

edit your `composer.json`

``` json
"require": {
    "phramz/php-bitcoin-api": "dev-master"
}
```

or via command line

```
php composer.phar require phramz/php-bitcoin-api
```

License
-------

This library is licensed under the MIT license. For further information see LICENSE file.

Examples
------

``` php
<?php

use Phramz\Bitcoin\Api\Connection\BuzzConnection;
use Phramz\Bitcoin\Api\BitcoindClient;
use Buzz\Browser;

// setup a connection
$connection = new BuzzConnection(new Browser(), '192.168.56.1', '8333', 'username123', 'password123');

// setup the client
$bitcoinClient = new BitcoindClient($connection);

echo "current balance:  " . $bitcoinClient->getBalance() . PHP_EOL;
echo "number of blocks: " . $bitcoinClient->getBlockCount() . PHP_EOL;
```

That's it! I hope this peace of software will be helpful!
... if you think it is ... feel free to donate some of your Bitcoins to keep the development going ;-)
``` php

echo "transaction id: ". $bitcoinClient->sendToAddress('1JGNmDQVjk7T4S1pcvdDsPJsFuQuZcMDe8', 0.01, 'donation');
```

Have fun!
