<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/assets/css/materialize.min.css" media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $this->title ?></title>
    <?php $this->renderCss(); ?>
</head>
<body>
<div class="navbar-fixed">
    <?php if(\core\components\Auth::isGuest()): ?>
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="#modal1">Login</a></li>
            <li><a href="/main/registration">Registration</a></li>
        </ul>
    <?php else: ?>
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="#!">Personal</a></li>
            <li class="divider"></li>
            <li><a href="/main/logout">Logout</a></li>
        </ul>
    <?php endif; ?>
    <nav>
        <div class="container">
            <div class="nav-wrapper">
                <a href="/" class="brand-logo">Logo</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="/category/index">Categories</a></li>
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons">account_box</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<?= $content; ?>
<?php if(\core\components\Auth::isGuest()): ?>
    <div id="modal1" class="modal">
        <form method="post" action="/main/login">
            <div class="modal-content">
                <h4>Login</h4>
                <p>Please enter your email and password!</p>
                <div class="input-field">
                    <input id="email"
                           type="email"
                           name="login"
                    >
                    <label for="email">Email</label>
                </div>
                <div class="input-field">
                    <input id="password" type="password" name="password" class="validate">
                    <label for="password">Your Password</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn waves-effect waves-light" type="submit" name="action" style="width: 100%;">Login
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
<?php endif; ?>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="/assets/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/assets/js/materialize.min.js"></script>
<script>
    $(document).ready(function () {
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal').modal();
    });
</script>
</body>
</html>