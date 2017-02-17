<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/28/2017
 * Time: 11:14 AM
 */

// start session
session_start();

// get database connection
include_once '../../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate product object
include_once '../../objects/Work.php';
$work = new Work($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

$work->nic = $data->nic;
$work->id = $data->id;

if($work->delete()){
    echo true;
}

else{
    echo false;
}