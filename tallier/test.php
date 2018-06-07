<?php
$url = 'http://localhost/anonimvoting/tallier/votingRegistration';
$data = array('data' => '{"name":"Vova", "bulletin":5, "max_vote":"5", "public_key_vote":"sdsafadfsdsf", "date_start":"2016-12-12 21:00:00", "date_end":"2016-12-12 21:00:00"}');


$url1 = 'http://localhost/anonimvoting/tallier/authorizeKey';
$data1 = array('data' => '{"voting_id":3, "voter_public_key":"ABCD3423423EFGHEFGHI", "encoded_voter_public_key":"3r2r3r23r23"}');


$url2 = 'http://localhost/anonimvoting/tallier/sendBulletin';
$data2 = array('data' => '{"voting_id":3, "voter_public_key":"ewgwegw32323sdasdasdas", "bulletin_encrypted":"BULLETIN1423", "hash_bulletin_encrypted":"HASHBULLETIN342"}');

$url3 = 'http://localhost/anonimvoting/tallier/sendSecretKey';
$data3 = array('data' => '{"voting_id":3, "voter_public_key":"ewgwegw32323sdasdasdas", "voter_secret_key":"BULLETIN1423", "hash_secret_key_encrypted":"HASHBULLETIN342"}');

$url4 = 'http://localhost/anonimvoting/tallier/getVotingData';
$data4 = array('data' => '{"voting_id":3}');
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { echo 'gbplf';}

var_dump($result);