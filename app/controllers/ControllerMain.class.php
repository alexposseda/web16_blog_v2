<?php

    namespace app\controllers;

    use app\models\LoginForm;
    use app\models\PostForm;
    use app\models\RegistrationForm;
    use app\models\UserEntry;
    use core\base_classes\Controller;
    use core\components\Auth;
    use core\exceptions\NotFoundHttpException;

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

        public function actionRegistration(){
            if(!Auth::isGuest()){
                throw new NotFoundHttpException();
            }
            $regForm = new RegistrationForm();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($regForm->load($_POST) and $regForm->uploadAvatar()){
                    $user = new UserEntry();
                    $user = $user->load($regForm->getData())->doRegistration();
                    if(!is_null($user)){
                        Auth::login([
                                        'id'   => $user->id,
                                        'role' => $user->role,
                                    ]);

                        header('Location: /');
                    }
                }
            }

            return $this->render('registration', ['regForm' => $regForm]);
        }

        public function actionLogout(){
            if(Auth::isGuest()){
                throw new NotFoundHttpException();
            }

            Auth::logout();
            header("Location: /");
        }

        public function actionLogin(){
            if(!Auth::isGuest()){
                throw new NotFoundHttpException('Вы уже авторизировались!');
            }
            $model = new LoginForm();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($model->load($_POST)){
                    $user = $model->doLogin();
                    if(!is_null($user)){
                        Auth::login([
                                        'id'   => $user->id,
                                        'role' => $user->role,
                                    ]);

                        header('Location: /');
                    }else{
                        $model->addMessage('error', 'Вы ввели неверные данные!');
                    }
                }
            }
            return $this->render('login', ['model' => $model]);
        }
    }