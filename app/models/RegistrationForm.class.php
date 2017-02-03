<?php

    namespace app\models;

    use core\base_classes\BaseForm;
    use core\components\Image;
    use core\components\UploadModel;

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

        public function uploadAvatar(){
            $uploadModel = new UploadModel();
            if($uploadModel->upload()){
                $avatar = new Image($uploadModel->picture);
                $avatar->createThumbs('avatar');
                $this->_data['avatar'] = $uploadModel->picture;
                return true;
            }else{
                array_merge($this->_errors, $uploadModel->getErrors());
                return false;
            }
        }

    }