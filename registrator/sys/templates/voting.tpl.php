<br/><h1 class="caption-section">Голосование</h1>
<?php
$id = $request[5];
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
    echo '<p><a href="/anonimvoting/registrator/admin/registerSubVotes/'.$id.'">Зарегистрировать подголосования</a></p>';
    echo '<br/><h3 class="caption-section">Варианты голосования</h3>';
    $candidates = json_decode($votingInfo['bulletin'],true);
    foreach ($candidates as $key => $value){
        echo '<p>'.($key+1).'. '.$value['name'].'</p>';
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
            echo '<td><a href="/'.$key.'">Действие 1</a></td>';
        }
        else{
            echo'<td>'.$value['registrator_id'].'</td>';
            echo '<td></td>';
        }
        echo '</tr>';
    }
    echo '</table><br/>';
}
?>