<?php

    namespace core\base_classes;

    use core\components\Validator;

    abstract class BaseForm{
        protected $_errors = [];
        protected $_data;
        protected $_validator = null;
        protected $_messages = [];

        abstract public function getRules();

        /**
         * @param array $data
         *
         * @return bool
         */
        public function load($data){
            //todo filter must be here
            foreach($data as $propName => $propValue){
                if(property_exists(static::class, $propName)){
                    $this->$propName = $propValue;
                    $this->_data[$propName] = $propValue;
                }
            }
            return $this->validate();
        }

        /**
         * @return bool
         */
        public function validate(){
            $validator = new Validator($this->getRules(), $this->_data);

            if(!$validator->validate()){
                $this->_errors = $validator->getErrors();
                return false;
            }
            return true;
        }

        public function getErrors(){
            return $this->_errors;
        }

        /**
         * @return array
         */
        public function getData(){
            return $this->_data;
        }

        public function addError($field, $msg){
            $this->_errors[$field][] = $msg;
            return $this;
        }

        public function getMessages(){
            return $this->_messages;
        }

        public function addMessage($type, $msg){
            $this->_messages[$type][] = $msg;
            return $this;
        }
    }