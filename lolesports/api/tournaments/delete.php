<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/tournament.php';
 
$database = new Database();
$db = $database->dbConnection();
$tournament = new Tournament($db);
$data = json_decode(file_get_contents("php://input"));
 
$tournament->tournament_id = $data->tournament_id;
 
if($tournament->delete())
{
    http_response_code(200);
    echo json_encode(array("message" => "Tournament was deleted."));
}
else
{
    http_response_code(503);
    echo json_encode(array("message" => "Unable to delete tournament."));
}
?>