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
            case 'addgroup':
                $tpl = 'addgroup';
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $name = clearStr($_POST['name']);
                    $description = clearStr($_POST['$description']);
                    if(strlen($name) > 3){
                        //print $mail.' '.$password;
                        if(login($pdo, $mail, $password)){
                            header("location: /user");
                        }else{
                            print 'Название группы не менее 3 символов';
                        }
                    }
                    else{
                        print 'Название группы не менее 3 символов';
                    }
                }
                break;
            case 'addvoter':
                $tpl = 'addvoter';
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $name = clearStr($_POST['name']);
                    $description = clearStr($_POST['$description']);
                    if(strlen($name) > 3){
                        //print $mail.' '.$password;
                        if(login($pdo, $mail, $password)){
                            header("location: /user");
                        }else{
                            print 'Название группы не менее 3 символов';
                        }
                    }
                    else{
                        print 'Название группы не менее 3 символов';
                    }
                }
                break;
            default:
                $title = "Страница по умолчанию";
                $tpl = "default";
        }
    include_once(ROOT.'/sys/templates/index.tpl.php');

