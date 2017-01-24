<?php

    namespace app\controllers;

    use app\models\PostEntry;
    use core\base_classes\Controller;

    class ControllerMain extends Controller{
        public function actionIndex(){
            $post = new PostEntry(1);
            $data = [
                'title' => 'New title',
                'content' => 'some Content',
                'pubdate' => time(),
                'user_id' => NULL
            ];
            $post->update($data);

            return $this->render('main');
        }

    }