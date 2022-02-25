<?php

use Nemke\Db\Mysql;
use Nemke\Framework\Bootstrap;
use Nemke\Framework\Config;



require_once  __DIR__ .  '/../vendor/autoload.php';

New Bootstrap(new Config(), new Mysql());