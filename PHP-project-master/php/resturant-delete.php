<?php
session_start();
require_once './db_connection.php';
$conn = new mysqli($hn, $un, $pw, $db); //Connection object

if($conn->connect_error) die($conn->connect_error);

        print_r($_SESSION);
        $resturantId = $_SESSION['res_id'];
        $query = "DELETE FROM resturant_review WHERE resturant_review.resturant_id = $resturantId;";

        // print_r($query);
        $result = $conn->query($query);
        if(!$result) die($conn->error);

        $query2 = "DELETE FROM resturant WHERE resturant.resturant_id = $resturantId;";
        $result = $conn->query($query2);
        if(!$result) die($conn->error);
        header('Location: resturant-list.php');
        exit();

?>
