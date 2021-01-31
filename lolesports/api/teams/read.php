<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/team.php';

$database = new Database();
$db = $database->dbConnection();
$team = new Team($db);
$stmt = $team->read();
$num = $stmt->rowCount();
 
if($num>0)
{
    $team_arr=array();
    $team_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);

        $team_item=array(
            "team_id" => $team_id,
            "team_location" => $team_location,
            "team_name" => $team_name,
            "team_partner" => $team_partner,
            "team_region" => $team_region
        );
 
        array_push($team_arr["records"], $team_item);
    }
 
    http_response_code(200);
    echo json_encode($team_arr);
}
else
{
    http_response_code(404);
    echo json_encode(array("message" => "No products found."));
}