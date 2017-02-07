<?php
    /**
     * @var \core\components\View $this
     */
?>

<form method="POST" id="category-create">
    <input type="text" name="title" id="category-title">
    <button>Create</button>
</form>
<script>
    $(document).ready(function(){
        $('#category-create').on('submit', function(e){
            var e = e ||event;
            e.preventDefault();
            var data = {};
            $(this).find('input').each(function(){
                data[$(this).attr('name')] = $(this).val();
            });
            $.post('/category/create', $data, function(result){
                console.log(result);
            });
        })
    });
</script>
