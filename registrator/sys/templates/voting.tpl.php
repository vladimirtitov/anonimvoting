<h1 class="cent">Голосование</h1>
<?php
$id = $request[5];
$votingInfo = getVotingInfo($pdo, $id);
if($votingInfo == array())
    echo 'Голосование не найденот';
else{
    $subVotes = getSubVotes($pdo, $id);
    echo 'ID: '.$votingInfo['id'].'<br/>';
    echo 'Название: '.$votingInfo['name'].'<br/>';
    echo 'Описание: '.$votingInfo['description'].'<br/>';
    echo 'Дата начала: '.$votingInfo['date_start'].'<br/>';
    echo 'Дата окончания: '.$votingInfo['date_end'].'<br/>';
    echo '<p><a href="/anonimvoting/registrator/admin/registerSubVotes/'.$id.'">Зарегистрировать подголосования</a></p>';
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
}
?>