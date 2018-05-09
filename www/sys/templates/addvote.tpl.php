<h1 class="cent">Создание голосования</h1>
<script type="text/javascript">
    var countCandidates = 2
    function addCandidateInput(){
        var form = document.getElementById('createVoteForm');
        countCandidates++
        var pName = document.createElement('p')
        pName.appendChild(document.createTextNode('Кандидат/Вариант: '))
        var input = document.createElement('input')
        input.setAttribute('name','candidates[]')
        input.setAttribute('type','text')
        pName.appendChild(input)
        var removeA = document.createElement('a')
        removeA.setAttribute('href','javascript://')
        removeA.setAttribute('onclick','removeInput(\'candidate'+countCandidates+'\'); return false;')
        removeA.appendChild(document.createTextNode('Удалить'))
        pName.appendChild(removeA)
        pName.setAttribute('id','candidate'+countCandidates)
        form.insertBefore(pName,document.getElementById('addCandidate'))

    }
    function removeInput(id){
        countCandidates--
        var input = document.getElementById(id)
        input.remove()
    }
</script>

<div class="row cent">
    <div class="col-md-offset-4 col-md-4">
        <form class="cent" action="" method="post" id="createVoteForm">
            <p><input class="form-control" name="name" type="text" placeholder="Название"/></p>
            <p><input type="datetime-local" name="startDate"></p>
            <p><input type="datetime-local" name="endDate"></p>
            <p><p><textarea name="description" placeholder="Описание"></textarea></p></p>
            <h2>Кандидаты/Варианты</h2>
            <p id="candidate1">Кандидат/Вариант: <input name="candidates[]" type="text"><a href="javascript://" onclick="removeInput('candidate1'); return false;">Удалить</a></p>
            <p id="candidate2">Кандидат/Вариант: <input name="candidates[]" type="text"><a href="javascript://" onclick="removeInput('candidate2'); return false;">Удалить</a></p>
            <a id="addCandidate" href="javascript://" onclick="addCandidateInput(); return false;">Добавить строку</a>
            <h2>Веса голосов</h2>
            <?php
                $groups = getGroups($pdo);
                foreach ($groups as $key => $value) {
                    echo '<p>';
                    echo ''.$value['name'].': ';
                    echo '<input class="form-control" name="groupsWeight['.$key.']" type="number" min="0" max="1000" value="0"  placeholder="Вес голоса"/>';
                    echo '</p>';
                }
            ?>
            <p id = 'submit'><input class="btn btn-primary" name="add_group_submit" type="submit" value="Создать"/></p><br />
        </form>
    </div>
</div>