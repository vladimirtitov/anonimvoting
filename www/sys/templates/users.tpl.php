<?php
show_list($pdo);
// Функция выводит список всех записей в таблице БД
function show_list($pdo){
    $res = getUsers($pdo);
    echo '<h2>Пользователи</h2>';
    echo '<table border="1" cellpadding="2" cellspacing="0">';
    echo '<tr><th>ID</th><th>Имя Фамилия</th><th>E-mail</th><th>Статус учетной записи</th><th>Группа</th><th>Действия</th></tr>';
    foreach ($res as $key => $value) {
        echo '<tr>';
        echo '<td>'.$key.'</td>';
        echo '<td>'.$value['username'].'</td>';
        echo '<td>'.$value['email'].'</td>';
        switch ($value['status']){
            case 0:
                echo '<td>Ожидает подтверждения</td>';
                break;
            case 1:
                echo '<td>Подтверждена</td>';
                break;
            case 2:
                echo '<td>Отклонена</td>';
                break;
        }
        if($value['groupname']=="")
            echo '<td>Не задана</td>';
        else  echo '<td>'.$value['groupname'].'</td>';
        echo '<td><a href="/admin/edituser/'.$key.'">Редактировать</a></td>';
        echo '</tr>';
    }
    echo '</table>';
}