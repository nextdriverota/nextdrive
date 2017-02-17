<?php

/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/31/2017
 * Time: 11:39 PM
 */
class Interests
{
    // database connection and table name
    private $conn;
    private $table_name = "interests";

    // object properties
    public $nic;
    public $interests;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function save(){

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET 
                    nic=:nic, 
                    interests=:interests";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->interests=htmlspecialchars(strip_tags($this->interests));

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        $stmt->bindParam(":interests", $this->interests);

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
                    interests=:interests
                    WHERE nic=:nic ";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->interests=htmlspecialchars(strip_tags($this->interests));

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        $stmt->bindParam(":interests", $this->interests);

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