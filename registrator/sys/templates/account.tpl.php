<?php
$userData = getUser($pdo, $this_id);
echo '<h2>Личный кабинет</h2>';
echo 'Вы вошли как: '.$userData['name'].'<br/>';
echo 'Ваш e-mail: '.$userData['email'].'<br/>';
echo 'Ваша группа: '.getGroup($pdo,$userData['group_id'])['name'].'<br/>';
echo '<a href="/anonimvoting/registrator/logout">Выйти</a>';
$res = getVotesForUser($pdo, $this_id);
echo '<h3>Голосования</h3>';
echo '<table border="1" cellpadding="2" cellspacing="0">';
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
echo '</table>';
?>