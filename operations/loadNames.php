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
include_once '../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate product object
include_once '../objects/Rotaractor.php';
$rotaractorNames = new Rotaractor($db);

$arr = $rotaractorNames->getAllNames();

echo $json_info = json_encode($arr);