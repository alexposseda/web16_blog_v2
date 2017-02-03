<?php

    namespace app\models;

    use core\base_classes\BaseForm;

    class CategoryForm extends BaseForm{
        public $title;
        public $slug;

        public function getRules(){
            return [
                'title' => [
                    'required',
                    'unique' => [
                        'tableName' => CategoryEntry::getTableName()
                    ]
                ]
            ];
        }



    }