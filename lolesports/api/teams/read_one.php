<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once '../config/database.php';
include_once '../objects/team.php';
 
$database = new Database();
$db = $database->dbConnection();
$team = new Team($db);
$team->team_id = isset($_GET['team_id']) ? $_GET['team_id'] : die();
$team->readOne();
 
if($team->team_name!=null)
{
    $team_arr = array(
        "team_id" => $team -> team_id,
        "team_location" => $team -> team_location,
        "team_name" => $team -> team_name,
        "team_partner" => $team -> team_partner,
        "team_region" => $team -> team_region
    );
 
    http_response_code(200);
    echo json_encode($team_arr);
}
else
{
    http_response_code(404);
    echo json_encode(array("message" => "Team does not exist."));
}
?>