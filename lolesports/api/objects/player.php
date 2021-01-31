<?php
class Player{

    private $conn;
    private $table_name = "players";
 
    public $player_birthday;
    public $player_country;
    public $player_id;
    public $player_name;
    public $player_role;
    public $player_team;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY player_id";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    function readCountry($country)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE player_country = ?";
        $stmt = $this->conn->prepare($query);
        $country=htmlspecialchars(strip_tags($country));
        $stmt->bindParam(1, $country);
        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
            SET
                player_birthday=:player_birthday, 
                player_country=:player_country,
                player_id=:player_id,
                player_name=:player_name,
                player_role=:player_role,
                player_team=:player_team";

        $stmt = $this->conn->prepare($query);
     
        $this->player_birthday=htmlspecialchars(strip_tags($this->player_birthday));
        $this->player_country=htmlspecialchars(strip_tags($this->player_country));
        $this->player_id=htmlspecialchars(strip_tags($this->player_id));
        $this->player_name=htmlspecialchars(strip_tags($this->player_name));
        $this->player_role=htmlspecialchars(strip_tags($this->player_role));
        $this->player_team=htmlspecialchars(strip_tags($this->player_team));
     
        $stmt->bindParam(":player_birthday", $this->player_birthday);
        $stmt->bindParam(":player_country", $this->player_country);
        $stmt->bindParam(":player_id", $this->player_id);
        $stmt->bindParam(":player_name", $this->player_name);
        $stmt->bindParam(":player_role", $this->player_role);
        $stmt->bindParam(":player_team", $this->player_team);
     
        if($stmt->execute())
        {
            return true;
        }
        return false;
    }


    function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE player_id = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->player_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->player_birthday = $row['player_birthday'];
        $this->player_country = $row['player_country'];
        $this->player_id = $row['player_id'];
        $this->player_name = $row['player_name'];
        $this->player_role = $row['player_role'];
        $this->player_team = $row['player_team'];
    }

    function update()
    {
        $query = "UPDATE " . $this->table_name . "
            SET
                player_birthday = :player_birthday, 
                player_country = :player_country,
                player_name = :player_name,
                player_role = :player_role,
                player_team = :player_team
            WHERE
                player_id = :player_id";
    
        $stmt = $this->conn->prepare($query);
    
        $this->player_birthday=htmlspecialchars(strip_tags($this->player_birthday));
        $this->player_country=htmlspecialchars(strip_tags($this->player_country));
        $this->player_id=htmlspecialchars(strip_tags($this->player_id));
        $this->player_name=htmlspecialchars(strip_tags($this->player_name));
        $this->player_role=htmlspecialchars(strip_tags($this->player_role));
        $this->player_team=htmlspecialchars(strip_tags($this->player_team));

        $stmt->bindParam(":player_birthday", $this->player_birthday);
        $stmt->bindParam(":player_country", $this->player_country);
        $stmt->bindParam(":player_id", $this->player_id);
        $stmt->bindParam(":player_name", $this->player_name);
        $stmt->bindParam(":player_role", $this->player_role);
        $stmt->bindParam(":player_team", $this->player_team);

        if($stmt->execute())
        {
            return true;
        }
        return false;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE player_id = ?";
    
        $stmt = $this->conn->prepare($query);
    
        $this->player_id=htmlspecialchars(strip_tags($this->player_id));
    
        $stmt->bindParam(1, $this->player_id);
    
        if($stmt->execute())
        {
            return true;
        }
        return false;
     
    }
}