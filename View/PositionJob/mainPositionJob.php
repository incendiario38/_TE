<?php include 'Templates/header.php'; ?>

<h2>Должности</h2>

<?php if (isset($data['status'])) { ?>
    <p><?php echo $data['status'] ?></p>
<?php } ?>

<a href="index.php?url=positionJob/add">Добавить должность</a>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['positionjob'] as $positionJob) {?>
    <tr>
        <th><?php echo $positionJob->id_positionjob;?></th>
        <td><?php echo $positionJob->name_positionjob;?></td>
        <td>
            <a href="index.php?url=positionJob/update/<?php echo $positionJob->id_positionjob;?>">Обновить</a>
            <a href="index.php?url=positionJob/delete/<?php echo $positionJob->id_positionjob;?>">Удалить</a>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

    <a href="index.php?url=people/index">Назад</a>

<?php include 'Templates/footer.php';?>