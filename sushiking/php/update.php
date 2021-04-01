<?php
if (!isset($_SESSION['userUid'])) {
    //redirects to login page
    header("Location: ../login.php");
}
//if submit is clicked
if (isset($_POST['submit'])) {
    //receive data from edit and protect from sql injections
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $updNaam = mysqli_real_escape_string($conn, $_POST['updNaam']);
    $updTelefoonnummer = mysqli_real_escape_string($conn, $_POST['updTelefoonnummer']);
    $updDatum = mysqli_real_escape_string($conn, $_POST['updDatum']);
    $updTijd = mysqli_real_escape_string($conn, $_POST['updTijd']);
    $updPersonen = mysqli_real_escape_string($conn, $_POST['updPersonen']);
    $updEmail = mysqli_real_escape_string($conn, $_POST['updEmail']);
    $updOpmerking = mysqli_real_escape_string($conn, $_POST['updOpmerking']);

    //Save variables to array
    $reserveren = [
        'naam' => $updNaam,
        'telefoonnummer' => $updTelefoonnummer,
        'updDatum' => $updDatum,
        'tijd' => $updTijd,
        'personen' => $updPersonen,
        'email' => $updEmail,
        'opmerking' => $updOpmerking,
    ];

    //if no errors
    if (empty($errors)) {
        //query to update the reservering information in the database
        $query = "UPDATE reserveringen
                  SET naam = '$updNaam', telefoonnummer = '$updTelefoonnummer', datum = '$updDatum', tijd = '$updTijd', personen = '$updPersonen', email = '$updEmail', opmerking = '$updOpmerking'
                  WHERE id = '$id'";
        //runs the query on database and put result in $result
        $result = mysqli_query($conn, $query);
        //fetches data and put it in $reserveren to read data
        $reserveren = mysqli_fetch_assoc($result);

        //if query is run
        if ($result) {
            //redirect to admin page
            header('Location: login/dataconn.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($conn);
        }

    }
}

//if submit is not pressed/page is loaded for the first time
// if there is an id in url
else if (isset($_GET['id'])) {
    //Retrieve the id from url
    $id = $_GET['id'];

    //query to get reservering from the database
    $query = "SELECT * FROM reserveringen WHERE id = " . mysqli_escape_string($conn, $id);
    //runs query in database and puts result in $result
    $result = mysqli_query($conn, $query);

    //if there is exactly 1 result
    if (mysqli_num_rows($result) == 1) {
        //fetches data and put in $reserveren to read data
        $reserveren = mysqli_fetch_assoc($result);

    } //if there is not exactly 1 result
    else {
        // redirect to admin
        header('Location: ../login/dataconn.php');
        exit;
    }
} //if there is no id in url
else {
    //redirect to admin
    header('Location: ../login/dataconn.php');
    exit;
}

//Close connection to db
mysqli_close($conn);


