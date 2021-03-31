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
            $commissions[] = $row;
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
            <th>id</th>
            <th>naam</th>
            <th>telefoonnummer</th>
            <th>email</th>
            <th>personen</th>
            <th>tijd</th>
            <th>datum</th>
            <th>opmerking</th>
            <th colspan="4"></th>
            <th><a href="../includes/logout.inc.php">Log out</th>
        </tr>
        <?php
        //reads array and puts in table
        foreach($commissions as $value){ ?>
            <tr>
                <td><?= htmlentities($value["id"])?></td>
                <td><?= htmlentities($value["naam"])?></td>
                <td><?= htmlentities($value["telefoonnummer"])?></td>
                <td><?= htmlentities($value["datum"])?></td>
                <td><?= htmlentities($value["tijd"])?></td>
                <td><?= htmlentities($value["personen"])?></td>
                <td><?= htmlentities($value["email"])?></td>
                <td><?= htmlentities($value["opmerking"])?></td>
                <td><a href="../aanpassen.php?id=<?= $value['id'] ?>">Edit</a></td>
                <td><a href="delete.php?id=<?= $value['id'] ?>">Delete</a></td>
            </tr>
        <?php } ?>
    </table>
    </form>
</div>
</body>

</html>
