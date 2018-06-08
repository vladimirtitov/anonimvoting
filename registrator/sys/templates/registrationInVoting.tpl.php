<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="/anonimvoting/jsencrypt.min.js"></script>
<script src="/anonimvoting/sha256.min.js"></script>
<script src="/anonimvoting/BigInteger.min.js"></script>
<script>
    <?php
       $id = $request[4];
       $votingInfo = getSubVoting($pdo, $id);
        $private_key  = openssl_get_privatekey($votingInfo['private_key']);
        $data = openssl_pkey_get_details($private_key);
        $modulus = bin2hex($data['rsa']['n']);
        $exponent = bin2hex($data['rsa']['e']);
        $prvExponent = bin2hex($data['rsa']['d']);
        $n = gmp_strval(gmp_init("0x".$modulus));
        $e = gmp_strval(gmp_init("0x".$exponent));
        $d = gmp_strval(gmp_init("0x".$prvExponent));

       echo "var modulus =\"$n\";";
       echo "var exponenta =\"$e\";";
    ?>
    function blind(hash, vote_pub_key){
        var r = bigInt(48);
        var n = bigInt(modulus);
        var e = bigInt(exponenta);
        var message = bigInt(hash,16);
        var cipher = (message.multiply(r.pow(e))).mod(n);
        return cipher.toString();
    }
    function clickReg() {
        var pubVoterKey = $('#pubkey').val();
        var hash = sha256.create();
        hash.update(pubVoterKey);
        alert(hash.hex());
        alert(blind(hash.hex()));
    }
</script>
<br/><h1 class="caption-section">Регистрация в голосовании</h1>
<p>Название: <?=$votingInfo['name']?></p>
<p>ID голосования: <?=$votingInfo['vote_id']?></p>
<p>ID подголосования: <?=$votingInfo[0]?></p>
<br>
<h4 class="caption-section">Ваш публичный ключ</h4>
<div style="text-align: center"><textarea style="width: 500px; height: 100px; resize: none" id="pubkey" >-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBALqbHeRLCyOdykC5SDLqI49ArYGYG1mq
aH9/GnWjGavZM02fos4lc2w6tCchcUBNtJvGqKwhC5JEnx3RYoSX2ucCAwEAAQ==
        -----END PUBLIC KEY-----</textarea></div>
<p><button class="buttonTop" id="regKey" onclick="clickReg()">Зарегистрировать ключ</button></p>
<br/>