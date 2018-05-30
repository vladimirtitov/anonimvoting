<?php
show_list($pdo);
// Функция выводит список всех записей в таблице БД
function show_list($pdo){
    $res = getRequests($pdo);
    echo '<h2>Заявки</h2>';
    echo '<table border="1" cellpadding="2" cellspacing="0">';
    echo '<tr><th>ID</th><th>Имя Фамилия</th><th>Email</th><th>Подтвердить</th><th>Отклонить</th></tr>';
    foreach ($res as $key => $value) {
        echo '<tr>';
        echo '<td>'.$key.'</td>';
        echo '<td>'.$value['name'].'</td>';
        echo '<td>'.$value['email'].'</td>';
        echo '<td><a href="/admin/requests/accept/'.$key.'">Подтвердить</a></td>';
        echo '<td><a href="/admin/requests/reject/'.$key.'">Отклонить</a></td>';
        echo '</tr>';
    }
    echo '</table>';
}