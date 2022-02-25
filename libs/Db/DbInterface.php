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
     * @param string $where
     * @return mixed
     */
    function select(string $table, string $where);

    /**
     * Updating dataset from DB
     *
     * @param string $table
     * @param string $update
     * @param string $where
     * @return mixed
     */
    function update(string $table, string $update, string $where);

    /*
     * Singleton method
     */
    public static function getInstance();

}