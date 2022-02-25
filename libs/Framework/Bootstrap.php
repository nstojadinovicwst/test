<?php
namespace Nemke\Framework;

use Nemke\Db\DbInterface;


class Bootstrap
{

    /** @var Config  */
    private $config;

    /** @var Mysql  */
    public $mysql;

    /**
     * @var
     */
    private $configuration;

    /**
     * @param Config $config
     * @param DbInterface $mysql
     */
    public function __construct(Config $config, DbInterface $mysql)
    {
        $this->config = $config;
        $this->mysql = $mysql;

        $this->initApplication();

    }

    /**
     * @return void
     */
    private function initApplication()
    {
        $this->configuration = $this->config->getConfig();
        $this->initDb();
    }


    /**
     * @return void
     */
    private function initDb()
    {
        $this->mysql->connect($this->configuration['db']);
    }

}