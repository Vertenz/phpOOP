<?php
namespace app\services;
namespace test\asd;

class DB implements IDB
{
    use TCalc;

    public function find($sql)
    {
        $this->echoTest();
        return 'find ' . $sql;
    }

    public function findAll($sql)
    {
        return 'findAll ' . $sql;
    }
}