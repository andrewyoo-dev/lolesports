<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/player.php';
 
$database = new Database();
$db = $database->dbConnection();
$player = new Player($db);
$data = json_decode(file_get_contents("php://input"));

$player->player_id = $data->player_id;
$player->player_birthday = $data->player_birthday;
$player->player_country = $data->player_country;
$player->player_name = $data->player_name;
$player->player_role = $data->player_role;
$player->player_team = $data->player_team;
 
if($player->update())
{
    http_response_code(200);
    echo json_encode(array("message" => "Player was updated."));
}
else
{
    http_response_code(503);
    echo json_encode(array("message" => "Unable to update player."));
}
?>