<?php
/* Обработка запросов*/
function votingRegistration($data){
    $pdo = init();
    if(!dbCheckPublicKeyVoting($pdo, $data["public_key_vote"])){
        $result = json_encode(
            [
                "error"=>6,
                "description"=>"Error 6: Voting with such public key already exists"
            ]
        );
        return $result;
    }
    if(dbAddVoting($pdo, $data['name'],$data['bulletin'],$data['date_start'],$data['date_end'],$data['max_vote'],$data['public_key_vote']) == 0){
        $result = json_encode(
            [
                "error"=>2,
                "description"=>"Error 2: MySQL error check the validity of the parameters"
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
                "description"=>"Error 5: MySQL error check the validity of the parameters"
            ]
        );
        return $result;
    }
    //print $data;
    $votingInfo = dbGetVotingInfo($pdo, $data["voting_id"]);
    $publicVoteKey = $votingInfo["public_key_vote"];
    if($publicVoteKey == ""){
        $result = json_encode(
            [
                "error"=>3,
                "description"=>"Error 3: Voting with this 'voting_id' is not registered"
            ]
        );
        return $result;
    }
    $dateStart = $votingInfo["date_start"];
    if(strtotime($dateStart)<strtotime(date("Y-m-d H:i:s"))){
        $result = json_encode(
            [
                "error"=>7,
                "description"=>"Error 7: Registration of keys is over in this voting"
            ]
        );
        return $result;
    }
    if(checkKey($data["voter_public_key"],$data["encoded_voter_public_key"])){
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
                "description"=>"Error 4: The voting key is incorrect"
            ]
        );
        return $result;
    }
}

function sendBulletin($data){
    $pdo = init();
    if(!dbVerifyAuthorizationKey($pdo,$data['voter_public_key'],$data['voting_id'])){
        $result = json_encode(
            [
                "error"=>8,
                "description"=>"Error 8: The key is not registered in the vote"
            ]
        );
        return $result;
    }
    $votingInfo = dbGetVotingInfo($pdo, $data["voting_id"]);
    $publicVoteKey = $votingInfo["public_key_vote"];
    if($publicVoteKey == ""){
        $result = json_encode(
            [
                "error"=>3,
                "description"=>"Error 3: Voting with this 'voting_id' is not registered"
            ]
        );
        return $result;
    }
    $dateStart = $votingInfo["date_start"];
    $dateEnd = $votingInfo["date_end"];
    if((strtotime($dateStart)>strtotime(date("Y-m-d H:i:s"))) or (strtotime($dateEnd)<strtotime(date("Y-m-d H:i:s")))){
        $result = json_encode(
            [
                "error"=>10,
                "description"=>"Error 10: Votes are not accepted for this voting."
            ]
        );
        return $result;
    }
    if(checkBulletin($data['voter_public_key'],$data['bulletin_encrypted'],$data['hash_bulletin_encrypted'])){
        dbAddBulletin($pdo,$data['voter_public_key'],$data['bulletin_encrypted'],$data['hash_bulletin_encrypted'],$data['voting_id']);
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
                "error"=>9,
                "description"=>"Error 9: The bulletin is incorrect"
            ]
        );
        return $result;
    }
}

