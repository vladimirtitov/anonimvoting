<?php
/*
* This core functions for application
*/

// Обработка текста
function clearInt($num){
    return abs((int)$num);
}

function clearStr($str){
    return trim(strip_tags($str));
}

function clearHTML($html){
    return trim(htmlspecialchars($html));
}

// Соединение с БД
function init(){
    $config = parse_ini_file(ROOT.'/sys/config.ini');
    //print_r($config);
    $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['schema']}";
    return new PDO($dsn, $config['user'], $config['password'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

//Авторизация
function login($pdo, $mail, $password){
    $mail = $pdo->quote($mail);
    $password = md5($password);
    $sql = 'SELECT id, password FROM av_users WHERE email='.$mail;
    if(!$stmt = $pdo->query($sql)){
        return false;
    } else {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$row){
            return false; // нет такого мыла в базе
        } else {
            $db_password = $row['password'];
            $db_id = $row['id'];
            if($password == $db_password){
                $hash = md5(rand(0, 6400000));
                $sql_update = "UPDATE av_users SET hash='$hash' WHERE id='$db_id'";
                if($pdo->exec($sql_update)){
                    setcookie("id", $db_id, time() + 3600);
                    setcookie("hash", $hash, time() + 3600);
                    return true;
                }else{
                    print 'Exception';
                }
            }
            return false;
        }
    }
}

// Проверка авторизации
function check($pdo, $cookie_id, $cookie_hash){

    if(empty($cookie_id) || empty($cookie_hash)){
        return 0;
    } else {
        $sql = "SELECT hash FROM av_users WHERE id='$cookie_id'";
        if(!$stmt = $pdo->query($sql)){
            return 0;
        } else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$row){
                return 0;
            } else {
                $db_hash = $row['hash'];
                if($cookie_hash == $db_hash){
                    return $cookie_id;
                }
                return 0;
            }
        }
    }
}

function isAdmin($pdo, $cookie_id, $cookie_hash){
    if(empty($cookie_id) || empty($cookie_hash)){
        return 0;
    } else {
        $sql = "SELECT hash, is_admin FROM av_users WHERE id='$cookie_id'";
        if(!$stmt = $pdo->query($sql)){
            return 0;
        } else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$row){
                return 0;
            } else {
                $db_hash = $row['hash'];
                $db_is_admin = $row['is_admin'];
                if($cookie_hash == $db_hash){
                    if($db_is_admin==1)
                    return $db_is_admin;
                }
                return 0;
            }
        }
    }
}
//Регистрация
function register($pdo, $email, $name, $password){
    $email = $pdo->quote($email);
    $name = $pdo->quote($name);
    $password = md5($password);
    $password = $pdo->quote($password);
    //print $mail.' '.$password;
    // TODO: Проверить правильность мыла регулярным выражением
    $sql_check = "SELECT COUNT(id) FROM av_users WHERE email=$email";
    $stmt = $pdo->query($sql_check);
    $row = $stmt->fetch(PDO::FETCH_NUM);
    if($row[0] > 0){
        print 'Учетная запись уже существует. Забыл пароль?';
    }else{
        // Добавляем учетную запись в таблицу av_users
        $sql_insert = "INSERT INTO av_users (email, name, password, status) VALUES ($email, $name,$password, 0)";
        //print $sql_insert;

        if($pdo->exec($sql_insert)){
            /* это раскомментируем в следующем уроке
            $sql = "SELECT id FROM mc_user WHERE mail=$mail";
            $stmt = $pdo->query($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $uid = $row['id'];
            $sql_insert = "INSERT INTO mc_profile (user_id) VALUES ('$uid')";
            $pdo->exec($sql_insert);
            mkdir('content/'.$uid.'/');
            */
            return true;
        }else{
            return false;
        }
    }
}

