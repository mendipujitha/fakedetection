<?php
session_start();
require_once './db_connection.php';
$conn = new mysqli($hn, $un, $pw, $db); //Connection object

if($conn->connect_error) die($conn->connect_error);
        // print_r($_SESSION);
        $foodId = $_SESSION['food_id'];
        $query = "DELETE FROM food_item WHERE item_id = $foodId;";

        // print_r($query);
        $result = $conn->query($query);
        if(!$result) die($conn->error);

        header('Location: food-items-list.php');
        exit();

?>
