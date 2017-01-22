<?php

    namespace core\components;

    class View{
        protected $_layout = 'app/views/layouts/main.php';
        protected $_pageData = [];

        /**
         * @param array $data
         */
        public function setData(array $data){
            foreach($data as $key => $value){
                $this->$key = $value;
            }
        }

        /**
         * @param string $tpl
         *
         * @return string
         * @throws \Exception
         */
        public function render($tpl){
            $path = 'app/views/'.$tpl.'.php';
            if(!file_exists($path)){
                throw new \Exception('View file: ['.$tpl.'] not found!');
            }

            include $this->_layout;
        }
    }