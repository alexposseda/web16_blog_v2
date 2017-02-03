<?php
    /**
     * @var \core\components\View $this
     * @var \app\models\CategoryEntry $category
     */
?>

<form method="POST">
    <input type="text" name="title" value="<?= $category->title?>">
    <button>Create</button>
</form>