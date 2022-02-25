<?php
namespace Nemke\Framework;

use Nemke\Db\Mysql;

class Bootstrap
{

    /** @var Config  */
    private $config;

    /** @var Mysql  */
    public $mysql;

    private $configuration;

    public function __construct(Config $config, Mysql $mysql)
    {
        $this->config = $config;
        $this->mysql = $mysql;

        $this->initApplication();

    }

    private function initApplication()
    {
        $this->configuration = $this->config->getConfig();
        $this->initDb();
    }


    private function initDb()
    {
        $this->mysql->connect($this->configuration['db']);
    }

}