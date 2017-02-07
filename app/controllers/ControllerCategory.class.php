<?php

    namespace app\controllers;

    use app\models\CategoryEntry;
    use app\models\CategoryForm;
    use core\base_classes\Controller;
    use core\components\Auth;
    use core\components\Url;
    use core\exceptions\NotFoundHttpException;

    class ControllerCategory extends Controller{
        public function actionIndex(){
            // TODO: Implement actionIndex() method.
        }

        public function actionCreate(){
            if(!Auth::checkRole(['admin'])){
                throw new NotFoundHttpException('Direct access denied!');
            }
            $form = new CategoryForm();
            $result = 0;
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($form->load($_POST)){
                    $category = new CategoryEntry();
                    $categoryId = $category->create($form->getData());
                    if($categoryId){
                        if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest'){
                            header('Location: /category/view/'.$categoryId);
                        }else{
                            $result = 1;
                        }
                    }
                }
            }
            if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest'){
                return $this->render('category/create');
            }

            return $result;
        }

        public function actionUpdate(){
            if(!Auth::checkRole(['admin'])){
                throw new NotFoundHttpException('Direct access denied!');
            }

            $categoryId = Url::getUrlSegment(2);
            if(is_null($categoryId)){
                throw new NotFoundHttpException('category not found!');
            }

            $category = $this->findCategory($categoryId);
            $form = new CategoryForm();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($form->load($_POST)){
                    $res = $category->createSlug()->update($form->getData());
                    if($res){
                        header('Location: /category/view/'.$category->id);
                    }
                }
            }
            return $this->render('category/update', ['category' => $category]);
        }

        public function actionDelete(){
            if(!Auth::checkRole(['admin'])){
                throw new NotFoundHttpException('Direct access denied!');
            }
        }

        public function actionView(){
            $categoryId = Url::getUrlSegment(2);
            if(is_null($categoryId)){
                throw new NotFoundHttpException('category not found!');
            }

            $category = $this->findCategory($categoryId);

            return $this->render('category/view', ['category' => $category]);
//            return var_dump($_SERVER);
        }

        protected function findCategory($categoryId){
            $model = CategoryEntry::findOne(['id', '=', $categoryId]);
            if(is_null($model)){
                throw new NotFoundHttpException('category not found!');
            }
            return $model;
        }
    }