<?php
 
/*
 * Following code will get single event details
 * A event is identified by event id (pid)
 */
 
// array for JSON response
$response = array();
require_once __DIR__ . '/db_config.php';

$con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysqli_error());

 
// check for post data

    
$result = mysqli_query($con, "SELECT * FROM community");


if (!empty($result)) {
    // check for empty result
    if (mysqli_num_rows($result) > 0) {
        
        $response["events"] = array();

        while ($row = mysqli_fetch_array($result)) {
            $event = array();
            $event["hash"] = $row["hash"];
            $event["title"] = $row["title"];
            $event["start_time"] = $row["start_time"];
            $event["end_time"] = $row["end_time"];

            $event["type"] = $row["type"];

        }
        array_push($response["events"], $event);
        // echoing JSON response
        echo json_encode($response);
    } else {
        // no event found
        $response["success"] = 0;
        $response["message"] = "No event found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // no event found
    $response["success"] = 0;
    $response["message"] = "No event found";
    $response["result"] = $result;

    // echo no users JSON
    echo json_encode($response);
}
?>


