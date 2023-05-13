<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=ù, initial-scale=1.0">
    <title>steam inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/Inventory.css">
    <script src="./js/InventoryJS.js"></script>
</head>
<body>
<?php 
session_start();  
$username = $_SESSION['userData']['username'];
$id = $_SESSION['userData']['id'];

?>
<div id ="header">
    <div id="logo"><img src="./background/Hmarket.png" width="77" height="21"> </div> 
    <div id="nav"> <ul>
        <li>Home</li>
        <li>Market</li>
        <li>News</li>
    </ul></div>
    <div id="nav-1">
        <ul>
        <li><div> <?php echo $username;?> </div> </li>
        </ul>
    </div>
</div>
    
<div id="market-header black">
</div>

<div id="block-header black"> 
    <div id="left"></div>
    <div id="right">
        <button onclick="">refresh</button>
    </div>
</div>
<div id="detail-tab-item">
    <div id="market-cards"></div>
    <div id="card-pager"></div>
</div>


<div id="Info">
    <div id="guide">
    <div class="info-section" id="accountSetting">
        <ul>
            <li>Steam Setting</li>
        </ul>
    </div>
    <div class="info-section" id="WalletIssues">
        <ul>
            <li>Charging standards</li>
        </ul>
    </div>
    <div class="info-section" id="FAQ">
        <ul>
            <li>Buyers FAQ</li>
            <li>Seller FAQ</li>
            <li>Unable to trade</li>
        </ul>
    </div>
    <div class="info-section" id="Payment">
        <ul>
            <li>Alipay</li>
            <li>BotCoin</li>
            <li>Bank card payment</li>
        </ul>
    </div>
</div>
</div>

</div>
<div id="Button"> The web site is a example for a simple simulation trade skin of CSGO </div>
</body>
</html>