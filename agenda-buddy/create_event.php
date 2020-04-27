<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['title']) && isset($_POST['location']) && isset($_POST['start_time']) && isset($_POST['end_time'])){
 
    $title = $_POST['title'];
    $location = $_POST['location'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    
    require_once __DIR__ . '/db_config.php';

    // include db connect class
 
    // connecting to db
    $con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysqli_error());

    // mysql inserting a new row
    $result = mysqli_query($con, "INSERT INTO events(title, location, start_time, end_time, year, month, day, user_id) VALUES('$title', '$location', '$start_time', '$end_time', '$year', '$month', '$day', 1)");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Event successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        $response["error"] = mysqli_errno($con);
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
