<h1 class="cent">Редактирование группы</h1>
<?php
$id = $request[5];
$groupInfo = (getGroup($pdo, $id));
if($groupInfo == array())
echo 'Такой группы не существует';
else{
$name = $groupInfo['name'];
?>
<div class="row cent">
    <div class="col-md-offset-4 col-md-4">
        <form class="cent" action="" method="post">
            <p><input class="form-control" name="name" type="text" placeholder="Название" value="<?=$name?>"/></p>
            <p><input class="btn btn-primary" name="add_group_submit" type="submit" value="Сохранение"/></p><br />
        </form>
    </div>
</div>
<?php }?>