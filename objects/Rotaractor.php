<?php

/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/14/2017
 * Time: 11:47 PM
 */
class Rotaractor
{
    // database connection and table name
    private $conn;
    private $table_name = "rotaractor";

    // object properties
    public $no;
    public $club;
    public $name_full;
    public $name_initials;
    public $name_on_card;
    public $name;
    public $gender;
    public $designation;
    public $mobile;
    public $email;
    public $nationality;
    public $nic;
    public $passport_no;
    public $date_of_birth_date;
    public $date_of_birth_month;
    public $date_of_birth_year;
    public $rotaractor_month;
    public $rotaractor_year;
    public $add_no;
    public $add_street;
    public $add_street_2;
    public $add_town;
    public $add_city;
    public $add_state;
    public $add_country;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // get full detail
    function getDetail(){
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

            if ($num == 1)
            {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }

        }else{
            echo "<pre>";
            print_r($stmt->errorInfo());
            echo "</pre>";
            return false;
        }
    }

    function getPeople(){
        $query = "SELECT * FROM " .$this->table_name . " WHERE NAME LIKE :name1 OR NAME_ON_CARD LIKE :name2 " ;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));

        $name1 = ($this->name)."%";
        $name2 = "% ".($this->name)."%";

        // bind values
        $stmt->bindParam(":name1", $name1);
        $stmt->bindParam(":name2", $name2);

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

    function getAllNames(){
        $query = "SELECT NAME_ON_CARD FROM " .$this->table_name . " ORDER BY NAME ASC " ;

        // prepare query
        $stmt = $this->conn->prepare($query);

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
}