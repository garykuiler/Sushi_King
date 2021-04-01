<?php
    session_start();
    if (!isset($_SESSION["userUid"])) {
        header("location: ../login.php");
    }
        require_once '../includes/dbh.inc.php';
        require_once  '../php/xssSecurity.php';

        //selects everything from commission table
        $query = "SELECT * FROM reserveringen";
        $result = mysqli_query($conn, $query);

        //make an array called commissions
        $commissions = [];

        //fetch result and put it in array
        while ($row = mysqli_fetch_assoc($result)){
            $reserveren[] = $row;
        }
        mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="css/opmaakdata.css">
</head>
<body>
<div class="item">
    <form method="post" action="">
    <table class="adminTable">
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Telefoonnummer</th>
            <th>Datum</th>
            <th>Tijd</th>
            <th>Personen</th>
            <th>email</th>
            <th>Opmerking</th>
            <th colspan="4"></th>
            <th><a href="../includes/logout.inc.php">Log out</th>
        </tr>
        <?php
        //reads array and puts in table
        foreach($reserveren as $value){ ?>
            <tr>
                <td><?= e($value["id"])?></td>
                <td><?= e($value["naam"])?></td>
                <td><?= e($value["telefoonnummer"])?></td>
                <td><?= e($value["datum"])?></td>
                <td><?= e($value["tijd"])?></td>
                <td><?= e($value["personen"])?></td>
                <td><?= e($value["email"])?></td>
                <td><?= e($value["opmerking"])?></td>
                <td><a href="../aanpassen.php?id=<?= $value['id'] ?>">Edit</a></td>
                <td><a href="delete.php?id=<?= $value['id'] ?>">Delete</a></td>
            </tr>
        <?php } ?>
    </table>
    </form>
</div>
</body>

</html>
