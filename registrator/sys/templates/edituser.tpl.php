<br/><h1 class="caption-section">Редактирование пользователя</h1>
<?php
function isStatus($status, $currentStatus){
    if($status==$currentStatus) return 'selected';
        else return '';
}
$id = $request[5];
$userInfo = getUser($pdo, $id);
if($userInfo == array())
    echo 'Такого пользователя не существует';
else{
$groups = getGroups($pdo);
?>
    <div class="edituser-page">
        <div class="form">
        <form class="edituser-form" action="" method="post">
            <p>ID: <?=$userInfo['id']?></p>
            <p>Имя Фамилия: <?=$userInfo['name']?></p>
            <p>Email: <?=$userInfo['email']?></p><br/>
            <p>Группа:
            <select name="selectGroups" size="1">
                <?php
                echo '<option selected value="0">Не задавать</option>';
                    foreach ($groups as $key => $value){
                        if($key==$userInfo['group_id'])
                            echo '<option selected value="'.$key.'">'.$value['name'].'</option>';
                        else echo '<option value="'.$key.'">'.$value['name'].'</option>';
                    }
                ?>
                </select>
            </p><br/>
            <p> Статус учетной записи:
            <select name="selectStatus" size="1">
                <?php
                    $status = $userInfo['status'];
                    echo '<option '.isStatus($status,0).' value="0">Ожидает подтверждения</option>';
                    echo '<option '.isStatus($status,1).' value="1">Подтверждена</option>';
                    echo '<option '.isStatus($status,2).' value="2">Отклонена</option>';
                ?>
            </select>
            </p>
            <br/>
            <button name="add_group_submit" type="submit">Сохранить</button>
        </form>
        </div>
    </div>
<?php }?>