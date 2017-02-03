<?php

    namespace app\models;

    use core\base_classes\Entry;

    class UserEntry extends Entry{
        protected static $_tableName = 'user';

        public static function className(){
            return __CLASS__;
        }

        public function doRegistration(){
            $data = [
                'email' => $this->email,
                'name' => $this->name,
                'password' => md5($this->password),
                'avatar' => (empty($this->avatar)) ? '' : $this->avatar,
            ];
            $res = $this->create($data);
            if($res){
                return new self($res);
            }

            return null;
        }
    }