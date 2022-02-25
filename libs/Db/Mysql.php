<?php

namespace Nemke\Db;


class Mysql implements DbInterface
{

    /** @var  \mysqli*/
    private $connection;


    private static $instance = null;

    private function __construct()
    {
        // The expensive process (e.g.,db connection) goes here.
    }

    /**
     * @param array $config
     */
    function connect(array $config)
    {
        $this->connection = \mysqli_connect($config['host'], $config['username'] , $config['password'], $config['name']['internal'], $config['port']);
        if ($this->connection ->connect_error) {
            throw new \Exception('Unable to connect to database');
        }
    }

    /**
     * @param string $table
     * @param string $where
     * @return mixed
     */
    function select(string $table, string $where)
    {
        return $this->connection->query("Select * from $table where $where LIMIT 1")->fetch_assoc();
    }

    /**
     * @param string $table
     * @param string $update
     * @param string $where
     * @return mixed
     */
    function update(string $table, string $update, string $where)
    {
        return $this->connection->query("Update $table set $update where $where");
    }


    /**
     * Singleton method
     *
     * @return Mysql|null
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new Mysql();
        }

        return self::$instance;
    }


}