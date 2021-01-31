<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/team.php';
 
$database = new Database();
$db = $database->dbConnection();
$team = new Team($db);
$data = json_decode(file_get_contents("php://input"));
 
if( !empty($data->team_id) &&
    !empty($data->team_location) &&
    !empty($data->team_name) &&
    !empty($data->team_partner) &&
    !empty($data->team_region))
{
    $team->team_id = $data->team_id;
    $team->team_location = $data->team_location;
    $team->team_name = $data->team_name;
    $team->team_partner = $data->team_partner;
    $team->team_region = $data->team_region;
 
    if($team->create())
    {
        http_response_code(201);
        echo json_encode(array("message" => "Team was created."));
    }
    else
    {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create Team."));
    }
}
else
{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create Team. Data is incomplete."));
}
?>