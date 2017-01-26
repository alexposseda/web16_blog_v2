<?php

    namespace app\models;

    use core\base_classes\Entry;

    class PostEntry extends Entry{
        protected static $_tableName = 'post';

        public static function className(){
            return __CLASS__;
        }
    }