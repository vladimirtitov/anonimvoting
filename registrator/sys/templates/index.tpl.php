<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="<?php echo $path.'/css/anonimvoting.css'?>">
</head>
<body>
<header>
    <div>
        <h1>СТЭГ</h1>
    </div>
    <nav>
        <?php
        if($this_id==0){
            echo '<a href="'.$path.'/login">Войти</a>';
            echo ' <a href="'.$path.'/register">Регистрация</a>';
        }else{
            echo '<a href="'.$path.'/account">Аккаунт</a>';
            if($isAdmin == 1)
                echo '<a href="'.$path.'/admin">Панель администратора</a>';
            echo '<a href="'.$path.'/logout">Выйти</a>';
        }
        ?>
    </nav>
</header>
<section class="container">
    <?php include_once(ROOT.'/sys/templates/'.$tpl.'.tpl.php');
    print_r($info)?>
</section>
<footer>
    <p><small>&copy; 2018 Титов Владимир Сергеевич МИТ-21</small></p>
</footer>
</body>
</html>