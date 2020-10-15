<?php

namespace app\services;

class DB
{


    private $config;
    private $connect;

    /**
     * DB constructor.
     * @param  $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }


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


    private function query(string $sql, $params = [])
    {
        $pdoStatement = $this->getConnect()->prepare($sql);
        if (!$res = $pdoStatement->execute($params)) {
            return false;
        }else return $pdoStatement;
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
        if (!$res = $this->query($sql, $params)) {
            return false;
        }else return true;
    }

    public function getLastId()
    {
        return $this->getConnection()->lastInsertId();
    }

}


