<?php

    namespace app\controllers;

    use core\base_classes\Controller;
    use core\components\Auth;
    use core\exceptions\NotFoundHttpException;

    class ControllerAdmin extends Controller{
        public function actionIndex(){
            if(!Auth::checkRole(['admin'])){
                throw new NotFoundHttpException('Direct access denied!');
            }
        }

    }