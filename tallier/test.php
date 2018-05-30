<?php
$url = 'http://localhost:8888/votingRegistration';
$data = array('data' => '{"name":"Vova", "bulletin":"Vova", "max_vote":5, "public_key_vote":"Vova3123123232", "date_start":"2016-12-12 21:00:00", "date_end":"2016-12-12 21:00:00"}');


$url1 = 'http://localhost:8888/authorizeKey';
$data1 = array('data' => '{"voting_id":3, "voter_public_key":"ewgwegw32323sdasdasdaefwefws", "encoded_voter_public_key":"3r2r3r23r23"}');

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