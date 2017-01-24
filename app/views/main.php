<?php
    /**
     * @var \core\components\View $this
     * @var \app\models\PostEntry[] $posts
     */

    $this->title = 'My New Title';
    $this->addCssLink('css/style_main.css');
?>
<h1>Hello from main</h1>

<?php
    if(!is_null($posts)){
        foreach($posts as $post){
            echo $post->title.'<br>';
        }
    }else{
        echo 'no posts found';
    }
?>
