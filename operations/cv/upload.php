<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 2/1/2017
 * Time: 11:28 PM
 */

$target_dir = "../../cv/";
$name = $_POST['name'];
$target_file = $target_dir .$name."_". basename($_FILES["file"]["name"]);

move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

// start session
session_start();

// get database connection
include_once '../../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate object
include_once '../../objects/CVmap.php';
$cv_map = new CVmap($db);

// set user property values
$cv_map->nic = $name;
$folder="../cv/".$name."_". basename($_FILES["file"]["name"]);
$cv_map->path = $folder;

$file = $data->file;

if($cv_map->upload())
{
    echo "true";
}
else
{
    echo "false";
}