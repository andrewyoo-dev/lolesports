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
 
if( !empty($data->tournament_id) &&
    !empty($data->tournament_name) &&
    !empty($data->tournament_prizepool) &&
    !empty($data->tournament_region) &&
    !empty($data->tournament_runnerup) &&
    !empty($data->tournament_season) &&
    !empty($data->tournament_winner) &&
    !empty($data->tournament_year))
{
    $tournament->tournament_id = $data->tournament_id;
    $tournament->tournament_name = $data->tournament_name;
    $tournament->tournament_prizepool = $data->tournament_prizepool;
    $tournament->tournament_region = $data->tournament_region;
    $tournament->tournament_runnerup = $data->tournament_runnerup;
    $tournament->tournament_season = $data->tournament_season;
    $tournament->tournament_winner = $data->tournament_winner;
    $tournament->tournament_year = $data->tournament_year;
 
    if($tournament->create())
    {
        http_response_code(201);
        echo json_encode(array("message" => "Tournament was created."));
    }
    else
    {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create tournament."));
    }
}
else
{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create tournament. Data is incomplete."));
}
?>