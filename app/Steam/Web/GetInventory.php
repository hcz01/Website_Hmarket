<?php 
 
 namespace App\Steam\web;
 use app\Controller\HanderDatabase;
 include "Inventory.php";
 require_once(__DIR__ . "/../../../vendor/autoload.php");
// Usage example
//1. GetProxy()  GetInventoryUrl() from handerdatabase 
//2. getInventory() from CSGOInventory;
$Data = new HanderDatabase();
$steamid=$Data->getSTEAMID(1);
$inventoryUrl = "https://steamcommunity.com/inventory/" . $steamid . "/730/2?l=en&count=1000";
$proxyData = $Data->GetProxy();
$JsonData = json_decode($proxyData);
$proxy = $JsonData[0]->ip;
$port = $JsonData[0]->port;

$inventory = new CSGOInventory($inventoryUrl,$proxy,$port);
$result = $inventory->getAllItems($inventory->getInventory());
if($result!=null){
$result=json_decode($result,true);
    $output = array();
// Output the result 
foreach ($result as $item) {
   if (isset($item['market_actions']) && isset($item['market_actions'][0]['link'])) {
      $link = $item['market_actions'][0]['link'];
  }
    $items = array(
      'classid' => $item['classid'] ?? null,
      'instanceid' => $item['instanceid'] ?? null,
      'market_name' => $item['market_name'] ?? null,
      'name' => $item['name'] ?? null,
      'icon_url' => $item['icon_url'] ?? null,
      'icon_url_large' => $item['icon_url_large'] ?? null,
      'link' => $link
    );
    $output[] = $items;
}

$jsonOutput = json_encode($output);

// Output the JSON
echo $jsonOutput;
}else{
    echo "failed";
}
?>


