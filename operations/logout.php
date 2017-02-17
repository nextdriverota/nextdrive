<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/15/2017
 * Time: 9:07 PM
 */

// start session
session_start();

if (isset($_SESSION['userSession'])!="")
{
    session_destroy();
    unset($_SESSION['userSession']);
}
if (!isset($_SESSION['userSession']))
{
    echo true;
}
else
    echo "logout fail";
