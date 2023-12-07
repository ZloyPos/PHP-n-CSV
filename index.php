<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Работа с CSV</title>
    <style>
    </style>
</head>
<body>
    <form method="post">
        <label for="first_name">Имя:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>
        <label for="c_name">Фамилия:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>
        <label for="birth_year">Год рождения:</label><br>
        <input type="text" id="birth_year" name="birth_year" pattern="[0-9]{4}" maxlength="4" required><br><br>
        <button type="submit" name="submit">Отправить</button>
    </form>
    <hr>
    <table border="1">
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Год рождения</th>
        </tr>
        <?php
        if(isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["birth_year"])) {
            $first_name = filter_var($_POST["first_name"], FILTER_SANITIZE_STRING);
            $last_name = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
            $birth_year = $_POST["birth_year"];

            $file = fopen("data.csv", "a");

            fputcsv($file, array($first_name, $last_name, $birth_year));

            fclose($file);

            header("Location:index.php");
        }
        if (($handle = fopen("data.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                echo "<tr>";
                foreach ($data as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            fclose($handle);
        }
        ?>
    </table>
</body>
</html>