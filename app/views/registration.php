<?php
    /**
     * @var \core\components\View $this
     * @var \app\models\PostForm $postForm
     */

    $this->title = 'Registration';
    var_dump($regForm->getErrors());
?>
    <form method="POST">
        <input type="email" name="email" placeholder="email"><br>
        <input type="text" name="name" placeholder="name"><br>
        <input type="password" name="password"><br>
        <input type="password" name="password_confirm"><br>
        <button>Registration</button>
    </form>
