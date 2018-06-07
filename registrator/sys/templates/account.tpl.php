<?php
$userData = getUser($pdo, $this_id);
echo '<br/><h2 class="caption-section">Личный кабинет</h2>';
echo '<p>Вы вошли как: '.$userData['name'].'</p>';
echo '<p>Ваш e-mail: '.$userData['email'].'</p>';
echo '<p>Ваша группа: '.getGroup($pdo,$userData['group_id'])['name'].'</p>';
$res = getVotesForUser($pdo, $this_id);
echo '<br/><h3 class="caption-section">Голосования</h3>';
echo '<table  class="demo-table">';
echo '<tr><th>ID</th><th>Название</th><th>Описание</th><th>Дата начала</th><th>Дата окончания</th><th>Действия</th></tr>';
foreach ($res as $key => $value) {
    echo '<tr>';
    echo '<td>'.$key.'</td>';
    echo '<td>'.$value['name'].'</td>';
    echo '<td>'.$value['description'].'</td>';
    echo '<td>'.$value['date_start'].'</td>';
    echo '<td>'.$value['date_end'].'</td>';
    echo '<td><a href="/anonimvoting/registrator/voting/'.$key.'">Подробнее</a></td>';
    echo '</tr>';
}
echo '</table><br/>';
?>