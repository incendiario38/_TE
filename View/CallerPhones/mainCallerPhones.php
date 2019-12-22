<?php include 'Templates/header.php';?>

<h2>Журнал</h2>

<?php if (isset($data['status'])) { ?>
    <p><?php echo $data['status'] ?></p>
<?php } ?>

<a href="index.php?url=phonering/add">Добавить входящий</a>
<?php if (isset($data['phonering'])) {?>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Кто звонит</th>
            <th>Date/Time</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['phonering'] as $phonering){?>
        <tr>
            <th><?php echo $phonering->id_phonering;?></th>
            <td><?php echo $phonering->people instanceof PeopleModel ? $phonering->people->fio : $phonering->callerphone;?></td>
            <td><?php echo $phonering->datetime; ?></td>
            <td>
                <a href="index.php?url=phonering/delete/<?php echo $phonering->id_phonering?>">Удалить</a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else {?>
    <p>Нет входящих</p>
<?php } ?>

<a href="index.php?url=people/index">Назад</a>

<?php include 'Templates/footer.php';?>
