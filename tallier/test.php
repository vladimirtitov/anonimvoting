<?php
$url = 'http://localhost/anonimvoting/tallier/votingRegistration';
$data = array('data' => '{"name":"Vova", "bulletin":"Vova", "max_vote":5, "public_key_vote":"sdfasf", "date_start":"2016-12-12 21:00:00", "date_end":"2016-12-12 21:00:00"}');


$url1 = 'http://localhost/anonimvoting/tallier/authorizeKey';
$data1 = array('data' => '{"voting_id":3, "voter_public_key":"wddsads21qwd", "encoded_voter_public_key":"3r2r3r23r23"}');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data1)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url1, false, $context);
if ($result === FALSE) { echo 'gbplf';}

var_dump($result);