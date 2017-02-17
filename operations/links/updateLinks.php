<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 2/1/2017
 * Time: 12:06 AM
 */


// start session
session_start();

// get database connection
include_once '../../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate product object
include_once '../../objects/Links.php';
$links = new Links($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

$links->nic = $data->nic;
$links->linkedin = $data->linkedin;
$links->facebook = $data->facebook;
$links->googleplus = $data->googleplus;
$links->twitter = $data->twitter;
$links->blog = $data->blog;
$links->background = $data->background;

if($links->update()){
    echo true;
}
else{
    echo false;
}