<?php

namespace app\services;

use http\Params;

class DB implements IDB
{
    private static $item;

    public static function getInstance()
    {
        if (empty(static::$item)) {
            static::$item = new static();
        }
        return static::$item;
    }

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'dbName' => 'application_db',
        'charset' => 'UTF8',
        'login' => 'root',
        'password' => 'VvladmirRwh10'
    ];
    private $connect;

    public function getConnect()
    {
        if (empty($this->connect)) {
            $this->connect = new \PDO(
                $this->getSdnString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->connect->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connect;
    }

    private function getSdnString()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['dbName'],
            $this->config['charset']
        );
    }

    protected function __construct()
    {

    }

    protected function __clone()
    {

    }

    protected function __wakeup()
    {

    }

    private function query(string $sql, $params = [])
    {
        $pdoStatement = $this->getConnect()->prepare($sql);
        var_dump($pdoStatement);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function find($sql, $params)
    {
        return $this->query($sql, $params)->fetch();
    }

    public function findAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function createObj(string $sql, $class, $params = [])
    {
        $pdoStatement = $this->query($sql, $params);
        $pdoStatement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $pdoStatement->fetch();
    }

    public function createObjAll(string $sql, $class, $params = [])
    {
        $pdoStatement = $this->query($sql, $params);
        $pdoStatement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $pdoStatement->fetchAll();
    }

    public function exe(string $sql, array $params = []) {
        return $this->query($sql, $params)->rowCount();
    }

}


