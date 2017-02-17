<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 2/6/2017
 * Time: 10:39 PM
 */

// start session
session_start();
// get database connection
include_once '../../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate object
include_once '../../objects/CVmap.php';
$cv_map = new CVmap($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set user property values
$cv_map->nic = $data->nic;

$path = $cv_map->search();

if ($path != null)
{
    if (unlink($path))
    {
        if ($cv_map->delete())
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }
}
else
{
    return true;
}




