<?php include 'Templates/header.php'; ?>

<h2>Обновление контакта</h2>

<?php if (isset($data['status'])) {
    echo '<b>' . $data['status'] . '</b>';
}
?>


<form method="post">
    <label for="fio">ФИО</label>
    <input type="text" name="fio" id="fio" value="<?php echo $data['people']->fio; ?>">

    <label>Номера</label>
    <button class="addField">Добавить поле</button>
    <div class="phonesNumber">
        <?php foreach ($data['people']->phones as $phone) {?>
            <div>
                <input type="tel" name="phones[]" value="<?php echo $phone->phone;?>">
                <a href="#" class="remove_field">Удалить</a>
            </div>
        <?php }?>
    </div>

    <label>Группы</label>
    <?php foreach ($data['groups'] as $group) {?>
        <label style="display: inline-flex">
            <input type="checkbox" name="groups[]" value="<?php echo $group->id_group;?>" <?php echo in_array($group, $data['people']->groups) ? 'checked' : ''; ?>>
            <?php echo $group->name_group?></label>
    <?php } ?>

    <label for="address">Адрес</label>
    <input type="text" name="address" id="address" value="<?php echo $data['people']->address;?>">

    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="<?php echo $data['people']->email;?>">

    <label for="positionjob">Должность</label>
    <select name="positionjob" id="positionjob">
        <?php foreach ($data['positionjob'] as $positionjob) {?>
            <option <?php echo $positionjob->id_positionjob == $data['people']->positionjobid ? 'selected' : ''; ?> value="<?php echo $positionjob->id_positionjob;?>">
                <?php echo $positionjob->name_positionjob;?>
            </option>
        <?php } ?>
    </select>

    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php?url=people/index">Назад</a>

<script type="text/javascript" src="../../JavaScript/jquery-3.4.1.js"></script>
<script type="text/javascript" src="../../JavaScript/jquery.js"></script>
<?php include 'Templates/footer.php'; ?>
