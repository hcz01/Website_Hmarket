<?php
namespace app\Controller;

class CSGOInventory {
    private $inventoryUrl;
   // private $proxy;
   // private $port;
    public function __construct($inventoryUrl) {
        $this->inventoryUrl = $inventoryUrl;
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

        try {
            $json = @file_get_contents($this->inventoryUrl);
        
            if ($json === false) {
                return null;
            }
        
            return $json;

        } catch (\Exception $e) {
            // Handle the exception when the "HTTP 429 Too Many Requests" error occurs
            return null;
        }
      


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
                        'asset'=> $asset['classid'] ?? null,
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


