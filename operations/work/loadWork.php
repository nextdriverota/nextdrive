<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/28/2017
 * Time: 2:37 PM
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

$arr = $work->load();

echo $json_info = json_encode($arr);