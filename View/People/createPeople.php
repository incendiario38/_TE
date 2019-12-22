<?php include 'Templates/header.php';?>
<script type="text/javascript" src="../../JavaScript/jquery-3.4.1.js"></script>
<script type="text/javascript" src="../../JavaScript/jquery.js"></script>

<h2>Добавить новый контакт</h2>

<form method="post">
    <label for="fio">ФИО</label>
    <input type="text" name="fio" id="fio">

    <label for="phone[]">Номера</label>
    <button class="addField">Добавить поле</button>
    <div class="phonesNumber">
    </div>

    <label for="groups">Группы</label>

    <?php foreach ($data['groups'] as $group) {?>
        <label style="display: inline-flex"><input type="checkbox" name="groups[]"  value="<?php echo $group->id_group;?>"><?php echo $group->name_group;?></label>
    <?php }?>

    <label for="address">Адрес</label>
    <input type="text" name="address" id="address">

    <label for="email">Email</label>
    <input type="email" name="email" id="email">

    <label for="positionjob">Должность</label>
    <select name="positionjobid" id="positionjob">
        <?php foreach ($data['positionjob'] as $positionjob) {?>
        <option value="<?php echo $positionjob->id_positionjob;?>">
            <?php echo $positionjob->name_positionjob;?>
        </option>
        <?php }?>
    </select>

    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php?url=people/index">Назад</a>

<?php include 'Templates/footer.php';?>
