<h1 class="cent">Добавление голосующего</h1>
<div class="row cent">
    <div class="col-md-offset-4 col-md-4">
        <form class="cent" action="" method="post">
            <p><input class="form-control" name="name" type="text" placeholder="Имя" /></p>
            <p><input class="form-control" name="description" type="text" placeholder="Описание" /></p>
            <p><select name="hero[]">
                    <option selected disabled>Выберите голосующего</option>
                    <option value="Чебурашка">Чебурашка</option>
                    <option value="Крокодил Гена">Крокодил Гена</option>
                    <option value="Шапокляк">Шапокляк</option>
                    <option value="Крыса Лариса">Крыса Лариса</option>
                </select></p>
            <br/>
            <p><input class="btn btn-primary" name="add_voter_submit" type="submit" value="Добавить" /></p><br />
        </form>
    </div>
</div>