<h1 class="cent">Голосование</h1>
<?php
$id = $request[4];
$votingInfo = getVotingInfo($pdo, $id);
if($votingInfo == array())
    echo 'Голосование не найдено';
else{
    $subVotes = getSubVotes($pdo, $id);
    echo 'ID: '.$votingInfo['id'].'<br/>';
    echo 'Название: '.$votingInfo['name'].'<br/>';
    echo 'Описание: '.$votingInfo['description'].'<br/>';
    echo 'Дата начала: '.$votingInfo['date_start'].'<br/>';
    echo 'Дата окончания: '.$votingInfo['date_end'].'<br/>';
    $dateStart = $votingInfo["date_start"];
    $dateEnd = $votingInfo["date_end"];
    if(strtotime($dateStart)>strtotime(date("Y-m-d H:i:s"))){
        echo 'Статус: Идет авторизация пользователей <a href="/anonimvoting/registrator/votingAuthorization/'.$id.'">Авторизоваться в голосовании</a><br/>';
    }elseif (strtotime($dateEnd)>strtotime(date("Y-m-d H:i:s"))){
        echo 'Статус: Идет голосование <a href="/anonimvoting/registrator/votingAuthorization/vote/'.$id.'"<br/>';
    }else{
        echo 'Статус: голосование завершено <a href="/anonimvoting/registrator/votingAuthorization/results/'.$id.'">Посмотреть результаты</a><br/>';
    }
    echo '<h3>Варианты голосования</h3>';
    $candidates = json_decode($votingInfo['bulletin'],true);
    foreach ($candidates as $key => $value){
        echo ($key+1).'. '.$value['name'].'<br/>';
    }
    echo '<h3>Подголосования</h3> ';
    echo '<table border="1" cellpadding="2" cellspacing="0">';
    echo '<tr><th>ID</th><th>Название группы</th><th>ID Группы</th><th>Максимальное количество голосов</th><th>ID Счетчика</th><th>Действия</th></tr>';
    foreach ($subVotes as $key => $value) {
        echo '<tr>';
        echo '<td>'.$key.'</td>';
        echo '<td>'.$value['name'].'</td>';
        echo '<td>'.$value['group_id'].'</td>';
        echo '<td>'.$value['max_vote'].'</td>';
        if($value['registrator_id'] ==""){
            echo '<td>Подголосование не зарегистрировано</td>';
            echo '<td><a href="/'.$key.'">Действие 1</a></td>';
        }
        else{
            echo'<td>'.$value['registrator_id'].'</td>';
            echo '<td></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    $res = getAuthorizedUsers($pdo, $id);
    echo '<h3>Допущенные участники</h3>';
    echo '<table border="1" cellpadding="2" cellspacing="0">';
    echo '<tr><th>ID</th><th>Имя</th><th>E-mail</th><th>Группа</th><th>Зарегистрирован в качестве участника</th></tr>';
    foreach ($res as $key => $value) {
        echo '<tr>';
        echo '<td>'.$key.'</td>';
        echo '<td>'.$value['name'].'</td>';
        echo '<td>'.$value['email'].'</td>';
        echo '<td>'.getGroup($pdo,$value['group_id'])['name'].'</td>';
        if(isRegisteredInVoting($pdo,$id,$key)['is_registered'] == 0)
            echo '<td>Нет</td>';
        else echo '<td>Да</td>';
    }
    echo '</table>';
}
?>