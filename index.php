<?php

// $db = require 'updatedDb.php';
// var_dump($db);

require 'PhpArrDbUpdater.php';

$db = require 'db.php';
$db['currentPriceList'] = null;
$db['someOther'] = 12.13;
$db['products'] = [
  '111-111' => [
    'newProp' => 32,
    'color' => 'green',
  ],
  '111-112' => [
    'newProp' => null,
    'color' => 'green'
  ],
  '111-113' => [
    'newProp' => 'zxczxczxc',
    'color' => 'green',
    'options' => [
      'useT' => true,
      'count' => 42,
    ],
    'empty' => []
  ]
];

$dbUpdater = new PhpArrDbUpdater();
$dbUpdater->update($db, 'updatedDb.php');
var_dump($db);  // TODO: check the file itself, not just here