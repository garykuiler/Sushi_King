<?php
    session_start();
    require_once '../includes/dbh.inc.php';
    require_once  '../php/xssSecurity.php';
?>

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
        if (isset($_SESSION["userUid"])) {

            $sql = "SELECT * FROM reserveringen";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . e($row["id"]) . "</td><td>" . e($row["naam"]) . "</td><td>" . e($row["telefoonnummer"]) . "</td><td>" . e($row["tijd"]) . "</td><td>" . e($row["datum"]) . "</td><td>" . e($row["personen"]) . "</td><td>" . e($row["email"]) . "</td><td>" . e($row["opmerking"]) . '</td><td><a href="../aanpassen.php?id="' . e($row["id"]) .
                        ">Edit</a></td><td><a href='../login/delete.php?id='" . e($row["id"]) . ">Delete</a></td></tr>";
                }
            } else {
                echo "0 results";
            }

        } else {
            echo "Not logged in";
        }
        ?>
    </table>
    </form>
</div>
</body>

</html>
