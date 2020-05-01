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
if (isset($_POST["user_email"])) {
    $type = $_POST['type'];
    
    $result = mysqli_query($con, "SELECT * FROM events WHERE user_email = '$user_email'");


    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {

            $response["events"] = array();

            while ($row = mysqli_fetch_array($result)) {
                $event = array();
                $event["title"] = $row["title"];
                $event["start_time"] = $row["start_time"];
                $event["end_time"] = $row["end_time"];
                $event["year"] = $row["year"];
                $event["month"] = $row["month"];
                $event["day"] = $row["day"];
                $event["notes"] = $row["notes"];
                $event["priority"] = $row["priority"];
                $event["weather"] = $row["weather"];
                $event["outside"] = $row["outside"];
                $event["notify"] = $row["notify"];
                $event["user_email"] = $row["user_email"];
                
                
                $event["type"] = $row["type"];
                array_push($response["events"], $event);
            }

            $response["success"] = 1;

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
}
?>


