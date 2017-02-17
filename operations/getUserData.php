<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/15/2017
 * Time: 11:49 AM
 */

// start session
session_start();

if (isset($_SESSION['userSession'])!="") {
    echo json_encode($_SESSION['userSession']);
}
else
    echo null;