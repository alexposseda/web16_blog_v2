<?php
    /**
     * @var \core\components\View $this
     * @var \app\models\PostForm $postForm
     */

    $this->title = 'My New Title';
    var_dump($postForm->getErrors());
?>

<form method="POST">
    <div>
        <input type="text" name="title" placeholder="title">
    </div>
    <div>
        <textarea name="content" cols="100" rows="5"></textarea>
    </div>
    <div>
        <select name="category_id">
            <option value="1">PHP</option>
            <option value="2">JS</option>
        </select>
    </div>
    <div>
        <select name="status">
            <option value="not_publish" selected>Черновик</option>
            <option value="moderate">Опубликовать</option>
        </select>
    </div>
    <button>Create</button>
</form>

