<?php
require_once "../includes/dbh.inc.php";

session_start();
if(!isset($_SESSION['userUid'])){
    //redirects to login page
    header("Location: ../login.php");
}

if (isset($_POST['submit'])) {
    // Delete data from the database
    $query = "DELETE FROM reserveringen WHERE id = " . mysqli_escape_string($conn, $_POST['id']);

    //runs query on database, or stop the query if error and show error
    mysqli_query($conn, $query) or die ('Error: '.mysqli_error($conn));

    mysqli_close($conn);

    header("Location: dataconn.php");
    exit;

}
//if submit is not pressed/the page is loaded for first time
//if id is present in url
else if(isset($_GET['id'])) {
    //Retrieve the id from url
    $id = $_GET['id'];

    //query to get data from the database
    $query = "SELECT * FROM reserveringen WHERE id = " . mysqli_escape_string($conn, $id);
    //runs query on database and put it in $result
    $result = mysqli_query($conn, $query) or die ('Error: ' . $query );

    //if there is exactly one result
    if(mysqli_num_rows($result) == 1) {
        //fetches data and put data in $reserveren to read
        $reserveren = mysqli_fetch_assoc($result);
    }
    //if not exactly one result
    else {
        // redirect when database returns no result
        header('Location: dataconn.php');
        exit;
    }
}
//if id is not present in url
else {
    // redirect to admin page
    header('Location: dataconn.php');
    exit;
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Delete Commission <?= $id ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="item centerTextAlign">
    <div class="subtitle">
        Reservering ID <?= $id?>
    </div>
    <form action="" method="post">
        <table>
            <p>Weet u zeker of u wilt annuleren?</p>
            <tr>
                <td>ID</td>
                <td><?= htmlentities($reserveren['id'])?></td>
            </tr>
            <tr>
                <td>Naam</td>
                <td><?= htmlentities($reserveren['naam'])?></td>
            </tr>
            <tr>
                <td>Telefoonnummer</td>
                <td><?= htmlentities($reserveren['telefoonnummer'])?></td>
            </tr>
            <tr>
                <td>Datum</td>
                <td><?= htmlentities($reserveren['datum'])?></td>
            </tr>
            <tr>
                <td>Tijd</td>
                <td><?= htmlentities($reserveren['tijd'])?></td>
            </tr>
            <tr>
                <td>Personen</td>
                <td><?= htmlentities($reserveren['personen'])?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= htmlentities($reserveren['email'])?></td>
            </tr>

            <tr>
                <td>Opmerking</td>
                <td><?= htmlentities($reserveren['opmerking'])?></td>
            </tr>
        </table>

        <br>
        <br>
        <a href="dataconn.php">Terug</a>
        <input type="hidden" name="id" value="<?= $reserveren['id'] ?>"/>
        <input type="submit" name="submit" value="Yes, delete"/>
    </form>
</div>
</body>
</html>