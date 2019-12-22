<?php include 'Templates/header.php'; ?>

    <h2>Группы контактов</h2>

<?php if (isset($data['status'])) { ?>
    <p><?php echo $data['status'] ?></p>
<?php } ?>

    <a href="index.php?url=group/add">Добавить группу</a>
<a href="index.php?url=group/search">Найти нужную группу</a>

    <!--<ul>-->
<?php
//foreach ($data['groups'] as $group) {
//    echo '<li><pre>' . print_r($group, 1) . '</pre></li>';
//}
//?>
    <!--</ul>-->

    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['groups'] as $group) { ?>
            <tr>
                <th><?php echo $group->id_group; ?></th>
                <td><?php echo $group->name_group; ?></td>
                <td>
                    <a href="index.php?url=group/update/<?php echo $group->id_group; ?>">Обновить</a>
                    <a href="index.php?url=group/delete/<?php echo $group->id_group; ?>">Удалить</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php include 'Templates/footer.php'; ?>