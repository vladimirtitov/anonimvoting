<h1 class="cent">Голосования</h1>
<p><a href="../admin/addvote">Создать новое голосование</a></p>
<?php
show_list($pdo);
// Функция выводит список всех записей в таблице БД
function show_list($pdo){
    $res = getVotes($pdo);
    echo '<table border="1" cellpadding="2" cellspacing="0">';
    echo '<tr><th>ID</th><th>Название</th><th>Описание</th><th>Дата начала</th><th>Дата окончания</th><th>Действия</th></tr>';
    foreach ($res as $key => $value) {
        echo '<tr>';
        echo '<td>'.$key.'</td>';
        echo '<td>'.$value['name'].'</td>';
        echo '<td>'.$value['description'].'</td>';
        echo '<td>'.$value['date_start'].'</td>';
        echo '<td>'.$value['date_end'].'</td>';
        echo '<td><a href="/anonimvoting/registrator/admin/voting/'.$key.'">Подробнее</a></td>';
        echo '</tr>';
    }
    echo '</table>';
}?>