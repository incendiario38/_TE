<?php include 'Templates/header.php'; ?>

<h2>Добавление должности</h2>

<?php if (isset($data['status'])) {
    echo '<b>' . $data['status'] . '</b>';
}
?>

<form method="post">
    <label for="name_positionjob">Наименование</label>
    <input type="text" name="name_positionjob" id="name_positionjob">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php?url=positionjob/index">Назад</a>

<?php include 'Templates/footer.php'; ?>
