<?php include 'Templates/header.php'; ?>

    <h2>Поиск нужной группы по наименованию</h2>

<?php if (isset($data['status'])) { ?>
    <p><?php echo $data['status'] ?></p>
<?php } ?>

    <form method="post">
        <label for="name_group">Наименование</label>
        <input type="text" name="name_group" id="name_group">
        <input type="submit" name="submit" value="Submit">
    </form>

<?php if (isset($data['groups']) && count($data['groups']) > 0) { ?>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Action</th>
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
<?php } else { ?>
    <p>Групп не найдено</p>
<?php } ?>

    <a href="/index.php?url=group/index">Назад</a>
<?php include 'Templates/footer.php'; ?>