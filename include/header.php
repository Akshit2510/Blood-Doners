<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blood Donor</title>
    <link rel="shortcut icon" href="images/fav.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/fav.jpg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawsom-all.min.css">
    <link rel="stylesheet" href="plugins/grid-gallery/css/grid-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<?php 
    include 'config.php';    
    session_start();
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
    {
        include 'usernav.php';
    }
    else
    {
        include 'navigation.php';    
    }  
?>