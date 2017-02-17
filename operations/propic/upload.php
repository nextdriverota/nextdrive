<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 2/7/2017
 * Time: 9:06 PM
 */

/*$data = $_POST['image'];

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);

$data = base64_decode($data);
$imageName = time().'.png';
file_put_contents('../../propic/'.$imageName, $data);

echo $data;
echo 'done';*/

$ret = json_decode(file_get_contents("php://input"));

/*$data = $_POST['image'];
$user = $_POST['user'];*/

$data = $ret->image;
$user = $ret->nic;

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);

$data = base64_decode($data);
$imageName = $user.'.png';
file_put_contents('../../propic/'.$imageName, $data);



