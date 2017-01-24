<?php

    namespace core\base_classes;

    use core\components\View;

    abstract class Controller{
        protected $_view;

        public function __construct(){
            $this->_view = new View();
        }

        abstract public function actionIndex();

        /**
         * @param string $tpl
         * @param array $data
         *
         * @return string
         */
        public function render($tpl, $data = []){
            return $this->_view->render($tpl, $data);
        }
    }