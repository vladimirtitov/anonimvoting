<h1 class="cent">Редактирование пользователя</h1>
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
<div class="row cent">
    <div class="col-md-offset-4 col-md-4">
        <form class="cent" action="" method="post">
            <p>ID: <?=$userInfo['id']?></p>
            <p>Имя Фамилия: <?=$userInfo['name']?></p>
            <p>Email: <?=$userInfo['email']?></p>
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
            </p>
            <p> Статус учетной записи
            <select name="selectStatus" size="1">
                <?php
                    $status = $userInfo['status'];
                    echo '<option '.isStatus($status,0).' value="0">Ожидает подтверждения</option>';
                    echo '<option '.isStatus($status,1).' value="1">Подтверждена</option>';
                    echo '<option '.isStatus($status,2).' value="2">Отклонена</option>';
                ?>
            </select>
            </p>
            <p><input class="btn btn-primary" name="add_group_submit" type="submit" value="Сохранить"/></p><br />
        </form>
    </div>
</div>
<?php }?>