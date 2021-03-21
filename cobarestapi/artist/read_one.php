<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/artist.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare artist object
$artist = new Artists($db);
  
// set ID property of record to read
$artist->idartists = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of artist to be edited
$artist->readOne();
  
if($artist->name!=null){
    // create array
    $artist_arr = array(
        "id" =>  $artist->idartists,
        "name" => $artist->name,
        "debut" => $artist->debut,
        "company" => $artist->company
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($artist_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user artist does not exist
    echo json_encode(array("message" => "Artist does not exist."));
}
?>