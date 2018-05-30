<?php
//Создание ключа
$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 512,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);
$key = openssl_pkey_new($config);
//print_r($key);
//echo '</br>';
//Получение приватного ключа
openssl_pkey_export($key, $privateKey);
//print_r($privateKey);
//echo '</br>';
//Получение публичного ключа
$publicKey = openssl_pkey_get_details($key);
$publicKeyPEM = $publicKey["key"];
//print_r($publicKeyPEM);
$modulus = $publicKey['rsa']['n'];
$exponent = $publicKey['rsa']['e'];
$prvExponent = $publicKey['rsa']['d'];
$modulus1= bin2hex($modulus);
print_r($modulus1);
echo '<br/>';
$a = gmp_init("0x".$modulus1);
printf("Десятичное: %s, 2-ричное: %s", gmp_strval($a), gmp_strval($a,2));
echo '<br/>';
$string = "Hello, Vladimir";
$guds = bin2hex($string);
print_r($guds);
echo '<br/>';
$a = gmp_init("0x".$guds);
printf("2-ричное: %s",gmp_strval($a, 2));
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
//// Create the private and public key
////$res1 = openssl_pkey_new($config);
////$res2 = openssl_pkey_new($config);
////
////// Extract the private key from $res to $privKey
////openssl_pkey_export($res1, $privKey1);
////openssl_pkey_export($res2, $privKey2);
////
////// Extract the public key from $res to $pubKey
////$pubKey1 = openssl_pkey_get_details($res1);
////$pubKey1 = $pubKey1["key"];
////
////$pubKey2 = openssl_pkey_get_details($res1);
////$pubKey2 = $pubKey2["key"];
////echo $pubKey2;
////$key = $pubKey2['key'];
////$modulus = $data['rsa']['n'];
////$exponent = $data['rsa']['e'];
////
////$data = 'My DICK is BIG';
//
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
//
//
//
//
////echo $pubKey;
////echo "<br/>";
////echo $privKey;
////echo "<br/>";
////// Encrypt the data to $encrypted using the public key
////openssl_public_encrypt($data, $encrypted, $pubKey);
////echo "<br/>";
//////echo chunk_split(base64_encode($encrypted));
////echo "<br/>";
////echo "<br/>";
////echo "<br/>";
//// Decrypt the data using the private key and store the results in $decrypted
//openssl_private_decrypt($encrypted, $decrypted, $privKey);
//
//echo $decrypted;