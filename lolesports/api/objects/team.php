<?php
class Team
{
    private $conn;
    private $table_name = "teams";
 
    public $team_id;
    public $team_location;
    public $team_name;
    public $team_partner;
    public $team_region;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY team_id";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    function roster($team_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " JOIN players ON team_id = player_team WHERE team_id = ?";
        $stmt = $this->conn->prepare($query);
        $team_id=htmlspecialchars(strip_tags($team_id));
        $stmt->bindParam(1, $team_id);
        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
            SET
                team_id=:team_id, 
                team_location=:team_location,
                team_name=:team_name,
                team_partner=:team_partner,
                team_region=:team_region";

        $stmt = $this->conn->prepare($query);
     
        $this->team_id=htmlspecialchars(strip_tags($this->team_id));
        $this->team_location=htmlspecialchars(strip_tags($this->team_location));
        $this->team_name=htmlspecialchars(strip_tags($this->team_name));
        $this->team_partner=htmlspecialchars(strip_tags($this->team_partner));
        $this->team_region=htmlspecialchars(strip_tags($this->team_region));
     
        $stmt->bindParam(":team_id", $this->team_id);
        $stmt->bindParam(":team_location", $this->team_location);
        $stmt->bindParam(":team_name", $this->team_name);
        $stmt->bindParam(":team_partner", $this->team_partner);
        $stmt->bindParam(":team_region", $this->team_region);
     
        if($stmt->execute())
        {
            return true;
        }
        return false;
    }


    function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE team_id = ?";
    
        $stmt = $this->conn->prepare( $query );
    
        $stmt->bindParam(1, $this->team_id);
    
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->team_id = $row['team_id'];
        $this->team_location = $row['team_location'];
        $this->team_name = $row['team_name'];
        $this->team_partner = $row['team_partner'];
        $this->team_region = $row['team_region'];
    }

    function update()
    {
        $query = "UPDATE " . $this->table_name . "
            SET
                team_location = :team_location,
                team_name = :team_name,
                team_partner = :team_partner,
                team_region = :team_region
            WHERE
                team_id = :team_id";
    
        $stmt = $this->conn->prepare($query);
    
        $this->team_id=htmlspecialchars(strip_tags($this->team_id));
        $this->team_location=htmlspecialchars(strip_tags($this->team_location));
        $this->team_name=htmlspecialchars(strip_tags($this->team_name));
        $this->team_partner=htmlspecialchars(strip_tags($this->team_partner));
        $this->team_region=htmlspecialchars(strip_tags($this->team_region));

        $stmt->bindParam(":team_id", $this->team_id);
        $stmt->bindParam(":team_location", $this->team_location);
        $stmt->bindParam(":team_name", $this->team_name);
        $stmt->bindParam(":team_partner", $this->team_partner);
        $stmt->bindParam(":team_region", $this->team_region);

        if($stmt->execute())
        {
            return true;
        }
        return false;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE team_id = ?";
    
        $stmt = $this->conn->prepare($query);
    
        $this->team_id=htmlspecialchars(strip_tags($this->team_id));
    
        $stmt->bindParam(1, $this->team_id);
    
        if($stmt->execute())
        {
            return true;
        }
        return false;
     
    }
}