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
include_once '../../objects/Interests.php';
$interests = new Interests($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

$interests->nic = $data->nic;
$interests->interests = $data->interests;

if($interests->save()){
    echo true;
}
else{
    echo false;
}