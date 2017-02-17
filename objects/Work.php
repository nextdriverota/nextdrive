<?php

/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/28/2017
 * Time: 10:47 AM
 */
class Work
{
    // database connection and table name
    private $conn;
    private $table_name = "work";

    // object properties
    public $nic;
    public $id;
    public $title;
    public $company;
    public $date_from;
    public $date_to;
    public $address;
    public $description;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function save(){

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET 
                    nic=:nic, 
                    id=:id,
                    title=:title,
                    company=:company,
                    date_from=:date_from,
                    date_to=:date_to,
                    address=:address,
                    description=:description";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->company=htmlspecialchars(strip_tags($this->company));
        $this->date_from=htmlspecialchars(strip_tags($this->date_from));
        $this->date_to=htmlspecialchars(strip_tags($this->date_to));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->description=htmlspecialchars(strip_tags($this->description));

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":company", $this->company);
        $stmt->bindParam(":date_from", $this->date_from);
        $stmt->bindParam(":date_to", $this->date_to);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":description", $this->description);

        // execute query
        if($stmt->execute()){
            return true;
        }else{
            echo "<pre>";
            print_r($stmt->errorInfo());
            echo "</pre>";

            return false;
        }
    }

    function update(){

        // query to insert record
        $query = "UPDATE " . $this->table_name . " SET 
                    title=:title,
                    company=:company,
                    date_from=:date_from,
                    date_to=:date_to,
                    address=:address,
                    description=:description
                    WHERE nic=:nic AND id=:id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->company=htmlspecialchars(strip_tags($this->company));
        $this->date_from=htmlspecialchars(strip_tags($this->date_from));
        $this->date_to=htmlspecialchars(strip_tags($this->date_to));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->description=htmlspecialchars(strip_tags($this->description));

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":company", $this->company);
        $stmt->bindParam(":date_from", $this->date_from);
        $stmt->bindParam(":date_to", $this->date_to);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":description", $this->description);

        // execute query
        if($stmt->execute()){
            return true;
        }else{
            echo "<pre>";
            print_r($stmt->errorInfo());
            echo "</pre>";

            return false;
        }
    }

    function load(){
        $query = "SELECT * FROM " .$this->table_name . " WHERE NIC = :nic " ;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));

        // bind values
        $stmt->bindParam(":nic", $this->nic);

        // execute query
        if($stmt->execute()){

            $num = $stmt->rowCount();
            $arr = array();

            if ($num != 0)
            {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $arr[] = $row;
                }
                return $arr;
            }

        }else{
            echo "<pre>";
            print_r($stmt->errorInfo());
            echo "</pre>";
            return false;
        }
    }

    function delete(){
        $query = "DELETE FROM " .$this->table_name . " WHERE NIC = :nic " ;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));

        // bind values
        $stmt->bindParam(":nic", $this->nic);

        // execute query
        if($stmt->execute()){
            return true;
        }else{
            echo "<pre>";
            print_r($stmt->errorInfo());
            echo "</pre>";
            return false;
        }
    }
}