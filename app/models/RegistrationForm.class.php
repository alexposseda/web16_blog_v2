<?php

    namespace app\models;

    use core\base_classes\BaseForm;

    class RegistrationForm extends BaseForm{
        public $email;
        public $name;
        public $password;
        public $password_confirm;

        public function getRules(){
            return [
                'email' => [
                    'required',
                    'unique' => [
                        'tableName' => 'user'
                    ]
                ],
                'name' => [
                    'required'
                ],
                'password' => [
                    'required',
                    'compare' => ['field' => 'password_confirm']
                ]
            ];
        }

    }