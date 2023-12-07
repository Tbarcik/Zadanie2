<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databaza";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $login_email = mysqli_real_escape_string($conn, $_POST["login_email"]);
    $login_password = mysqli_real_escape_string($conn, $_POST["login_password"]);



    $errors = array();

    if (empty($login_email) || empty($login_password)) {
        $errors[] = "Všetky údaje sú povinné.";
    }

    if (!filter_var($login_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Neplatný formát emailu.";
    }

    if (count($errors) == 0) {

        $sql = "SELECT * FROM data WHERE email='$login_email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if (password_verify($login_password, $row["password"])) {

                $login_success = "Prihlásenie bolo úspešné!";
            } else {
                $login_error = "Nesprávne heslo.";
            }
        } else {
            $login_error = "Účet s týmto emailom neexistuje.";
        }
    } else {
        $login_error = implode("<br>", $errors);
    }

    $conn->close();
}
?>
