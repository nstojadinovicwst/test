<?php
namespace Nemke\Db;

interface DbInterface {


    /**
     * Used to connect to database server
     *
     * @param array $config
     */
    function connect(array $config);


    /**
     * Selecting dataset from DB
     *
     * @param string $table
     * @param array $data
     * @return mixed
     */
    function select(string $table, array $data);

    /**
     * Updating dataset from DB
     *
     * @param string $table
     * @param array $data
     * @return mixed
     */
    function update(string $table, array $data);

}