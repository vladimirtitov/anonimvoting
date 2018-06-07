<?php
show_list($pdo);
// Функция выводит список всех записей в таблице БД
function show_list($pdo){
    $res = getGroups($pdo);
    echo '<br/><h2 class="caption-section">Группы</h2>';
    echo '<p><a href="/anonimvoting/registrator/admin/addgroup">Добавить</a></p>';
    if(count($res)==0)
    {
        echo '<br><br><br><br><p>Групп пока нет</p><br><br><br><br>';
    }
    echo '<table class="demo-table">';
    echo '<tr><th>ID</th><th>Название</th><th>Редактировать</th></tr>';
    foreach ($res as $key => $value) {
        echo '<tr>';
        echo '<td>'.$key.'</td>';
        echo '<td>'.$value['name'].'</td>';
        echo '<td><a href="/anonimvoting/registrator/admin/editgroup/'.$key.'">Редактировать</a></td>';
        echo '</tr>';
    }
    echo '</table><br/>';
}