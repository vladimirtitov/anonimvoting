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
    return new PDO($dsn, $config['user'], $config['password']);
}

//Авторизация
function login($pdo, $mail, $password){
    $mail = $pdo->quote($mail);
    $password = md5($password);
    //print $mail.' '.$password;
    $sql = "SELECT id, password FROM ts_users WHERE email='$mail'";
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
                $sql_update = "UPDATE ts_users SET hash='$hash' WHERE id='$db_id'";
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
        $sql = "SELECT hash FROM ts_users WHERE id='$cookie_id'";
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

/* Route functions */
function route($item = 1) {
    $request = explode("/", $_SERVER["REQUEST_URI"]);
    return $request[$item];
}
?>