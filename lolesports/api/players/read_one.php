<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once '../config/database.php';
include_once '../objects/player.php';
 
$database = new Database();
$db = $database->dbConnection();
$player = new Player($db);
$player->player_id = isset($_GET['player_id']) ? $_GET['player_id'] : die();
$player->readOne();
 
if($player->player_name!=null)
{
    $player_arr = array(
        "player_birthday" => $player -> player_birthday,
        "player_country" => $player -> player_country,
        "player_id" => $player -> player_id,
        "player_name" => $player -> player_name,
        "player_role" => $player -> player_role,
        "player_team" => $player -> player_team
    );
 
    http_response_code(200);
    echo json_encode($player_arr);
}
else
{
    http_response_code(404);
    echo json_encode(array("message" => "Player does not exist."));
}
?>