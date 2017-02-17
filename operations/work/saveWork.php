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
$work->title = $data->title;
$work->company = $data->company;
$work->date_from = $data->date_from;
$work->date_to = $data->date_to;
$work->address = $data->address;
$work->description = $data->description;

if($work->save()){
    echo true;
}

else{
    echo false;
}