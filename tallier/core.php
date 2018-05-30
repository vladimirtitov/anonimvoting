<?php
/* Обработка запросов*/
function votingRegistration($data){
    $pdo = init();
    if(!dbCheckPublicKeyVoting($pdo, $data["public_key_vote"])){
        $result = json_encode(
            [
                "error"=>6,
                "description"=>"Invalid request"
            ]
        );
        return $result;
    }
    if(dbAddVoting($pdo, $data['name'],$data['bulletin'],$data['date_start'],$data['date_end'],$data['max_vote'],$data['public_key_vote']) == 0){
        $result = json_encode(
            [
                "error"=>2,
                "description"=>"Invalid request"
            ]
        );
        return $result;
    }
    $id = $pdo->lastInsertId();
    $result = json_encode(
        [
            "error"=>0,
            "id_voting"=>$id,
            "description"=>"Success"
        ]
    );
    return $result;
}

function authorizeKey($data){
    $pdo = init();
    if(!dbCheckVoterPublicKey($pdo, $data["voter_public_key"])){
        $result = json_encode(
            [
                "error"=>5,
                "description"=>"Invalid request"
            ]
        );
        return $result;
    }
    //print $data;
    $publicVoteKey = dbGetPublicVoteKey($pdo, $data["voting_id"])["public_key_vote"];
    if($publicVoteKey == ""){
        $result = json_encode(
            [
                "error"=>3,
                "description"=>"Invalid request"
            ]
        );
        return $result;
    }
    if(checkKeys($data["voter_public_key"],$data["encoded_voter_public_key"])){
        dbAddAuthorizedKey($pdo, $data["voter_public_key"],$data["voting_id"]);
        $result = json_encode(
            [
                "error"=>0,
                "description"=>"Success"
            ]
        );
        return $result;
    }
    else{
        $result = json_encode(
            [
                "error"=>4,
                "description"=>"Invalid request"
            ]
        );
        return $result;
    }
}
function checkKeys($publicKey, $encodePublicKey){
    return true;
}
// Соединение с БД
function init(){
    $config = parse_ini_file(ROOT.'/config.ini');
    $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['schema']}";
    return new PDO($dsn, $config['user'], $config['password']);
}
/* Запросы к БД*/
function dbGetPublicVoteKey($pdo, $id_voting){
    //print $id_voting;
    $sql = "SELECT public_key_vote FROM votings WHERE id = $id_voting";
    //print $sql;
    if(!$stmt = $pdo->query($sql)){
        return array();
    } else {
        return $stmt->fetch(PDO::FETCH_UNIQUE);
    }

}
function dbAddVoting($pdo, $name, $bulletin, $dataStart, $dataEnd, $maxVote, $publicVoteKey){
    $name = $pdo->quote($name);
    $bulletin = $pdo->quote($bulletin);
    $dataStart = $pdo->quote($dataStart);
    $dataEnd = $pdo->quote($dataEnd);
    $maxVote = $pdo->quote($maxVote);
    $publicVoteKey = $pdo->quote($publicVoteKey);
    $sql_insert = "INSERT INTO votings (name,bulletin,date_start,date_end, max_vote, public_key_vote) VALUES ($name,$bulletin,$dataStart,$dataEnd,$maxVote,$publicVoteKey)";
    //print $sql_insert;
    return $pdo->exec($sql_insert);
}

function dbAddAuthorizedKey($pdo, $key, $voting_id){
    $key = $pdo->quote($key);
    $sql_insert = "INSERT INTO av_voting_data (voter_pub, voting_id) VALUES ($key, $voting_id)";
    //print $sql_insert;
    return $pdo->exec($sql_insert);
}

function dbCheckPublicKeyVoting($pdo, $publicKeyVote){
    $sql = 'SELECT id FROM votings WHERE public_key_vote='.$pdo->quote($publicKeyVote);
    $stmt = $pdo->query($sql);
    $res = $stmt->fetch(PDO::FETCH_UNIQUE);
    if($res[0]==0)
        return true;
    else return false;
}

function dbCheckVoterPublicKey($pdo, $voterPublicKey){
    $sql = 'SELECT COUNT(*) FROM av_voting_data WHERE voter_pub='.$pdo->quote($voterPublicKey);
    $stmt = $pdo->query($sql);
    $res = $stmt->fetch(PDO::FETCH_UNIQUE);
    if($res[0]==0)
        return true;
    else return false;
}