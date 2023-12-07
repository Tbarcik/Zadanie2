<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databaza";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);


    $errors = array();

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "Všetky údaje sú povinné.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Neplatný formát emailu.";
    }

    if ($password != $confirm_password) {
        $errors[] = "Heslá sa nezhodujú.";
    }

    if (count($errors) == 0) {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO data (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $registration_success = "Registrácia bola úspešná!";
        } else {
            $register_error = "Registrácia zlyhala. Skúste to znova.";
        }
    } else {
        $register_error = implode("<br>", $errors);
    }

    $conn->close();
}
?>
