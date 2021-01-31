<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once '../config/database.php';
include_once '../objects/tournament.php';
 
$database = new Database();
$db = $database->dbConnection();
$tournament = new Tournament($db);
$tournament->tournament_id = isset($_GET['tournament_id']) ? $_GET['tournament_id'] : die();
$tournament->readOne();
 
if($tournament->tournament_name!=null)
{
    $tournament_arr = array(
        "tournament_id" => $tournament -> tournament_id,
        "tournament_name" => $tournament -> tournament_name,
        "tournament_prizepool" => $tournament -> tournament_prizepool,
        "tournament_region" => $tournament -> tournament_region,
        "tournament_runnerup" => $tournament -> tournament_runnerup,
        "tournament_season" => $tournament -> tournament_season,
        "tournament_winner" => $tournament -> tournament_winner,
        "tournament_year" => $tournament -> tournament_year
    );
 
    http_response_code(200);
    echo json_encode($tournament_arr);
}
 
else
{
    http_response_code(404);
    echo json_encode(array("message" => "Tournament does not exist."));
}
?>