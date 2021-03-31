<?php
//voegt form toe aan de database
if(isset($_POST['submit'])) {

    $naam = mysqli_real_escape_string($conn, $_POST['naam']);
    $telefoonnummer = mysqli_real_escape_string($conn, $_POST['telefoonnummer']);
    $datum = mysqli_real_escape_string($conn, $_POST['datum']);
    $tijd = mysqli_real_escape_string($conn, $_POST['tijd']);
    $personen = mysqli_real_escape_string($conn, $_POST['personen']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $opmerking = mysqli_real_escape_string($conn, $_POST['opmerking']);

    $sql = "INSERT INTO reserveringen(naam, telefoonnummer, datum, tijd, personen, email, opmerking) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error";
    } else {
        mysqli_stmt_bind_param($stmt, "sississ", $naam, $telefoonnummer, $datum, $tijd, $personen, $email, $opmerking);
        mysqli_stmt_execute($stmt);
        header("location: ../bevestiging.php");
        require_once 'reserveringmailer.php';
    }
}
