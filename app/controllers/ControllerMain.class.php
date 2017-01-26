<?php

    namespace app\controllers;

    use app\models\PostForm;
    use core\base_classes\Controller;

    class ControllerMain extends Controller{
        public function actionIndex(){
            $postForm = new PostForm();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($postForm->load($_POST)){
                    //save new post to db
                }
            }

            return $this->render('main', ['postForm' => $postForm]);
        }

    }