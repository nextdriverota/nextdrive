<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/15/2017
 * Time: 1:05 PM
 */

// start session
session_start();

// get database connection
include_once '../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate product object
include_once '../objects/RotaractUser.php';
$user = new RotaractUser($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set user property values
$user->nic = $data->nic;
$user->password = $data->password;

// register the user
if($user->register()){
    echo "User was registered.";
}

// if unable to register the user, tell the user
else{
    echo "Unable to register user.";
}