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

    protected function getOne($table, $id, $obj){
        $rows = $this->fetch('SELECT * FROM ' . $table . " WHERE id = " . $id, $obj);
        if(count($rows)){
            return $rows[0];
        }
        return null;
    }

    public function addToTable($table, $tableDatas)
    {
        $sql = "INSERT INTO " . $table . " VALUES (";
        $estPremier = true;
        foreach ($tableDatas as $tableData)
        {
            if(!$estPremier){
                $sql.= ", ";
            }
            $sql.= $tableData;
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
}