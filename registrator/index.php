<?php
    define(ROOT, $_SERVER['DOCUMENT_ROOT'].'/anonimvoting/www');
    require(ROOT.'/sys/core.php');
    $request = explode("/", $_SERVER["REQUEST_URI"]);
    $page = $request[3];
    $ext = $request[4];
    $pdo = init();
//Проверка авторизации
	$cookie_id = $_COOKIE['id'];
	$cookie_hash = $_COOKIE['hash'];
print_r($cookie_id);
print_r($cookie_hash);
$this_id = check($pdo, $cookie_id, $cookie_hash);
switch($page){
            case 'login':
                $tpl = 'login';
                $title = 'Авторизация';
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
                    $name = clearStr($_POST['name']);
                    $password = clearStr($_POST['password']);
                    $password_double = clearStr($_POST['password_double']);
                    if(!empty($mail) && !empty($password) && !empty($password_double)){
                        if($password != $password_double){
                            print 'Пароли не совпадают';
                        }else{
                            if(register($pdo, $mail, $name,$password)){
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
                                    print 'Группа с таким именем уже есть';
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
                                    print 'Изменений нет';
                                }
                            }
                            else{
                                print 'Название группы не менее 3 символов';
                            }
                        }
                        break;
                    case 'users':
                        $tpl = 'users';
                        $title = 'Пользователи';
                        break;
                    case 'edituser':
                        $tpl = 'edituser';
                        $title = 'Редактирование пользователя';
                        $id = $request[3];
                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            //TODO добавиь проверку
                            $group_id = clearInt($_POST['selectGroups']);
                            $status = clearInt($_POST['selectStatus']);
                            if(updateUser($pdo, $id, $group_id,$status)){
                                header("location: /admin/users");
                            }else{
                                print 'Изменений нет';
                            }
                        }
                        break;
                    case 'votes':
                        $tpl = 'votes';
                        $title = 'Голосования';
                        $subvotes = $request[3];
                        switch ($subvotes){
                            case 'current':
                                break;
                            case 'future':
                                break;
                            case 'past':
                                break;
                        }
                        break;
                    case 'addvote':
                        $tpl = 'addvote';
                        $title = 'Создание голосования';
                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            if(createVote($pdo, $name)){
                                header("location: /admin/votes");
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