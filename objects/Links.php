<?php

/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 2/9/2017
 * Time: 11:01 PM
 */
class Links
{
    // database connection and table name
    private $conn;
    private $table_name = "links";

    // object properties
    public $nic;
    public $linkedin = "";
    public $facebook = "";
    public $googleplus = "";
    public $twitter = "";
    public $blog = "";
    public $background = "";

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function save(){

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET 
                    NIC=:nic, 
                    LINKEDIN=:linkedin,
                    FACEBOOK=:facebook,
                    GOOGLEPLUS=:googleplus,
                    TWITTER=:twitter,
                    BLOG=:blog,
                    BACKGROUND=:background";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->linkedin=htmlspecialchars(strip_tags($this->linkedin));
        $this->facebook=htmlspecialchars(strip_tags($this->facebook));
        $this->googleplus=htmlspecialchars(strip_tags($this->googleplus));
        $this->twitter=htmlspecialchars(strip_tags($this->twitter));
        $this->blog=htmlspecialchars(strip_tags($this->blog));
        $this->background=htmlspecialchars(strip_tags($this->background));

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        $stmt->bindParam(":linkedin", $this->linkedin);
        $stmt->bindParam(":facebook", $this->facebook);
        $stmt->bindParam(":googleplus", $this->googleplus);
        $stmt->bindParam(":twitter", $this->twitter);
        $stmt->bindParam(":blog", $this->blog);
        $stmt->bindParam(":background", $this->background);

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
                    linkedin=:linkedin,
                    facebook=:facebook,
                    googleplus=:googlepus,
                    twitter=:twitter,
                    blog=:blog,
                    background=:background
                    WHERE nic=:nic ";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->interests=htmlspecialchars(strip_tags($this->interests));

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        $stmt->bindParam(":linkedin", $this->linkedin);
        $stmt->bindParam(":facebook", $this->facebook);
        $stmt->bindParam(":googleplus", $this->googleplus);
        $stmt->bindParam(":twitter", $this->twitter);
        $stmt->bindParam(":blog", $this->blog);
        $stmt->bindParam(":background", $this->background);

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