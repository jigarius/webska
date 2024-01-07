<?php

use Webska\Application;
use Webska\Configuration;

require 'vendor/autoload.php';

try {
  $conf = Configuration::fromArgv();
  $webspka = new Application($conf);
  $webspka->execute();
}
catch (\Exception $ex) {
  echo 'ERROR: ' . $ex->getMessage() . PHP_EOL;
  exit(1);
}

exit(0);
