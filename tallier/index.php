<?php
define(ROOT, $_SERVER['DOCUMENT_ROOT'].'/anonimvoting/tallier');
require(ROOT.'/core.php');
$request = explode("/", $_SERVER["REQUEST_URI"]);
$command = $request[3];
//print $_SERVER['DOCUMENT_ROOT'];
//print_r($_POST["data"]);
$data = json_decode($_POST["data"],true);
//print_r($data);
switch($command){
    case "votingRegistration":
        $result = votingRegistration($data);
        break;
    case "authorizeKey":
        $result = authorizeKey($data);
        break;
    case "sendBulletin":
        break;
    case "sendSecretKey":
        break;
    case "getVotingResult":
        break;
    default:
        $result = json_encode(
            [
                "error"=>1,
                "description"=>"Invalid request"
            ]
        );
        break;
}
echo $result;