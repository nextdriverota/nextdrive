<?php

/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/28/2017
 * Time: 10:06 PM
 */
class Education
{
    // database connection and table name
    private $conn;
    private $table_name = "education";

    // object properties
    public $nic;
    public $id;
    public $institute;
    public $degree;
    public $field;
    public $date_from;
    public $date_to;
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
                    institute=:institute,
                    degree=:degree,
                    field=:field,
                    date_from=:date_from,
                    date_to=:date_to,
                    description=:description";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->institute=htmlspecialchars(strip_tags($this->institute));
        $this->degree=htmlspecialchars(strip_tags($this->degree));
        $this->field=htmlspecialchars(strip_tags($this->field));
        $this->date_from=htmlspecialchars(strip_tags($this->date_from));
        $this->date_to=htmlspecialchars(strip_tags($this->date_to));
        $this->description=htmlspecialchars(strip_tags($this->description));

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":institute", $this->institute);
        $stmt->bindParam(":degree", $this->degree);
        $stmt->bindParam(":field", $this->field);
        $stmt->bindParam(":date_from", $this->date_from);
        $stmt->bindParam(":date_to", $this->date_to);
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
                    institute=:institute,
                    degree=:degree,
                    field=:field,
                    date_from=:date_from,
                    date_to=:date_to,
                    description=:description
                    WHERE nic=:nic AND id=:id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->institute=htmlspecialchars(strip_tags($this->institute));
        $this->degree=htmlspecialchars(strip_tags($this->degree));
        $this->field=htmlspecialchars(strip_tags($this->field));
        $this->date_from=htmlspecialchars(strip_tags($this->date_from));
        $this->date_to=htmlspecialchars(strip_tags($this->date_to));
        $this->description=htmlspecialchars(strip_tags($this->description));

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":institute", $this->institute);
        $stmt->bindParam(":degree", $this->degree);
        $stmt->bindParam(":field", $this->field);
        $stmt->bindParam(":date_from", $this->date_from);
        $stmt->bindParam(":date_to", $this->date_to);
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
        $query = "DELETE FROM " .$this->table_name . " WHERE NIC = :nic AND ID = :id" ;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nic=htmlspecialchars(strip_tags($this->nic));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind values
        $stmt->bindParam(":nic", $this->nic);
        $stmt->bindParam(":id", $this->id);

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