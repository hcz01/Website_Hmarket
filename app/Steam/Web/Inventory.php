<?php
namespace app\Steam\Web;
 
class CSGOInventory {
    private $inventoryUrl;
    private $proxy;
    private $port;
    public function __construct($inventoryUrl,$proxy,$port) {
        $this->inventoryUrl = $inventoryUrl;
        $this->proxy = $proxy;
        $this->port = $port;
    }

    public function getInventory() {
        /*
        $proxyUrl = $this->proxy;
        $proxyPort = $this->port;

        $proxyContext = stream_context_create([
            'http' => [
                'proxy' => "tcp://{$proxyUrl}:{$proxyPort}",
                'request_fulluri' => true,
            ],
            'ssl' => [
                'proxy' => "tcp://{$proxyUrl}:{$proxyPort}",
                'request_fulluri' => true,
            ]
        ]);
        */

        $json = file_get_contents($this->inventoryUrl);
        

        if ($json === false) {
            // Handle error here, such as logging or displaying an error message
            return array();
        }
        return $json;


    }

    public function getWeapon($json){
        $inventory = json_decode($json, true);
        
        $weapons = array();
        if($inventory==null)
        {
            return null;
        }
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

            $weapons[] = $description;
        }
        return  json_encode($weapons);
    }
    public function getAllItems($json)
    {
        $inventory = json_decode($json, true);
      
        $items = array();
        if($inventory==null)
        {
            return null;
        }
        $assets=$inventory['assets'];
        $descriptions=$inventory['descriptions'];
        foreach ($assets as $asset) {
            $classid = $asset['classid'];
            foreach ($descriptions as $description) {
                if($description['classid']==$classid)
                {
                    if (isset($description['market_actions']) && isset($description['market_actions'][0]['link'])) {
                        $link = $description['market_actions'][0]['link'];
                    }

                    $item= array(
                        'classid' => $description['classid'] ?? null,
                        'instanceid' => $description['instanceid'] ?? null,
                        'market_name' => $description['market_name'] ?? null,
                        'name' => $description['name'] ?? null,
                        'icon_url' => $description['icon_url'] ?? null,
                        'icon_url_large' => $description['icon_url_large'] ?? null,
                        'link' => $link
                    );
                    $items[]=$item;
                }
            }
        }

        
        return  json_encode($items);
    }
}
/*
$inventoryUrl = "http://steamcommunity.com/inventory/76561199125042505/730/2?l=en&count=1000";
$proxy="65.109.231.55";
$port="8080";

$inventory = new CSGOInventory($inventoryUrl,$proxy,$port);
$result = $inventory->getInventory();
if($result!=null){
$result=json_decode($result,true);
    $output = array();
// Output the result
foreach ($result as $weapon) {
    $weaponData = array(
        'market_name' => $weapon['market_name'],
        'icon_url' => $weapon['icon_url']
    );
    $output[] = $weaponData;
}

$jsonOutput = json_encode($output);

// Output the JSON
echo $jsonOutput;
}else{
    echo "failed";
}
*/
