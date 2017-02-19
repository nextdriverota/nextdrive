<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/15/2017
 * Time: 11:25 PM
 */

// start session
session_start();

// get database connection
include_once '../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate product object
include_once '../objects/Rotaractor.php';
$rtr = new Rotaractor($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set rtr property values
$rtr->nic = $data->nic;

// initialize data
$data="";

// get data row
$row = $rtr->getDetail();

$data .= '{';
$data .= '"club":"'  . $row['CLUB'] . '",';
$data .= '"name_full":"' . $row['NAME_FULL'] . '",';
$data .= '"name_initials":"' . $row['NAME_INITIALS'] . '",';
$data .= '"name_on_card":"' . $row['NAME_ON_CARD'] . '",';
$data .= '"name":"' . $row['NAME'] . '",';
$data .= '"gender":"' . $row['GENDER'] . '",';
$data .= '"designation":"' . $row['DESIGNATION'] . '",';
$data .= '"mobile":"' . $row['MOBILE'] . '",';
$data .= '"email":"' . $row['EMAIL'] . '",';
$data .= '"nationality":"' . $row['NATIONALITY'] . '",';
$data .= '"nic":"' . $row['NIC'] . '",';
$data .= '"passport":"' . $row['PASSPORT_NO'] . '",';
$data .= '"date_of_birth":"' . $row['DATE_OF_BIRTH_DATE'] . '-' . $row['DATE_OF_BIRTH_MONTH'] . '-' . $row['DATE_OF_BIRTH_YEAR'] . '",';
$data .= '"rotaractor_from":"' . $row['ROTARACTOR_MONTH'] . '-' . $row['ROTARACTOR_YEAR'] . '",';
$data .= '"address":"' . $row['ADD_NO'] . ', ' . $row['ADD_STREET'] . ', ' . $row['ADD_STREET_2'] . ', ' . $row['ADD_TOWN'] . ', ' . $row['ADD_CITY'] . ', ' . $row['ADD_STATE'] . ', ' . $row['ADD_COUNTRY'] . '",';
$data .= '"country":"' . $row['ADD_COUNTRY'] . '"';
$data .= '}';

echo $data;