//Получение всех заявок на регистрацию
function getRequests($pdo){
    $sql = 'SELECT id, email, name FROM av_users WHERE status = 0';
    if(!$stmt = $pdo->query($sql)){
        return array();
    } else {
       return $stmt->fetchAll(PDO::FETCH_UNIQUE);
    }
}
//Добавление группы
function addGroup($pdo, $name){
    $name = $pdo->quote($name);
    $sql_check = "SELECT COUNT(id) FROM av_groups WHERE name=$name";
    $stmt = $pdo->query($sql_check);
    $row = $stmt->fetch(PDO::FETCH_NUM);
    if($row[0] > 0){

    }else{
        // Добавляем учетную запись в таблицу av_users
        $sql_insert = "INSERT INTO av_groups (name) VALUES ($name)";
        //print $sql_insert;
        return $pdo->exec($sql_insert);
    }
}
//Получение пользователей
function getUsers($pdo){
    $sql = 'SELECT av_users.id, av_users.email, av_users.name AS username,av_groups.name AS groupname,av_users.status FROM av_users LEFT JOIN av_groups ON av_users.group_id = av_groups.id';
    if(!$stmt = $pdo->query($sql)){
        return array();
    } else {
        return $stmt->fetchAll(PDO::FETCH_UNIQUE);
    }
}

//Получение пользователя по id
function getUser($pdo, $id){
    $sql = 'SELECT * FROM av_users WHERE id ='.$id;
    if(!$stmt = $pdo->query($sql)){
        return array();
    } else {
        return $stmt->fetch(PDO::FETCH_UNIQUE);
    }
}

//Обновление информации о пользователе
function updateUser($pdo, $id, $group_id, $status){
    $sql = 'UPDATE av_users SET status ='.$status.', group_id='.$group_id.'  WHERE id='.$id;
    return $pdo->exec($sql);
}

//Получение групп
function getGroups($pdo){
    $sql = 'SELECT id, name FROM av_groups ORDER BY id';
    if(!$stmt = $pdo->query($sql)){
        return array();
    } else {
        return $stmt->fetchAll(PDO::FETCH_UNIQUE);
    }
}
//
//Получение группы по id
function getGroup($pdo, $id){
    $sql = 'SELECT id, name FROM av_groups WHERE id='.$id;
    if(!$stmt = $pdo->query($sql)){
        return array();
    } else {
        return $stmt->fetch(PDO::FETCH_UNIQUE);
    }
}
//Редактирование группы
function updateGroup($pdo, $id, $name){
    $name = $pdo->quote($name);
    $sql = 'UPDATE av_groups SET name ='.$name.' WHERE id='.$id;
    print $sql;
    return $pdo->exec($sql);
}

//Обновление статуса пользователя
function updateUserStatus($pdo, $id, $status){
   $sql = 'UPDATE av_users SET status ='.$status.' WHERE id='.$id;
   return $pdo->exec($sql);
}

//Создание голосования
function createVoting($pdo, $name, $description, $dateStart, $dateEnd, $candidates, $groupsWeight){
    $name = $pdo->quote($name);
    $description = $pdo->quote($description);
    $dateStart = $pdo->quote($dateStart);
    $dateEnd = $pdo->quote($dateEnd);
    $bulletin = array();
    foreach ($candidates as $key => $value)
    {
        $candidate = array();
        $candidate['name']= $value;
        $candidate['vote'] = 0;
        $bulletin[]=$candidate;
    }
    $bulletin = json_encode($bulletin);
    $bulletin = $pdo->quote($bulletin);
    $sql = "INSERT INTO av_votes (name, description, date_start, date_end, bulletin) VALUES ($name, $description, $dateStart, $dateEnd, $bulletin)";
    $pdo->exec($sql);
    $vote_id = $pdo->lastInsertId();
    $config = array(
        "digest_alg" => "sha512",
        "private_key_bits" => 512,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    );
    foreach ($groupsWeight as $key => $value){
        if($value>0){
            $keyCrypto = openssl_pkey_new($config);
            openssl_pkey_export($keyCrypto, $private_key);
            $public_key = openssl_pkey_get_details($keyCrypto);
            $public_key = $public_key["key"];
            $public_key = $pdo->quote($public_key);
            $private_key = $pdo->quote($private_key);
            $sql = "INSERT INTO av_relations_vote_group (vote_id, group_id, public_key, private_key, max_vote) VALUES ($vote_id, $key, $public_key, $private_key, $value)";
            $pdo->exec($sql);
        }
    }
}
/* Route functions */
function route($item = 1) {
    $request = explode("/", $_SERVER["REQUEST_URI"]);
    return $request[$item];
}
?>