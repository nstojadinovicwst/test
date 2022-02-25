<?php

use Nemke\Db\Mysql;
use Nemke\Framework\Bootstrap;
use Nemke\Framework\Config;
use Nemke\Crawler\StatusCheck;


require_once  __DIR__ .  '/../vendor/autoload.php';

New Bootstrap(new Config(), Mysql::getInstance());

$status = new StatusCheck();
$status->testSingleUrl();