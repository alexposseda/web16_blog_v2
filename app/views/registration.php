<?php
    /**
     * @var \core\components\View $this
     * @var \app\models\RegistrationForm  $regForm
     */

    $this->title = 'Registration';
    $formErrors = $regForm->getErrors();
?>
<div class="container">
    <div class="row">
        <div class="col s12 m8 offset-m2 l6 offset-l3">
            <?php if(!empty($formErrors)):?>
            <div class="card-panel pink accent-3">
                <?php foreach($formErrors as $field => $errors):?>
                    <div>
                        <strong><?= $field?></strong> has some errors:
                        <ul class="browser-default">
                            <?php foreach($errors as $error):?>
                                <li><?= $error?></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <div class="divider"></div>
                    <?php endforeach;?>
            </div>
            <?php endif;?>
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title">Registration</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="input-field">
                            <input id="email"
                                   type="email"
                                   name="email"
                                   class="validate <?= (key_exists('email', $formErrors)) ? ' invalid' : ''?>" value="<?= (!empty($_POST['email'])) ? $_POST['email'] : ''?>">
                            <label for="email" <?= (key_exists('email', $formErrors)) ? 'data-error="'.implode('<br>', $formErrors['email']).'"' : ''?>>Email</label>
                        </div>
                        <div class="input-field">
                            <input id="name" type="text" name="name" class="validate">
                            <label for="name">Your Name</label>
                        </div>
                        <div class="input-field">
                            <input id="password" type="password" name="password" class="validate">
                            <label for="password">Your Password</label>
                        </div>
                        <div class="input-field">
                            <input id="password_confirm" name="password_confirm" type="password" class="validate">
                            <label for="password_confirm">Confirm Your Password</label>
                        </div>
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Avatar</span>
                                <input type="file" name="picture">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                        <div class="input-field">
                            <button class="btn waves-effect waves-light" type="submit" name="action" style="width: 100%;">Registration
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>