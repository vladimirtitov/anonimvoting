<br/><h1 class="caption-section">Редактирование группы</h1>
<?php
$id = $request[5];
$groupInfo = (getGroup($pdo, $id));
if($groupInfo == array())
echo 'Такой группы не существует';
else{
$name = $groupInfo['name'];
?>
<div class="editgroup-page">
    <div class="form">
        <form class="cent" action="" method="post">
            <p>Название</p>
            <p><input class="form-control" name="name" type="text" placeholder="Название" value="<?=$name?>"/></p>
            <br/>
            <button name="add_group_submit" type="submit">Сохранение</button></button>
        </form>
    </div>
</div>
<?php }?>