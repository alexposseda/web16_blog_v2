<?php
    use core\components\Url;

    session_start();
    function __autoload($className){
        $className = str_replace('\\', '/', $className);
        require_once $className.'.class.php';
    }



//    $controllerName = Url::getUrlSegment(0);
//    $actionName = Url::getUrlSegment(1);
//
//    if(is_null($controllerName)){
//        $controllerName = 'ControllerMain';
//    }else{
//        $controllerName = 'Controller'.ucfirst($controllerName);
//    }
//
//    if(is_null($actionName)){
//        $actionName = 'actionIndex';
//    }else{
//        $actionName = 'action'.ucfirst($actionName);
//    }
//
//    try{
//        if(!file_exists('app/controllers/'.$controllerName.'.class.php')){
//            throw new \core\exceptions\NotFoundHttpException('This page not found!');
//        }
//        $controllerName = '\app\controllers\\'.$controllerName;
//        $controller = new $controllerName();
//        if(!method_exists($controller, $actionName)){
//            throw new \core\exceptions\NotFoundHttpException('This page not found!');
//        }
//        $output = $controller->$actionName();
//
//        echo $output;
//
//    }catch(\core\exceptions\NotFoundHttpException $e){
//        header('HTTP/1.1 404 Not Found');
//        //todo add view!
//        echo $e->getMessage();
//    }catch(Exception $e){
//        echo 'Error! message: '.$e->getMessage();
//    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

//        //todo проверить файл
        $fileName = 'storage/'.time().'.'.pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['picture']['tmp_name'], $fileName);
//        $src_image = imagecreatefromjpeg($fileName);
        //        $sizes = getimagesize($fileName);
        //        $dest_img = imagecreate(640, 480);
        //        imagecopyresized($dest_img, $src_image, 0,0, 0, 0, 640, 480, $sizes[0], $sizes[1]);
        //        imagejpeg($dest_img, 'storage/pic1.png');
        //        imagedestroy($dest_img);

        $image = new \core\components\Image($fileName);
        $image->createThumbs();
    }
?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="picture">
    <button>SUBMIT</button>
</form>
