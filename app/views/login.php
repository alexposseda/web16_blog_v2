<?php
    /**
     * @var \core\components\View $this
     * @var \app\models\LoginForm $model
     */
    $messages = $model->getMessages();
    $errors = $model->getErrors();
?>
<h1>Login</h1>
<form method="POST">
    <?php if(!empty($messages['error'])):
        var_dump($messages['error']);
    endif;?>
    <div>
    <input type="text" name="login"><br>
        <?php if(!empty($errors['login'])){var_dump($errors['login']);}?>
    </div>
    <input type="password" name="password"><br>
    <?php if(!empty($errors['password'])){var_dump($errors['password']);}?>
    <button>Submit</button>
</form>
