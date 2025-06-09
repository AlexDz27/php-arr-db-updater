<?php

require 'PhpArrDbUpdater.php';

$db = require 'db.php';
$db['currentPriceList'] = null;
$db['someOther'] = 12.13;  // TODO: check on empty arr later -- maybe just write simple if for this case

$dbUpdater = new PhpArrDbUpdater();
$dbUpdater->update($db, 'updatedDb.php');
var_dump($db);  // TODO: check the file itself, not just here