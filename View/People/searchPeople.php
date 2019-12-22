<? include "templates/header.php";?>

<h2>Поиск небходимого контакта</h2>

<form method="post">
    <label for="search">Поиск</label>
    <input type="text" name="search" id="search">
    <input type="submit" name="submit" value="submit">
</form>

<?php if (isset($data['peoples']) && count($data['peoples']) > 0) {?>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>FIO</th>
            <th>Phone</th>
            <th>Groups</th>
            <th>Address</th>
            <th>Email</th>
            <th>Position Job</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['peoples'] as $people) {?>
            <tr>
                <th><?php echo $people->id_people;?></th>
                <td><?php echo $people->fio;?></td>
                <td>
                    <?php foreach ($people->phones as $phone) {?>
                        <?php echo $phone->phone?>
                    <?php } ?>
                </td>
                <td>
                    <?php foreach ($people->groups as $group) { ?>
                        <?php echo $group->name_group?>
                    <?php } ?>
                </td>
                <td><?php echo $people->address;?></td>
                <td><?php echo $people->email;?></td>
                <td><?php echo $people->positionjob instanceof PositionJobModel ? $people->positionjob->name_positionjob : ''?></td>
                <td>
                    <a href="index.php?url=people/update/<?php echo $people->id_people;?>">Обновить</a>
                    <a href="index.php?url=people/delete/<?php echo $people->id_people;?>">Удалить</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else {?>
    <p>Контактов не найдено</p>
<?php } ?>

<a href="index.php?url=people/index">Вернуться к списку контактов</a>

<? include "templates/footer.php";?>
