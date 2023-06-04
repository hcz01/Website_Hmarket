<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=ù, initial-scale=1.0">
    <title>Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="css/home.css">
    <script src="js/index.js"></script>
</head>
<body>
<div id ="header">
<?php 
include 'components/nav.php'; 
include 'components/nav-1_ano.php'; 
?>
</div>


<div class="l_Layout">
<?php 
include 'components/market-search.php';
include 'components/search.php';
include 'components/Random_Market.php';
?>
</div>
<?php 
include 'components/info.php';
include 'components/login.php' 
?>
</div>
</body>