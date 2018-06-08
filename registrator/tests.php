<?php
define(ROOT, $_SERVER['DOCUMENT_ROOT'].'/anonimvoting/registrator');
require(ROOT.'/sys/core.php');
$pdo = init();
//Создание ключа
//$config = array(
//    "digest_alg" => "sha512",
//    "private_key_bits" => 1024,
//    "private_key_type" => OPENSSL_KEYTYPE_RSA,
//);
//$key = openssl_pkey_new($config);
////print_r($key);
////echo '</br>';
////Получение приватного ключа
//openssl_pkey_export($key, $privateKey);
//print_r($privateKey);
////echo '</br>';
////Получение публичного ключа
//$publicKey = openssl_pkey_get_details($key);
//$publicKeyPEM = $publicKey["key"];
////print_r($publicKeyPEM);
//$modulus = $publicKey['rsa']['n'];
//$exponent = $publicKey['rsa']['e'];
//$prvExponent = $publicKey['rsa']['d'];
//$modulus1= bin2hex($modulus);
//print_r($modulus1);
//echo '<br/>';
//$a = gmp_init("0x".$modulus1);
////printf("Десятичное: %s, 2-ричное: %s", gmp_strval($a), gmp_strval($a,2));
//echo '<br/>';
//$string = "Hello, Vladimir";
//$guds = bin2hex($string);
//print_r($guds);
//echo '<br/>';
//$a = gmp_init("0x".$guds);
//printf("2-ричное: %s",gmp_strval($a, 2));
//$key = <<<SOMEDATA777
//-----BEGIN PUBLIC KEY-----
//MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBALqbHeRLCyOdykC5SDLqI49ArYGYG1mq
//aH9/GnWjGavZM02fos4lc2w6tCchcUBNtJvGqKwhC5JEnx3RYoSX2ucCAwEAAQ==
//-----END PUBLIC KEY-----
//SOMEDATA777;
//$data = "JutBa0GLHzGrlygxwWr66cizw4W4za+DbzZweNM0iloCD7xEP9LclL013lcksJL5XhjW44U+oxpq cX1ZSLhWuA==";
//$pk  = openssl_get_publickey($key);
//$publicKey = openssl_pkey_get_details($pk);
//print_r($publicKey);
//openssl_private_decrypt(base64_decode($data), $out, $pk);
//echo $out;
//$i = gmp_invert("48","391");
//echo gmp_strval($i);
// Create the private and public key
//$res1 = openssl_pkey_new($config);
//$res2 = openssl_pkey_new($config);
//
//// Extract the private key from $res to $privKey
//openssl_pkey_export($res1, $privKey1);
//openssl_pkey_export($res2, $privKey2);
//
//// Extract the public key from $res to $pubKey
//$pubKey1 = openssl_pkey_get_details($res1);
//$pubKey1 = $pubKey1["key"];
//
//$pubKey2 = openssl_pkey_get_details($res1);
//$pubKey2 = $pubKey2["key"];
//echo $pubKey2;
//$key = $pubKey2['key'];
//$modulus = $data['rsa']['n'];
//$exponent = $data['rsa']['e'];
//
//$data = 'My DICK is BIG';

//$key = openssl_pkey_new($config);
//$data = openssl_pkey_get_private($key);
//print_r($data);
//echo "<br/";
//$data = openssl_pkey_get_details($data);
//print_r($data);
//echo "<br/";
//$key = $data['key'];
//$modulus = $data['rsa']['n'];
//$exponent = $data['rsa']['e'];
//$d = $data['rsa']['d'];
//echo var_dump($data);
////echo "<br/";
////print_r($modulus);
//echo base64_encode($exponent);
////echo "<br/";
////echo base64_encode($d);
//




//echo $pubKey;
//echo "<br/>";
//echo $privKey;
//echo "<br/>";
//// Encrypt the data to $encrypted using the public key
//openssl_public_encrypt($data, $encrypted, $pubKey);
//echo "<br/>";
////echo chunk_split(base64_encode($encrypted));
//echo "<br/>";
//echo "<br/>";
//echo "<br/>";
//// Decrypt the data using the private key and store the results in $decrypted
//openssl_private_decrypt($encrypted, $decrypted, $privKey);
//
//echo $decrypted;

