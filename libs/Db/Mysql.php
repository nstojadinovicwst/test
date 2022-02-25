<?php

namespace Nemke\Db;


class Mysql implements DbInterface
{

    private $connection;

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
     * @param array $data
     * @return mixed
     */
    function select(string $table, array $data)
    {
    }

    /**
     * @param string $table
     * @param array $data
     * @return mixed
     */
    function update(string $table, array $data)
    {
    }
}