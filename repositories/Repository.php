<?php


namespace app\repositories;


use app\entities\Entity;
use app\services\DB;
use app\services\Session;


abstract class Repository
{

    abstract protected  function getTableName(): string;
    abstract protected function getEntityName():string;
    /**
     * @return DB
     */
    protected static function getDB()
    {
        return DB::getInstance();
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        $params = [':id' => $id];
        return static::getDB()->createObj($sql, $this->getEntityName(),  $params);
    }

    public  function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return static::getDB()->createObjAll($sql,  $this->getEntityName());
    }

    public  function getAllSession()
    {
        return $cart =(object) Session::get('cart');
    }

    private function getColumns()
    {
        $element = $this->getAll()[0];
        $columnsNames = [];
        foreach ($element as $columns => $value) {
            if ($columns == 'id' || $columns == 'view') {
                continue;
            } else {
                array_push($columnsNames, $columns);
            }
        }
        return $columnsNames;
    }

    protected function insert($params = [])
    {
        $params = (array) $params;
        unset($params['id']);
        unset($params['view']);
        $columns = $this->getColumns();
        $columnsNames = implode(', ', $columns);
        $params = implode("', '", $params);
        $sql = "INSERT INTO {$this->getTableName()} ({$columnsNames})
                VALUES ('{$params}')";
        if(!$res = static::getDB()->exe($sql)) {
            return false;
        }else return true;
    }

    public function delete()
    {
        $id = [':id' => $this->id];
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        return static::getDB()->exe($sql, $id);
    }

    protected function update($element = [])
    {
        $res = false;
        foreach ($this as $key => $value) {
            if ($element["$key"] != $value) {
                $params[":{$key}"] = $value;
                $placeholders = implode(", ", array_keys($params));
                $sql = "UPDATE {$this->getTableName()} SET {$key} = {$placeholders} WHERE id = {$element['id']}";
                if (!$ok = static::getDB()->exe($sql, $params)) {
                    $res = false;
                }else {
                    $res = true;
                };
            }
        }
        return $res;
    }

    public function save(Entity $entity)
    {
        $allFromTable = $this->getALl();
        foreach ($allFromTable as $element) {
            $element = (array) $element;
            if ($entity->id == $element['id']) {
                if (!$res = $this->update($element)) {
                    echo '<h1>error update</h1>';
                    return false;
                }else {
                    echo "<h1>OK Update</h1>";
                    return true;
                }
            }
        }
        if (!$res = $this->insert($entity)) {
            echo '<h1>error insert in save</h1>';
            return false;
        }else {
            echo "<h1>OK Insert</h1>";
            return true;
        }
    }
}