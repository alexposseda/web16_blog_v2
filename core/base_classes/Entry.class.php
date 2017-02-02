<?php

    namespace core\base_classes;

    use core\components\Db;

    /**
     * Class Entry
     * @package base
     */
    abstract class Entry{
        protected $_db;
        protected static $_tableName;

        public function __construct($entry_id = null){
            $this->_db = Db::getDb();
            if(!empty($entry_id) and !is_null($entry_id)){
                $sql = "SELECT * FROM ".static::$_tableName." WHERE id = ".$this->_db->getSafeData($entry_id);
                $mysqli_result = $this->_db->query($sql);
                if($mysqli_result->num_rows > 0){
                    $post = $mysqli_result->fetch_object();
                    foreach ($post as $key => $value) {
                        $this->$key = $value;
                    }
                }
            }
        }

        /**
         * @return array|null
         */
        public static function findAll(){
            $sql = "SELECT * FROM ".static::$_tableName;
            $db = Db::getDb();
            $mysqli_result = $db->query($sql);
            if($mysqli_result->num_rows > 0){
                $rows = [];
                while($row = $mysqli_result->fetch_object(static::className())){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return null;
            }
        }

        /**
         * @param array $condition
         *
         * @return null|object|\stdClass
         */
        public static function findOne($condition){
            $db = Db::getDb();
            $sql = "SELECT * FROM ".static::$_tableName." WHERE ";
            $sql .= $condition[0].$condition[1].$db->getSafeData($condition[2]);
            $mysqli_result = $db->query($sql);
            if($mysqli_result->num_rows > 0){
                return $mysqli_result->fetch_object(static::className());
            }
            return null;
        }

        public function load($data){
            foreach($data as $propName => $propValue){
                $this->$propName = $propValue;
            }

            return $this;
        }

        abstract public static function className();

        public function create($data){
            $fields = implode(',', array_keys($data));
            $sql = "INSERT INTO ".static::$_tableName." ({$fields}) VALUE (";
            foreach($data as $value){
                $sql .= $this->_db->getSafeData($value).',';
            }
            $sql = substr($sql, 0, -1);
            $sql .= ')';
            $result = $this->_db->query($sql);
            if($result){
                return $this->_db->getLastInsertId();
            }

            return false;
        }

        public function update($data){
            $sql = "UPDATE ".static::$_tableName." SET ";
            foreach($data as $key => $value){
                $sql .= $key.'='.$this->_db->getSafeData($value).',';
            }
            $sql = substr($sql, 0, -1);
            $sql .= " WHERE id = ".$this->id;

            $result = $this->_db->query($sql);
            if($result){
                return $this->_db->getLastInsertId();
            }

            return false;
        }

        public function delete(){
            $sql = "DELETE FROM ".static::$_tableName." WHERE id = ".$this->id;
            $result = $this->_db->query($sql);
            if($result){
                return true;
            }

            return false;
        }

        public static function getTableName(){
            return static::$_tableName;
        }
    }