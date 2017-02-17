<?php
/**
 * Created by PhpStorm.
 * User: Prasanna
 * Date: 1/14/2017
 * Time: 11:58 PM
 */
// start session
session_start();
?>
<!DOCTYPE html>
<html ng-app="rotaApp">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NextDrive</title>

    <!-- include material design CSS -->
    <link rel="stylesheet" href="libs/css/materialize-0.97.8/css/materialize.min.css" />

    <!-- include custom CSS -->
    <link rel="stylesheet" href="libs/css/style.css" />
    <link rel="stylesheet" href="libs/css/responsive.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="libs/css/croppie.css" />

    <!-- include material design icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
    <link rel="manifest" href="images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="rgba(0,0,0,0)">
    <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="rgba(0,0,0,0)">

</head>
<body ng-controller="appController">

<!-- page content and controls will be here -->

<!-- include jquery -->
<script type="text/javascript" src="libs/js/jquery-3.1.1.min.js"></script>

<!-- other javascript libs -->
<script type="text/javascript" src="libs/js/croppie.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

<!-- material design js -->
<script src="libs/css/materialize-0.97.8/js/materialize.min.js"></script>

<!-- include angular js -->
<script src="libs/js/angular.min.js"></script>
<script src="libs/js/angular-route.min.js"></script>
<script src="libs/js/angular-animate.min.js"></script>
<script src="angular/app.js"></script>
<script src="angular/fileUploadService.js"></script>
<script src="angular/appController.js"></script>
<script src="angular/loginController.js"></script>
<script src="angular/registerController.js"></script>
<script src="angular/dashboardController.js"></script>

<script>
// angular js codes will be here

// jquery codes will be here
    $(document).ready(function(){
        // initialize modal
        $('.modal').modal();
    });
</script>
<div class="darker"></div>
<div class="container fullheight login-cont">
    <div class="row fullheight" ng-view>
        {{ message }}
    </div> <!-- end row -->
</div> <!-- end container -->

</body>
</html>