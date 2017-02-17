<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/15/2017
 * Time: 6:17 PM
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
$user->password =$data->password;

if($user->search())
{
    $_SESSION['userSession'] = $user->nic;
    echo "true";
}
else
{
    echo "false";
}
