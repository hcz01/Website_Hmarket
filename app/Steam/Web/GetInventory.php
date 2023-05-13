<?php 
 
 //namespace App\Steam\web;
 use app\models\itemModel;
 use app\models\InventoryModel;
 
//https://steamcommunity.com/inventory/76561199125042505/730/2?l=en&count=1000
 class Inventory{
   private $API="https://api.csgofloat.com/?url=";
    public function GetInventory(){
    
        header("Content-Type: application/json");
        $json = file_get_contents("https://steamcommunity.com/inventory/76561199125042505/730/2?l=en&count=1000");
        $obj = json_decode($json,true);
        $descriptions=$obj["descriptions"];
        $count=$obj["total_inventory_count"];
        echo $count;
        /*
        if($count>0)
           {
            foreach ($descriptions as $description) {
               array_push($steam_link, $description["market_actions"]["link"]);
            }
            return $steam_link; 
    }
    */
    return null;
   

 }

   public function GetItemsInfo($links){
         $items=array();
         foreach($links as $link){
         $url=$this->API . $link;
            $json = file_get_contents($url);
            $data = json_decode($json,true);
            

         }
      
 }
}

?>