<?php

    namespace core\components;
    /**
     * Class Url
     * @package core\components
     */
    class Url{
        /**
         * @param integer $n
         *
         * @return string|null
         */
        public static function getUrlSegment($n){
            $segments = self::getAllUrlSegments();
            if(!empty($segments[$n])){
                return $segments[$n];
            }
            return null;
        }

        /**
         * @return array
         */
        public static function getAllUrlSegments(){
            $url = $_GET['route'];
            $routes = explode('/', $url);
            if(empty($routes[0])){
                return [];
            }
            $lastIndex = count($routes)-1;
            if(empty($routes[$lastIndex])){
                array_pop($routes);
            }
            return $routes;
        }

        /**
         * @param string $paramName
         *
         * @return string|null
         */
        public static function getParam($paramName){
            if(!empty($_GET[$paramName])){
                return $_GET[$paramName];
            }

            return null;
        }
    }