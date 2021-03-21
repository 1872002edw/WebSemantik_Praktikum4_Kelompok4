<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/artist.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare artist object
$artist = new Artists($db);
  
// get id of artist to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of artist to be edited
$artist->idartists = $data->idartists;
  
// set artist property values
$artist->name = $data->name;
$artist->debut = $data->debut;
$artist->company = $data->company;
  
// update the artist
if($artist->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Product was updated."));
}
  
// if unable to update the artist, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update artist."));
}
?>