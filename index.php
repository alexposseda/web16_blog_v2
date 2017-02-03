<?php
    use core\components\Url;

    session_start();
    function __autoload($className){
        $className = str_replace('\\', '/', $className);
        require_once $className.'.class.php';
    }



    $controllerName = Url::getUrlSegment(0);
    $actionName = Url::getUrlSegment(1);

    if(is_null($controllerName)){
        $controllerName = 'ControllerMain';
    }else{
        $controllerName = 'Controller'.ucfirst($controllerName);
    }

    if(is_null($actionName)){
        $actionName = 'actionIndex';
    }else{
        $actionName = 'action'.ucfirst($actionName);
    }

    try{
        if(!file_exists('app/controllers/'.$controllerName.'.class.php')){
            throw new \core\exceptions\NotFoundHttpException('This page not found!');
        }
        $controllerName = '\app\controllers\\'.$controllerName;
        $controller = new $controllerName();
        if(!method_exists($controller, $actionName)){
            throw new \core\exceptions\NotFoundHttpException('This page not found!');
        }
        $output = $controller->$actionName();

        echo $output;

    }catch(\core\exceptions\NotFoundHttpException $e){
        header('HTTP/1.1 404 Not Found');
        //todo add view!
        echo $e->getMessage();
    }catch(Exception $e){
        echo 'Error! message: '.$e->getMessage();
    }

