<?php
//connectie met de database wordt met PDO gedaan, plaats dit in elke file dat gebruik maakt van de database sushi_king.
date_default_timezone_set("Europe/Amsterdam");//America/New_York <- use this if not working
try{
    $handler = new PDO('mysql:host=localhost;port=3306;dbname=sushiking', 'root', '');
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo "Connection Failed" . $e->getMessage(); //statement is voor debugging vervang voor eindresultaat in bijv. echo "Sorry something wrong with the database";
    die();
}
