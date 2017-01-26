<?php

    namespace core\base_classes;

    use core\components\Validator;

    abstract class BaseForm{
        protected $_errors = [];
        protected $_data;
        protected $_validator = null;

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

        public function getData(){
            return $this->_data;
        }
    }