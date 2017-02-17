<?php

/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/22/2017
 * Time: 9:45 AM
 */
class CVmap
{
    // database connection and table name
    private $conn;
    private $table_name = "cv_map";

    // object properties
    public $nic;
    public $path;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function upload(){
        // query to insert record
        $query = "INSERT INTO 
                " . $this->table_name . "
            SET 
                nic=:nic, path=:path";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->path=htmlspecialchars(strip_tags($this->path));

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        $stmt->bindParam(":path", $this->path);

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

    function search(){
        $query = "SELECT * FROM " .$this->table_name . " WHERE NIC = :nic " ;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));

        // bind values
        $stmt->bindParam(":nic", $this->nic);

        // execute query
        if($stmt->execute()){

            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $num = $stmt->rowCount();
            if ($num == 1)
            {
                return $row['PATH'];
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