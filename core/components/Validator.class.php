<?php

    namespace core\components;

    class Validator{
        protected $_errors = [];
        protected $_rules = [];
        protected $_data = [];

        /**
         * Validator constructor.
         *
         * @param array $rules
         * @param array $data
         *
         *
         * Массив $rules должен быть вида:
         * [
         *  fieldName => [
         *                validatorName => validatorParams,
         *                 0 => validatorName,
         *               ]
         * ]
         */
        public function __construct(array $rules,array $data){
            $this->_rules = $rules;
            $this->_data = $data;
        }

        public function validate(){
            foreach($this->_rules as $fieldName => $validators){
                foreach($validators as $validator => $params){
                    if(is_int($validator)){
                        $validator = $params;
                        $params = [];
                    }
                    if(!method_exists($this, $validator)){
                        throw new \Exception('Validator ['.$validator.'] doesnot exists!');
                    }
                    $this->$validator($fieldName, $params);
                }

            }
        }

        protected function email($fieldName){

        }
    }