<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/team.php';
 
$database = new Database();
$db = $database->dbConnection();
 
$team = new Team($db);
$team_id=isset($_GET["team_id"]) ? $_GET["team_id"] : "";
$stmt = $team->roster($team_id);
$num = $stmt->rowCount();

if($num>0){

    $players_arr=array();
    $players_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $player_item=array(
            "player_birthday" => $player_birthday,
            "player_country" => $player_country,
            "player_id" => $player_id,
            "player_name" => $player_name,
            "player_role" => $player_role,
            "player_team" => $player_team,
            "player_url" => "http://andrewy.sgedu.site/lolesports/api/players/read_one.php?player_id=" . $player_id
        );
 
        array_push($players_arr["records"], $player_item);
    }
 
    http_response_code(200);
    echo json_encode($players_arr);
}
 
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No players found.")
    );
}
?>