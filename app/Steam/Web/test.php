<?php
 namespace App\Steam\web;
 
class CSGOInventory {
    private $inventoryUrl;
    private $apiUrl;

    public function __construct($inventoryUrl, $apiUrl) {
        $this->inventoryUrl = $inventoryUrl;
        $this->apiUrl = $apiUrl;
    }

    public function getInventory() {
        $json = file_get_contents($this->inventoryUrl);
        if ($json === false) {
            // Handle error here, such as logging or displaying an error message
            return array();
        }
        $inventory = json_decode($json, true);

        $weapons = array();

        foreach ($inventory['descriptions'] as $description) {
            $tags = $description['tags'];
 
            // Check if the item is a weapon
            $isWeapon = false;
            foreach ($tags as $tag) {
                if ($tag['category'] === 'Weapon') {
                    $isWeapon = true;
                    break;
                }
            }

            // Skip non-weapon items
            if (!$isWeapon) {
                continue;
            }

            $weaponInfo = $this->fetchWeaponInfo($description);
            $weapons[] =$weaponInfo;
        }

        return $weapons;
    }

    private function fetchWeaponInfo($description) {
       // $marketName = $description['market_hash_name'];
      //  $imageUrl = $description['icon_url'];

        if (array_key_exists('market_actions', $description)) {
            $apiUrl = $this->apiUrl . urlencode( $description['market_actions']['link']);
            $json = file_get_contents($apiUrl);
            $additionalInfo = json_decode($json, true);
            $weaponInfo = array(
                'market_name' => $additionalInfo['iteminfo']['full_item_name'],
                'image_url' => $additionalInfo['iteminfo']['imageurl'],
                'additional_info' => $additionalInfo
            );
        } 

        

        return $weaponInfo;
    }

  
}

// Usage example
$inventoryUrl = "https://steamcommunity.com/inventory/76561199125042505/730/2?l=en&count=1000";
$apiUrl = "https://api.csgofloat.com/?url=";

$inventory = new CSGOInventory($inventoryUrl, $apiUrl);
$result = $inventory->getInventory();
$output = array();
// Output the result
foreach ($result as $weapon) {
    $weaponData = array(
        'market_name' => $weapon['market_name'],
        'image_url' => $weapon['icon_url']
    );
    $output[] = $weaponData;
}
$jsonOutput = json_encode($output);

// Output the JSON
echo $jsonOutput;
