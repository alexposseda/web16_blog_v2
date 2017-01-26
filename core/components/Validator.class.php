<?php

    namespace core\components;

    class Validator{
        protected $_errors = [];
        protected $_rules  = [];
        protected $_data   = [];

        protected $_defaultMessages = [
            'email'    => 'Wrong Email Formatt!',
            'required' => 'Field must not be empty!',
            'unique' => 'Field must be unique!',
        ];

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
        public function __construct(array $rules, array $data){
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

            if(empty($this->_errors)){
                return true;
            }

            return false;
        }

        /**
         * @param string $fieldName
         * @param array  $params
         */
        protected function email($fieldName, $params = []){
            $message = $this->_defaultMessages['email'];
            if(!isset($params['pattern'])){
                $pattern = '/^\w+@\w{1,}\.\w{2,}$/';
            }else{
                $pattern = $params['pattern'];
            }

            if(isset($params['message'])){
                $message = $params['message'];
            }

            if(!preg_match($pattern, $this->_data[$fieldName])){
                $this->_errors[$fieldName][] = $message;
            }
        }

        /**
         * @param string $fieldName
         * @param array  $params
         */
        protected function required($fieldName, $params = []){
            $message = $this->_defaultMessages['required'];
            if(isset($params['message'])){
                $message = $params['message'];
            }
            if(empty($this->_data[$fieldName])){
                $this->_errors[$fieldName][] = $message;
            }
        }

        protected function unique($fieldName, $params= []){
            $message = $this->_defaultMessages['unique'];
            if(isset($params['message'])){
                $message = $params['message'];
            }

            if(!isset($params['tableName'])){
                throw new \Exception('property tableName not set in unique validator');
            }
            $db = Db::getDb();
            $sql = "SELECT * FROM ".$params['tableName']."WHERE ".$fieldName." = ".$db->getSafeData($this->_data[$fieldName]);

            $result = $db->query($sql);
            if($result->num_rows > 0){
                $this->_errors[$fieldName][] = $message;
            }
        }

        public function getErrors(){
            return $this->_errors;
        }
    }