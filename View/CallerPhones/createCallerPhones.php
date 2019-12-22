<?php include 'Templates/header.php'?>

<h2>Добавить входящий</h2>

<?php if (isset($data['status'])) {
    echo '<b>' . $data['status'] . '</b>';
}
?>

<form method="post">
    <label for="callerphone">Входящий</label>
    <input type="tel" name="callerphone" id="callerphone">

    <label for="datetime">Дата и время</label>
    <input type="datetime-local" name="datetime" id="datetime">

    <input type="submit" name="submit" value="Submit">
</form>

<?php include 'Templates/footer.php'?>
