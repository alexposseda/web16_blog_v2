<?php

    namespace core\components;

    class Auth{
        public static function isGuest(){
            if(empty($_SESSION['user'])){
                return true;
            }
            return false;
        }

        public static function checkRole(array $roles){
            foreach($roles as $role){
                if($role == $_SESSION['user']['role']){
                    return true;
                }
            }

            return false;
        }

        public static function login(array $user){
            $_SESSION['user'] = [
                'id' => $user['id'],
                'role' => $user['role']
            ];
        }

        public static function logout(){
            session_unset();
            session_destroy();
        }
    }