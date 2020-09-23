<?php

namespace app\models;

use app\services\DB;

abstract class Model
{

    /**
     * Метод для
     *
     * @return mixed
     */
    abstract protected function getTableName(): string;

    /**
     * @return DB
     */
    protected function getDB()
    {
        return DB::getInstance();
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        $params = [':id' => $id];
        return $this->getDB()->createObj($sql, 'app\models\\' . ucfirst($tableName), $params);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->getDB()->createObjAll($sql, 'app\models\\' . ucfirst($tableName));
    }

    private function getColumns()
    {
        $element = $this->getAll()[0];
        $columnsNames = [];
        foreach ($element as $columns => $value) {
            if ($columns == 'id') {
                continue;
            } else {
                array_push($columnsNames, $columns);
            }
        }
        return $columnsNames;
    }

    private function insert($params = [])
    {
        $params = (array) $params;
        unset($params['id']);
        $columns = $this->getColumns();
        $columnsNames = implode(', ', $columns);
        $params = implode("', '", $params);
        $sql = "INSERT INTO {$this->getTableName()} ({$columnsNames})
                VALUES ('{$params}')";
        if(!$res = $this->getDB()->exe($sql)) {
            return false;
        }else return true;
    }

    public function delete()
    {
        $id = [':id' => $this->id];
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        return $this->getDB()->exe($sql, $id);
    }

    private function update($element = [])
    {
        $res = false;
        foreach ($this as $key => $value) {
            if ($element["$key"] != $value) {
                $params[":{$key}"] = $value;
                $placeholders = implode(", ", array_keys($params));
                $sql = "UPDATE {$this->getTableName()} SET {$key} = {$placeholders} WHERE id = {$element['id']}";
                if (!$ok = $this->getDB()->exe($sql, $params)) {
                    $res = false;
                }else {
                    $res = true;
                };
            }
        }
        return $res;
    }

    public function save()
    {
        $allFromTable = $this->getALl();
        foreach ($allFromTable as $element) {
            $element = (array) $element;
            if ($this->id == $element['id']) {
                if (!$res = $this->update($element)) {
                    echo '<h1>error update</h1>';
                    return false;
                }else {
                    echo "<h1>OK Update</h1>";
                    return true;
                }
            }
        }
        if (!$res = $this->insert($this)) {
            echo '<h1>error insert</h1>';
            return false;
        }else {
            echo "<h1>OK Insert</h1>";
            return true;
        }
    }
}