//$hash = hash("sha256","-----BEGIN PUBLIC KEY-----MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBALqbHeRLCyOdykC5SDLqI49ArYGYG1mqaH9/GnWjGavZM02fos4lc2w6tCchcUBNtJvGqKwhC5JEnx3RYoSX2ucCAwEAAQ==-----END PUBLIC KEY-----");
//print_r($hash);
function blind($hash, $vote_prv_key){
    $r =gmp_init(48);
    $private_key  = openssl_get_privatekey($vote_prv_key);
    $data = openssl_pkey_get_details($private_key);
    $modulus = bin2hex($data['rsa']['n']);
    $exponent = bin2hex($data['rsa']['e']);
    $prvExponent = bin2hex($data['rsa']['d']);
    $n = gmp_init("0x".$modulus);
    $e = gmp_init("0x".$exponent);
    $d = gmp_init("0x".$prvExponent);
    $message = gmp_init("0x".$hash);
    $chipher = gmp_mod(gmp_mul($message, gmp_pow($r,65537)),$n);
    echo gmp_strval($chipher). "\n";
    return $chipher;
}
function removeBlind($message, $vote_prv_key){
    $private_key  = openssl_get_privatekey($vote_prv_key);
    $data = openssl_pkey_get_details($private_key);
    $modulus = bin2hex($data['rsa']['n']);
    $exponent = bin2hex($data['rsa']['e']);
    $prvExponent = bin2hex($data['rsa']['d']);
    $n = gmp_init("0x".$modulus);
    $e = gmp_init("0x".$exponent);
    $d = gmp_init("0x".$prvExponent);
    $message =  gmp_init($message);
    $rReverse = gmp_init("1079690642228013659498267108265975293226134053907950683378019457892696625654704327838192217382586683319502994109270146841462846451110481192101556451959567");
    $chipher = gmp_mod(gmp_mul($message,$rReverse),$n);
    echo gmp_strval($chipher) . "\n";
    return $chipher;
}
function sign($message, $vote_prv_key){
    $private_key  = openssl_get_privatekey($vote_prv_key);
    $data = openssl_pkey_get_details($private_key);
    //print_r($data);
    $modulus = bin2hex($data['rsa']['n']);
    $exponent = bin2hex($data['rsa']['e']);
    $prvExponent = bin2hex($data['rsa']['d']);
    $n = gmp_init("0x".$modulus);
    $e = gmp_init("0x".$exponent);
    $d = gmp_init("0x".$prvExponent);
//    printf("Десятичное: %s, 2-ричное: %s", gmp_strval($n), gmp_strval($n,2));
//    echo '</br>';
//    printf("Десятичное: %s, 2-ричное: %s", gmp_strval($e), gmp_strval($e,2));
//    echo '</br>';
//    printf("Десятичное: %s, 2-ричное: %s", gmp_strval($d), gmp_strval($d,2));
//    echo '</br>';
    //$cipher = gmp_init("6409656091225475167864492219374900732227226692730986068514381381271688758828105537148928242557302911720014738282794704831443494066912673623199954327372755");
    $cipher = gmp_init($message);
    $message = gmp_powm($cipher,$d,$n);
    echo gmp_strval($message)."\n";
    return $message;
}
$prv_key = getSubVoting($pdo, 19)['private_key'];
$hash = hash("sha256","Вова");
echo $hash.'<br>';
$blindMes = blind($hash,$prv_key);
$signBlindMes = sign(gmp_strval($blindMes),$prv_key);
$signMes = removeBlind(gmp_strval($signBlindMes),$prv_key);
$signMesCheck = sign("0x".$hash, $prv_key);
//print $prv_key;
//sign("c4eb29d15f0a2fdda499e72c6b25cb67a87215b78b6611abd9490763742a9b98",$prv_key);