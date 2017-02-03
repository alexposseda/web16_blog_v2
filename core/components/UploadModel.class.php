<?php

    namespace core\components;

    class UploadModel{
        public $picture;
        public static $_fieldName = 'picture';
        protected $_storagePath = '';
        protected $_errors = [];

        public function __construct(){
            $c = require 'core/config/main.php';
            $this->_storagePath = $c['storage_path'];
        }

        public function upload(){
            if(!empty($_FILES[self::$_fieldName])){
                if($_FILES[self::$_fieldName]['error'] == 0){
                    $dirname = date("Y_m");
                    if(!file_exists($this->_storagePath.$dirname)){
                        mkdir($this->_storagePath.$dirname, 0755);
                    }
                    $this->picture = $dirname.'/'.time().'.'.pathinfo($_FILES[self::$_fieldName]['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES[self::$_fieldName]['tmp_name'], $this->_storagePath.$this->picture);

                    return true;
                }else{
                    $this->_errors[self::$_fieldName][] = 'Ошибка загрузки файла ['.$_FILES[self::$_fieldName]['error'].']';
                }
            }

            return false;
        }

        public function getErrors(){
            return $this->_errors;
        }
    }