<?php include 'Templates/header.php'; ?>

<h2>Список контактов</h2>

<?php if (isset($data['status'])) { ?>
    <p><?php echo $data['status'] ?></p>
<?php } ?>

<a href="index.php?url=people/add">Добавить контакт</a>
<?php if (isset($data['peoples'])) { ?>
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
        <?php foreach ($data['peoples'] as $people) { ?>
            <tr>
                <th><?php echo $people->id_people; ?></th>
                <td><?php echo $people->fio; ?></td>
                <td>
                    <?php foreach ($people->phones as $phone) { ?>
                        <?php echo $phone->phone ?>
                    <?php } ?>
                </td>
                <td>
                    <?php foreach ($people->groups as $group) { ?>
                        <?php echo $group->name_group ?>
                    <?php } ?>
                </td>
                <td><?php echo $people->address; ?></td>
                <td><?php echo $people->email; ?></td>
                <td><?php echo $people->positionjob instanceof PositionJobModel ? $people->positionjob->name_positionjob : ''; ?></td>
                <td>
                    <a href="index.php?url=people/update/<?php echo $people->id_people; ?>" >Обновить</a>
                    <a href="index.php?url=people/delete/<?php echo $people->id_people; ?>" >Удалить</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>Нет контактов</p>
<?php } ?>

<a href="index.php?url=group/index">Посмотреть список групп</a>
<a href="index.php?url=positionJob/index">Посмотреть список должностей</a>
<a href="index.php?url=callerphones/index">Посмотреть список исходящих</a>
<a href="index.php?url=people/search">Поиск по контактам</a>
<a href="index.php?url=phonering/index">Посмотреть журнал входящих</a>


<?php include 'Templates/footer.php'; ?>