function sendSecretKey($data){
    $pdo = init();
    if(!dbVerifyAuthorizationKey($pdo,$data['voter_public_key'],$data['voting_id'])){
        $result = json_encode(
            [
                "error"=>8,
                "description"=>"Error 8: The key is not registered in the vote"
            ]
        );
        return $result;
    }
    $votingInfo = dbGetVotingInfo($pdo, $data["voting_id"]);
    $publicVoteKey = $votingInfo["public_key_vote"];
    if($publicVoteKey == ""){
        $result = json_encode(
            [
                "error"=>3,
                "description"=>"Error 3: Voting with this 'voting_id' is not registered"
            ]
        );
        return $result;
    }
    $dateStart = $votingInfo["date_start"];
    $dateEnd = $votingInfo["date_end"];
    if((strtotime($dateStart)>strtotime(date("Y-m-d H:i:s"))) or (strtotime($dateEnd)<strtotime(date("Y-m-d H:i:s")))){
        $result = json_encode(
            [
                "error"=>10,
                "description"=>"Error 10: Votes are not accepted for this voting."
            ]
        );
        return $result;
    }
    if(checkSecretKey($data['voter_public_key'],$data['voter_secret_key'],$data['hash_secret_key_encrypted'])){
        dbAddSecretKey($pdo,$data['voter_public_key'],$data['voter_secret_key'],$data['hash_secret_key_encrypted'],$data['voting_id']);
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
                "error"=>11,
                "description"=>"Error 11: The secret key is incorrect"
            ]
        );
        return $result;
    }
}
function getVotingData($data)
{
    //print $data;
    $pdo = init();
    $resultFromDB = dbGetVotingData($pdo, $data['voting_id']);
    $result = json_encode(
        [
            "error" => 0,
            "description" => "Success",
            "voting_id" => $data['voting_id'],
            "data"=>$resultFromDB
        ]
    );
    return $result;
}
function checkKey($publicKey, $encodePublicKey){
    return true;
}
function checkBulletin($publicKey,$bulletinEncrypted,$hashBulletinEncrypted){
    return true;
}
function checkSecretKey($publicKey, $secretKey, $encodeSecretKey){
    return true;
}
// Соединение с БД
function init(){
    $config = parse_ini_file(ROOT.'/config.ini');
    $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['schema']}";
    return new PDO($dsn, $config['user'], $config['password']);
}
/* Запросы к БД*/
function dbGetVotingInfo($pdo, $id_voting){
    //print $id_voting;
    $sql = "SELECT * FROM votings WHERE id = $id_voting";
    //print $sql;
    if(!$stmt = $pdo->query($sql)){
        return array();
    } else {
        return $stmt->fetch(PDO::FETCH_UNIQUE);
    }
}
function dbGetVotingData($pdo, $id_voting){
    $sql = "SELECT * FROM av_voting_data WHERE voting_id = $id_voting";
    //print $sql;
    $data = array();
    foreach($pdo->query($sql) as $row){
        $item = array();
        $item["voter_public_key"] = $row['voter_pub'];
        $item["voter_secret_key"] = $row['voter_secr'];
        $item["bulletin"] = $row['bulletin'];
        $item["bulletin_encrypted"] = $row['bulletin_encrypted'];
        $item["hash_bulletin_encrypted"] = $row['hash_bulletin_encrypted'];
        $item["hash_secret_key_encrypted"] = $row['hash_voter_secr_encrypted'];
        $data[]=$item;
    }
    return $data;
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
function dbAddBulletin($pdo, $key, $bulletin_encrypted, $hash_bulletin_encrypted,$voting_id){
    $bulletin_encrypted = $pdo->quote($bulletin_encrypted);
    $hash_bulletin_encrypted = $pdo->quote($hash_bulletin_encrypted);
    $key = $pdo->quote($key);
    $sql_insert = "UPDATE av_voting_data SET bulletin_encrypted=$bulletin_encrypted, hash_bulletin_encrypted=$hash_bulletin_encrypted WHERE voting_id = $voting_id AND voter_pub = $key";
    //print $sql_insert;
    return $pdo->exec($sql_insert);
}
function dbAddSecretKey($pdo, $key, $secretKey, $secretKeyEncrypted, $voting_id){
    $secretKey = $pdo->quote($secretKey);
    $secretKeyEncrypted = $pdo->quote($secretKeyEncrypted);
    $key = $pdo->quote($key);
    $sql_insert = "UPDATE av_voting_data SET voter_secr=$secretKey, hash_voter_secr_encrypted=$secretKeyEncrypted WHERE voting_id = $voting_id AND voter_pub = $key";
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

function dbVerifyAuthorizationKey($pdo, $publicKey, $voting_id){
    $sql = 'SELECT COUNT(*) FROM av_voting_data WHERE voter_pub='.$pdo->quote($publicKey).' AND voting_id='.$voting_id;
    $stmt = $pdo->query($sql);
    $res = $stmt->fetch(PDO::FETCH_UNIQUE);
    if($res[0]==0)
        return false;
    else return true;
}