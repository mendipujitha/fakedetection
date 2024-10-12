<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <title>Zomato - Add Resturant</title>
        <link rel="stylesheet" href="../styles/food-details.css">
        <link rel="stylesheet" href="../styles/styles.css">
    </head>

    <body>
        <header>
            <!-- <a href="./food-items-list.php" id="deleteMovieBtn" class="btn btn-primary">Delete food details</a> -->
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                        <a class="navbar-brand" href="./resturant-list.php">Zomato</a>
                        <!-- <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="./update-resturant-details.php" class="nav-link">Update Resturant Details</a>
                                </li>
                            </ul>
                        </div> -->
                    </nav>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form class="form" method="post" action="./add-resturant.php">
                        <span class="form-title">
                            Add resturant
                        </span>

                        <div class="div-input">
                            <span class="label-input100">Resturant Name</span>
                            <input class="input100" type="text" name="name" value="">
                        </div>
                        <div class="div-input">
                            <span class="label-input100">Cuisine(s)</span>
                            <input class="input100" type="text" name="cuisine" value="">
                        </div>
                        <div class="div-input">
                            <span class="label-input100">Address</span>
                            <textarea class="input100" name="address">

                            </textarea>
                        </div>
                        <div class="div-input">
                            <span class="label-input100">Opening Time</span>
                            <input class="input100" type="time" name="open" value="">
                        </div>
                        <div class="div-input">
                            <span class="label-input100">Closing Time</span>
                            <input class="input100" type="time" name="close" value="">
                        </div>
                        <div class="div-input">
                            <span class="label-input100">Logo</span>
                            <input class="input100" type="text" name="logo" value="">
                        </div>
                        <div class="div-input">
                            <span class="label-input100">Phone Number</span>
                            <!-- <input class="input100" type="text" name="cuisine" value=""> -->
                            <input class="input100" type="tel" id="phone" name="phone" value=""
                               pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                            <span class="note">Format: 801-800-1234</span>
                        </div>

                        <div class="container-contact100-form-btn">
                            <button type="submit" class="contact100-form-btn">
                                Add resturant
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>


<?php
// session_start();
  // print_r($_SESSION['is_admin']);
  require_once './db_connection.php';
  $conn = new mysqli($hn, $un, $pw, $db);

  // print_r($conn);

    if(isset($_POST['name']) && isset($_POST['cuisine']) && isset($_POST['address']) && isset($_POST['open'])){
      $resturantName = $_POST['name'];
      $cuisine = $_POST['cuisine'];
      $resturantAddress = $_POST['address'];
      $openTime = $_POST['open'];
      $closeTime = $_POST['close'];
      $logo = $_POST['logo'];
      $phone = $_POST['phone'];

      $query="INSERT INTO resturant (resturant_name, address, cuisine, telephone, start_time, close_time, logo)
      VALUES ('$resturantName', '$resturantAddress', '$cuisine', '$phone', '$openTime', '$closeTime', '$logo')";

      $result = $conn->query($query);
      header("Location: resturant-list.php");
      exit();
      // print_r($result);
      if(!$result){
        die($conn->connect_error);
      }

  }


?>
