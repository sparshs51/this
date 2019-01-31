<?php
include ("./inc/connect.inc.php");
session_start();
if (isset($_SESSION["user_login"])) {
 $user = @$_SESSION["user_login"];
 echo $user;
}
else
{
   	
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

  <link rel="stylesheet" href="fontawesome.css">
  <link href="https://fonts.googleapis.com/css?family=Hi+Melody" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
    <script src="https://twemoji.maxcdn.com/twemoji.min.js"></script>

    

