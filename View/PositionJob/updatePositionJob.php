<?php include 'Templates/header.php'; ?>

<h2>Обновление должности</h2>

<?php if (isset($data['status'])) {
    echo '<b>' . $data['status'] . '</b>';
}
?>

<form method="post">
    <label for="name_positionjob">Наименование</label>
    <input type="text" name="name_positionjob" id="name_positionjob" value="<?php echo $data['positionjob']->name_positionjob; ?>">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="/index.php?url=positionJob/index/ok">Назад</a>

<?php include 'Templates/footer.php'; ?>
