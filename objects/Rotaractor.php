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
    private $links_table = "links";

    // object properties
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
        $query = "SELECT rt.CLUB,rt.NAME_ON_CARD,rt.GENDER,rt.MOBILE,rt.EMAIL,rt.NIC,rt.DATE_OF_BIRTH_YEAR,rt.ADD_CITY,lk.BACKGROUND "
              ."FROM " .$this->table_name . " rt LEFT JOIN " .$this->links_table . " lk ON rt.NIC = lk.NIC WHERE rt.NIC IN (SELECT NIC FROM rotaractor WHERE NAME_ON_CARD LIKE :name2 OR NAME_ON_CARD LIKE :name3);" ;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));

        $name2 = "% ".($this->name)."%";
        $name3 = ($this->name)."%";

        // bind values
        $stmt->bindParam(":name2", $name2);
        $stmt->bindParam(":name3", $name3);

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
        $query = "SELECT NAME_ON_CARD, NIC FROM " .$this->table_name . " ORDER BY NAME ASC " ;

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

    function getFullDetail(){
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
}