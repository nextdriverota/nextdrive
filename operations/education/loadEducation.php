<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/28/2017
 * Time: 10:14 PM
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

$arr = $education->load();

echo $json_info = json_encode($arr);