<?php

/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/14/2017
 * Time: 11:46 PM
 */
class RotaractUser
{
    // database connection and table name
    private $conn;
    private $table_name = "rotaract_user";

    // object properties
    public $nic;
    public $password;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // create product
    function register(){

        // query to insert record
        $query = "INSERT INTO 
                " . $this->table_name . "
            SET 
                nic=:nic, password=:password";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->password=password_hash($this->password, PASSWORD_DEFAULT);

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        $stmt->bindParam(":password", $this->password);

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

    //search for login
    function search(){
        $query = "SELECT * FROM " .$this->table_name . " WHERE NIC = :nic " ;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->password=htmlspecialchars(strip_tags($this->password));

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        //$stmt->bindParam(":password", $this->password);

        // execute query
        if($stmt->execute()){

            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $num = $stmt->rowCount();
            if ($num == 1)
            {
                if (password_verify($this->password, $row['PASSWORD']))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }

        }else{
            echo "<pre>";
            print_r($stmt->errorInfo());
            echo "</pre>";
            return false;
        }
    }
}