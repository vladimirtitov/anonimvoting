<?php
show_list($pdo);
// Функция выводит список всех записей в таблице БД
function show_list($pdo){
    $res = getGroups($pdo);
    echo '<h2>Группы</h2>';
    echo '<table border="1" cellpadding="2" cellspacing="0">';
    echo '<tr><th>ID</th><th>Название</th><th>Редактировать</th></tr>';
    foreach ($res as $key => $value) {
        echo '<tr>';
        echo '<td>'.$key.'</td>';
        echo '<td>'.$value['name'].'</td>';
        echo '<td><a href="/anonimvoting/registrator/admin/editgroup/'.$key.'">Редактировать</a></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<p><a href="/anonimvoting/registrator/admin/addgroup">Добавить</a></p>';
}