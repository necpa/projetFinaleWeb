<?php

abstract class Model
{
    private static $_bdd;

    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=web4shop;charset=UTF8;','root','');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd()
    {
        if (self::$_bdd == null)
        {
            self::setBdd();
        }
        return self::$_bdd;
    }

    public function deleteInTable($table, $id)
    {
        $sql = "DELETE FROM " .$table ." WHERE id = " .$id;
        $req = $this->getBdd()->prepare($sql);
        $req->execute();
        $req->closeCursor();
    }
    public function modifyInTable($table, $obj, $sets, $wheres )
    {
        $sql = "UPDATE " . $table;
        if(count($sets)){
            $sql .= " SET ";
            $estPremier = true;
            foreach($sets as $setKey => $setValue){
                if(!$estPremier){
                    $sql .= " , ";
                }
                if(is_string($setValue)){
                    $setValue = '"'. $setValue.'"';
                }
                $sql .= $setKey . " = " . $setValue;
                $estPremier = false;
            }
        }
        if(count($wheres)){
            $sql .= " WHERE ";
            $estPremier = true;
            foreach($wheres as $whereKey => $whereValue){
                if(!$estPremier){
                    $sql .= " AND ";
                }
                if(is_string($whereValue))
                {
                    $whereValue = '"'. $whereValue.'"';
                }
                $sql .= $whereKey . " = " . $whereValue;
                $estPremier = false;
            }

        }
        else{
            return null;
        }
        return $this->fetch($sql, $obj);
    }

    protected function getAll($table, $obj, $andWheres = [])
    {
        $sql = "SELECT * FROM " . $table;

        if(count($andWheres)){
            $sql .= " WHERE ";
            $estPremier = true;
            foreach($andWheres as $andWhereKey => $andWhere){
                if(!$estPremier){
                    $sql .= " AND ";
                }
                if(is_string($andWhere))
                {
                    $andWhere = '"'. $andWhere.'"';
                }
                $sql .= $andWhereKey . " = " . $andWhere;
                $estPremier = false;

            }
        }
        return $this->fetch($sql, $obj);
    }

    protected function getIdIn(string $table, $obj, array $ids = []){

        if(count($ids) === 0){
            return [];
        }
        return $this->fetch("SELECT * FROM " . $table . " WHERE id IN (" . implode(",", $ids) . ")", $obj);
    }

    protected function getOne($table, $id, $obj){
        $rows = $this->fetch('SELECT * FROM ' . $table . " WHERE id = " . '"'.$id.'"', $obj);
        if(count($rows)){
            return $rows[0];
        }
        return null;
    }

    public function addToTable($sql)
    {   //$sql est la requete sql
        $req = $this->getBdd()->prepare($sql);
        $req->execute();
        $req->closeCursor();
    }

    public function addToTableColumn($table, $tableDatas)
    {
        $tableDataKeys = [];
        $tableDataDatas = [];
        foreach ($tableDatas as $tableDataKey => $tableDataData)
        {
            $tableDataKeys[] = $tableDataKey;
            $tableDataDatas[] = $tableDataData;
        }
        $sql = "INSERT INTO ". $table. " (";
        $estPremier = true;
        foreach ($tableDataKeys as $tableDataKey)
        {
            if(!$estPremier)
            {
                $sql.=",";
            }
            $sql.= $tableDataKey;
            $estPremier = false;
        }
        $sql.= ") VALUES (";
        $estPremier = true;
        foreach ($tableDataDatas as $tableData)
        {
            if(!$estPremier)
            {
                $sql.=",";
            }
            $sql.= '"'.$tableData.'"';
            $estPremier = false;
        }
        $sql.= ")";
        $req = $this->getBdd()->prepare($sql);
        $req->execute();
        $req->closeCursor();
    }

    private function fetch($sql, $obj){
        $var = [];
        $req = $this->getBdd()->prepare($sql);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        $req->closeCursor();
        return $var;
    }

    public function maxId($table)
    {
        $sql = "SELECT MAX(id) FROM ". $table;
        $req = $this->getBdd()->prepare($sql);
        $req->execute();
        $res = $req->fetch();
        $req->closeCursor();
        return $res['MAX(id)'];
    }
}