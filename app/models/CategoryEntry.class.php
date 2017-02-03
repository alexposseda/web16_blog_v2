<?php

    namespace app\models;

    use core\base_classes\Entry;

    class CategoryEntry extends Entry{
        protected static $_tableName = 'category';

        public static function className(){
            return __CLASS__;
        }

        public function createSlug(){

            return $this;
        }

    }