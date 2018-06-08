<br/><h1 class="caption-section">Голосование</h1>
<?php
$id = $request[4];
$votingInfo = getVotingInfo($pdo, $id);
if($votingInfo == array())
    echo '<p>Голосование не найдено</p>';
else{
    $subVotes = getSubVotes($pdo, $id);
    echo '<p>ID: '.$votingInfo['id'].'</p>';
    echo '<p>Название: '.$votingInfo['name'].'</p>';
    echo '<p>Описание: '.$votingInfo['description'].'</p>';
    echo '<p>Дата начала: '.$votingInfo['date_start'].'</p>';
    echo '<p>Дата окончания: '.$votingInfo['date_end'].'</p>';
    $dateStart = $votingInfo["date_start"];
    $dateEnd = $votingInfo["date_end"];
    if(strtotime($dateStart)>strtotime(date("Y-m-d H:i:s"))){
        echo '<p>Статус: Идет авторизация пользователей <a href="/anonimvoting/registrator/registrationInVoting/'.$id.'">Авторизоваться в голосовании</a></p>';
        echo '<br/><h3 class="caption-section">Варианты голосования</h3>';
        $candidates = json_decode($votingInfo['bulletin'],true);
        foreach ($candidates as $key => $value){
            echo '<p>'.($key+1).'. '.$value['name'].'</p>';
        }
    }elseif (strtotime($dateEnd)>strtotime(date("Y-m-d H:i:s"))){
        echo '<p>Статус: Идет голосование <a href="/anonimvoting/registrator/votingAuthorization/vote/'.$id.'"</p>';
        echo '<br/><h3 class="caption-section">Варианты голосования</h3>';
        $candidates = json_decode($votingInfo['bulletin'],true);
        foreach ($candidates as $key => $value){
            echo '<p>'.($key+1).'. '.$value['name'].'</p>';
        }
    }else{
        echo '<p>Статус: Голосование завершено</p>';
        echo '<br/><h3 class="caption-section">Результаты голосования</h3>';
        $candidates = json_decode($votingInfo['bulletin'],true);
        foreach ($candidates as $key => $value){
            echo '<p>'.($key+1).'. '.$value['name'].'</p>';
        }
    }

    echo '<br/><h3 class="caption-section">Подголосования</h3> ';
    echo '<table table class="demo-table">';
    echo '<tr><th>ID</th><th>Название группы</th><th>ID Группы</th><th>Максимальное количество голосов</th><th>ID Счетчика</th><th>Действия</th></tr>';
    foreach ($subVotes as $key => $value) {
        echo '<tr>';
        echo '<td>'.$key.'</td>';
        echo '<td>'.$value['name'].'</td>';
        echo '<td>'.$value['group_id'].'</td>';
        echo '<td>'.$value['max_vote'].'</td>';
        if($value['registrator_id'] ==""){
            echo '<td>Подголосование не зарегистрировано</td>';
        }
        else{
            echo'<td>'.$value['registrator_id'].'</td>';
            echo '<td><a href="/'.$key.'">Смотреть данные</a></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    $res = getAuthorizedUsers($pdo, $id);
    echo '<br/><h3 class="caption-section">Допущенные участники</h3>';
    echo '<table table class="demo-table">';
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
    echo '</table> <br/>';
}
?>