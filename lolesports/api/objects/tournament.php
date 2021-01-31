<?php
class Tournament
{
    private $conn;
    private $table_name = "tournaments";
 
    public $tournament_id;
    public $tournament_name;
    public $tournament_prizepool;
    public $tournament_region;
    public $tournament_runnerup;
    public $tournament_season;
    public $tournament_winner;
    public $tournament_year;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY tournament_year, tournament_id";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    function create()
    {
        $query = 
            "INSERT INTO " . $this->table_name . "
            SET
                tournament_id=:tournament_id, 
                tournament_name=:tournament_name,
                tournament_prizepool=:tournament_prizepool,
                tournament_region=:tournament_region,
                tournament_runnerup=:tournament_runnerup,
                tournament_season=:tournament_season,
                tournament_winner=:tournament_winner,
                tournament_year=:tournament_year";

        $stmt = $this->conn->prepare($query);
     
        $this->tournament_id=htmlspecialchars(strip_tags($this->tournament_id));
        $this->tournament_name=htmlspecialchars(strip_tags($this->tournament_name));
        $this->tournament_prizepool=htmlspecialchars(strip_tags($this->tournament_prizepool));
        $this->tournament_region=htmlspecialchars(strip_tags($this->tournament_region));
        $this->tournament_runnerup=htmlspecialchars(strip_tags($this->tournament_runnerup));
        $this->tournament_season=htmlspecialchars(strip_tags($this->tournament_season));
        $this->tournament_winner=htmlspecialchars(strip_tags($this->tournament_winner));
        $this->tournament_year=htmlspecialchars(strip_tags($this->tournament_year));
     
        $stmt->bindParam(":tournament_id", $this->tournament_id);
        $stmt->bindParam(":tournament_name", $this->tournament_name);
        $stmt->bindParam(":tournament_prizepool", $this->tournament_prizepool);
        $stmt->bindParam(":tournament_region", $this->tournament_region);
        $stmt->bindParam(":tournament_runnerup", $this->tournament_runnerup);
        $stmt->bindParam(":tournament_season", $this->tournament_season);
        $stmt->bindParam(":tournament_winner", $this->tournament_winner);
        $stmt->bindParam(":tournament_year", $this->tournament_year);
     
        if($stmt->execute())
        {
            return true;
        }
        return false;
    }


    function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tournament_id = ?";
    
        $stmt = $this->conn->prepare( $query );
    
        $stmt->bindParam(1, $this->tournament_id);
    
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->tournament_id = $row['tournament_id'];
        $this->tournament_name = $row['tournament_name'];
        $this->tournament_prizepool = $row['tournament_prizepool'];
        $this->tournament_region = $row['tournament_region'];
        $this->tournament_runnerup = $row['tournament_runnerup'];
        $this->tournament_season = $row['tournament_season'];
        $this->tournament_winner = $row['tournament_winner'];
        $this->tournament_year = $row['tournament_year'];
    }

    function update()
    {
        $query = "UPDATE " . $this->table_name . "
            SET
                tournament_name = :tournament_name, 
                tournament_prizepool = :tournament_prizepool,
                tournament_region = :tournament_region,
                tournament_runnerup = :tournament_runnerup,
                tournament_season = :tournament_season,
                tournament_winner = :tournament_winner,
                tournament_year = :tournament_year
            WHERE
                tournament_id = :tournament_id";
    
        $stmt = $this->conn->prepare($query);
    
        $this->tournament_id=htmlspecialchars(strip_tags($this->tournament_id));
        $this->tournament_name=htmlspecialchars(strip_tags($this->tournament_name));
        $this->tournament_prizepool=htmlspecialchars(strip_tags($this->tournament_prizepool));
        $this->tournament_region=htmlspecialchars(strip_tags($this->tournament_region));
        $this->tournament_runnerup=htmlspecialchars(strip_tags($this->tournament_runnerup));
        $this->tournament_season=htmlspecialchars(strip_tags($this->tournament_season));
        $this->tournament_winner=htmlspecialchars(strip_tags($this->tournament_winner));
        $this->tournament_year=htmlspecialchars(strip_tags($this->tournament_year));

        $stmt->bindParam(":tournament_id", $this->tournament_id);
        $stmt->bindParam(":tournament_name", $this->tournament_name);
        $stmt->bindParam(":tournament_prizepool", $this->tournament_prizepool);
        $stmt->bindParam(":tournament_region", $this->tournament_region);
        $stmt->bindParam(":tournament_runnerup", $this->tournament_runnerup);
        $stmt->bindParam(":tournament_season", $this->tournament_season);
        $stmt->bindParam(":tournament_winner", $this->tournament_winner);
        $stmt->bindParam(":tournament_year", $this->tournament_year);

        if($stmt->execute())
        {
            return true;
        }
        return false;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE tournament_id = ?";
    
        $stmt = $this->conn->prepare($query);
    
        $this->tournament_id=htmlspecialchars(strip_tags($this->tournament_id));
    
        $stmt->bindParam(1, $this->tournament_id);
    
        if($stmt->execute())
        {
            return true;
        }
        return false;
    }
}