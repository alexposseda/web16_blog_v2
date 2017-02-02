<?php

    namespace app\models;

    use core\base_classes\BaseForm;
    use core\components\Db;

    class LoginForm extends BaseForm{
        public $login;
        public $password;

        public function getRules(){
            return [
                'login' => ['required'],
                'password' => ['required'],
            ];
        }

        public function doLogin(){
            $db = Db::getDb();
            $this->login = $db->getSafeData($this->login);
            $this->password = $db->getSafeData(md5($this->password));
            $sql = "SELECT id FROM ".UserEntry::getTableName()." WHERE email = {$this->login} AND password = {$this->password}";
            $result = $db->query($sql);
            if($result->num_rows > 0){
                $userId = $result->fetch_assoc()['id'];
                return new UserEntry($userId);
            }

            return null;
        }

    }