<?php include 'Templates/header.php'; ?>

    <h2>Добавление группы</h2>

<?php if (isset($data['status'])) {
    echo '<b>' . $data['status'] . '</b>';
}
?>

<form method="post">
    <label for="name_group">Наименование</label>
    <input type="text" name="name_group" id="name_group">
    <input type="submit" name="submit" value="Submit">
</form>

<?php include 'Templates/footer.php'; ?>