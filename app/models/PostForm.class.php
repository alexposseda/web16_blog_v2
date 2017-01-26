<?php

    namespace app\models;

    use core\base_classes\BaseForm;

    class PostForm extends BaseForm{
        public $title;
        public $content;
        public $category_id;
        public $status;

        public function getRules(){
            return [
                'title'       => [
                    'required',
                    'unique' => [
                        'tableName' => 'post',
                        'message' => 'Заголовок поста должен быть уникальным!'
                    ]
                ],
                'content'     => [
                    'required' => [
                        'message' => 'Тело поста должно быть заполнено!'
                    ]
                ],
                'category_id' => [
                    'required',
                ],
            ];
        }

    }