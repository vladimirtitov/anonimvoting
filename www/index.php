<?php
    define(ROOT, $_SERVER['DOCUMENT_ROOT']);
    require(ROOT.'/sys/core.php');
    $request = explode("/", $_SERVER["REQUEST_URI"]);
    $page = $request[1];
    $ext = $request[2];
    $pdo = init();
    // Проверка авторизации
	$cookie_id = $_COOKIE['id'];
	$cookie_hash = $_COOKIE['hash'];
	$this_id = check($pdo, $cookie_id, $cookie_hash);
    switch($page){
            case 'login':
                $tpl = 'login';
                $title = 'Жопа';
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
                $title = 'Регистрация';
                $tpl = 'register';
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $mail = clearStr($_POST['mail']);
                    $password = clearStr($_POST['password']);
                    $password_double = clearStr($_POST['password_double']);
                    if(!empty($mail) && !empty($password) && !empty($password_double)){
                        if($password != $password_double){
                            print 'Пароли не совпадают';
                        }else{
                            if(register($pdo, $mail, $password)){
                                header('location: /login');
                            }else{
                                print 'Регистрация не получилась :(';
                            }
                        }
                    }
                }
                break;
            case 'user':
                echo '<h2>Профиль пользователя</h2>';
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
            case 'admin':
                // TODO: Проверить является ли пользователь админом
                $tpl = 'adminpanel';
                $title = 'Панель администратора';
                switch ($ext){
                    case 'requests':
                        $tpl = 'requests';
                        $title = 'Заявки';
                        $info="";
                        if(count($request)>3){
                            $command = $request[3];
                            switch ($command)
                            {
                                case "accept":
                                    $id = $request[4];
                                    if(updateUserStatus($pdo,$id, 1)){
                                        $info = 'Запрос пользователя подтвержден';
                                        header("location: /admin/requests");
                                    }
                                    else $info = 'Произашла ошибка';
                                    break;
                                case "reject":
                                    $id = $request[4];
                                    if(updateUserStatus($pdo,$id, 2)){
                                        $info = 'Запрос пользователя отклонен';
                                        header("location: /admin/requests");
                                    }
                                    else $info = 'Произашла ошибка';
                                    break;
                            }
                        }
                        break;
                    case 'groups':
                        $tpl = 'groups';
                        $title = 'Группы';
                        $info="";
                        break;
                    case 'addgroup':
                        $tpl = 'addgroup';
                        $title = 'Добавление группы';
                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            $name = clearStr($_POST['name']);
                            if(strlen($name) > 3){
                                if(addGroup($pdo, $name)){
                                    header("location: /admin/groups");
                                }else{
                                    print 'Название группы не менее 3 символов';
                                }
                            }
                            else{
                                print 'Название группы не менее 3 символов';
                            }
                        }
                        break;
                    case 'editgroup':
                        $tpl = 'editgroup';
                        $title = 'Редактирование группы';
                        $id = $request[3];
                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            $name = clearStr($_POST['name']);
                            if(strlen($name) > 3){
                                if(updateGroup($pdo, $id, $name)){
                                    header("location: /admin/groups");
                                }else{
                                    print 'Название группы не менее 3 символов';
                                }
                            }
                            else{
                                print 'Название группы не менее 3 символов';
                            }
                        }
                        break;
                }
                break;
            default:
                $title = 'Страница по умолчанию';
                $tpl = 'default';
        }
    include_once(ROOT.'/sys/templates/index.tpl.php');