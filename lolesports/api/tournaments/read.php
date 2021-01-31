<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/tournament.php';

$database = new Database();
$db = $database->dbConnection();
$tournament = new Tournament($db);
$stmt = $tournament->read();
$num = $stmt->rowCount();

if($num>0)
{
    $tournament_arr=array();
    $tournament_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $tournament_item=array(
            "tournament_id" => $tournament_id,
            "tournament_name" => $tournament_name,
            "tournament_prizepool" => $tournament_prizepool,
            "tournament_region" => $tournament_region,
            "tournament_runnerup" => $tournament_runnerup,
            "tournament_season" => $tournament_season,
            "tournament_winner" => $tournament_winner,
            "tournament_year" => $tournament_year
        );
 
        array_push($tournament_arr["records"], $tournament_item);
    }

    http_response_code(200);
    echo json_encode($tournament_arr);
}
else
{
    http_response_code(404);
    echo json_encode(array("message" => "No tourament found."));
}