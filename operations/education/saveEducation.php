<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/28/2017
 * Time: 10:15 PM
 */

// start session
session_start();

// get database connection
include_once '../../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate product object
include_once '../../objects/Education.php';
$education = new Education($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

$education->nic = $data->nic;
$education->id = $data->id;
$education->institute = $data->institute;
$education->degree = $data->degree;
$education->field = $data->field;
$education->date_from = $data->date_from;
$education->date_to = $data->date_to;
$education->description = $data->description;

if($education->save()){
    echo true;
}

else{
    echo false;
}