<?php
    define(ROOT, $_SERVER['DOCUMENT_ROOT'].'/anonimvoting/www/');
    $request = explode("/", $_SERVER["REQUEST_URI"]);
    $page = $request[3];
    $ext = $request[4];
    switch($page){
            case 'login':
                $tpl = 'login';
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $mail = clearStr($_POST['mail']);
                    $password = clearStr($_POST['password']);
                    if(strlen($mail) > 3 && strlen($password) > 2){
                        //print $mail.' '.$password;
                        if(login($pdo, $mail, $password)){
                            header("location: /user");
                        }else{
                            print 'Неверный логин или пароль';
                        }
                    }
                }
                break;
            case 'logout':
                echo '<h2>Тут мы разлогиваемся</h2>';
                break;
            case 'register':
                echo '<h2>Страница авторизации</h2>';
                break;
            case 'user':
                echo '<h2>Профлиь пользователя</h2>';
                break;
            case 'post':
                echo '<h2>Конкретный пост</h2>';
                break;
            case 'news':
                echo '<h2>Страница новостей</h2>';
                break;
            default:
                $title = "Страница по умолчанию";
                $tpl = "default";
        }
    include_once(ROOT.'/sys/templates/index.tpl.php');

