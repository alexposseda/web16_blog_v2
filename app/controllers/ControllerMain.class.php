<?php

    namespace app\controllers;

    use core\base_classes\Controller;

    class ControllerMain extends Controller{
        public function actionIndex(){
            return $this->render('main', ['model' => [123,345]]);
        }

    }