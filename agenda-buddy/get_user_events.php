<?php
 
/*
 * Following code will get single event details
 * A event is identified by user id (uid)
 */
 
// array for JSON response
$response = array();
require_once __DIR__ . '/db_config.php';

$con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysqli_error());

 
// check for post data
if (isset($_POST["eid"])) {
    $eid = $_POST['eid'];
    
    $result = mysqli_query($con, "SELECT * FROM events WHERE uid = $uid");

 
    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {
 
            $result = mysqli_fetch_array($result);
                        
            $event = array();
            $event["eid"] = $result["eid"];
            $event["title"] = $result["title"];
            $event["location"] = $result["location"];
            $event["start_time"] = $result["start_time"];
            $event["end_time"] = $result["end_time"];

            // success
            $response["success"] = 1;
 
            // user node
            $response["event"] = array();
 
            array_push($response["event"], $event);
 
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
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>


