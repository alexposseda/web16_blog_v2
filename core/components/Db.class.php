<?php

    namespace core\components;
    /**
     * Class Db
     * @package core\components
     */
    class Db{
        protected $_config = [];
        private static $link = null;
        private $_mysqli;

        private function __construct(){
            $this->_config = require_once 'core/config/db.php';
            $this->_mysqli = new \mysqli($this->_config['host'], $this->_config['user'], $this->_config['password'], $this->_config['db_name']);
            $this->_mysqli->set_charset('utf8');
        }

        public function __destruct(){
            $this->_mysqli->close();
            self::$link = null;
        }

        /**
         * @return Db
         */
        public static function getDb(){
            if(is_null(self::$link)){
                self::$link = new self();
            }

            return self::$link;
        }

        /**
         * @param string $sql
         *
         * @return \mysqli_result
         * @throws \Exception
         */
        public function query($sql){
            $result = $this->_mysqli->query($sql);
            if(!$result){
                throw new \Exception($this->_mysqli->error."<br>$sql");
            }

            return $result;
        }

        /**
         * @param string|integer|null $data
         *
         * @return string
         */
        public function getSafeData($data){
            if(is_null($data)){
                return 'NULL';
            }
            if(is_string($data)){
                return "'".$this->_mysqli->escape_string($data)."'";
            }

            return $this->_mysqli->escape_string($data);
        }

        /**
         * @return integer|null
         */
        public function getLastInsertId(){
            return $this->_mysqli->insert_id;
        }
    }