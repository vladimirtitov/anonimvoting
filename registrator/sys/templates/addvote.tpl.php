<br/><h1 class="caption-section">Создание голосования</h1>
<script type="text/javascript">
    var countCandidates = 2
    function addCandidateInput(){
        var form = document.getElementById('createVoteForm');
        countCandidates++
        var pName = document.createElement('p')
        pName.appendChild(document.createTextNode('Кандидат/Вариант: '))
        var removeA = document.createElement('a')
        removeA.setAttribute('href','javascript://')
        removeA.setAttribute('onclick','removeInput(\'candidate'+countCandidates+'\'); return false;')
        removeA.appendChild(document.createTextNode('Удалить'))
        pName.appendChild(removeA)
        var input = document.createElement('input')
        input.setAttribute('name','candidates[]')
        input.setAttribute('type','text')
        pName.appendChild(input)
        pName.setAttribute('id','candidate'+countCandidates)
        form.insertBefore(pName,document.getElementById('addCandidate'))

    }
    function removeInput(id){
        countCandidates--
        var input = document.getElementById(id)
        input.remove()
    }
</script>

<div class="createvote-page-page">
    <div class="form-votes">
        <form action="" method="post" id="createVoteForm">
            <p>Название<input class="form-control" name="name" type="text" placeholder="Название"/></p>
            <p>Дата и время начала<input type="datetime-local" name="startDate"></p>
            <p>Дата и время окончания<input type="datetime-local" name="endDate"></p>
            <p>Описание<p><textarea style="width: 600px; height: 100px; max-height: 600px;  resize: none;" name="description" placeholder="Описание"></textarea></p></p>
            <br/>
            <h3 class="caption-section">Кандидаты/Варианты</h3>
            <br/>
            <p id="candidate1">Кандидат/Вариант <a href="javascript://" onclick="removeInput('candidate1'); return false;">Удалить</a><input name="candidates[]" type="text"></p>
            <p id="candidate2">Кандидат/Вариант <a href="javascript://" onclick="removeInput('candidate2'); return false;">Удалить</a><input name="candidates[]" type="text"></p>
            <a id="addCandidate" href="javascript://" onclick="addCandidateInput(); return false;">Добавить строку</a>
            <br/><br/>
            <h3 class="caption-section">Веса голосов</h3>
            <?php
                $groups = getGroups($pdo);
                foreach ($groups as $key => $value) {
                    echo '<p>';
                    echo ''.$value['name'].': ';
                    echo '<input class="form-control" name="groupsWeight['.$key.']" type="number" min="0" max="1000" value="0"  placeholder="Вес голоса"/>';
                    echo '</p>';
                }
            ?>
            <p id = 'submit'><button name="add_group_submit" type="submit">Создать</button></p><br />
        </form>
    </div>
</div>