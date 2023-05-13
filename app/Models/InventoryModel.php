<?php
namespace App\models;
class Steam_Inventory {
    private $assets;
    private $descriptions;
    private $total_inventory_count;
    private $success;
    private $rwgrsn;

    public function getAssets() {
        return $this->assets;
    }
/*
    public function setAssets($appid, $contextid, $assetid, $classid, $instanceid, $amount) {
        $this->assets =new Asset($appid, $contextid, $assetid, $classid, $instanceid, $amount);
    }
    */
    public function setAssets($assets) {
        $this->assets =$assets;
    }

    public function getDescriptions() {
        return $this->descriptions;
    }
/*
    public function setDescriptions($appid,$classid,$instanceid,$currency, $background_color,$icon_url,$icon_url_large,$tradable,$Action_link,$Action_name,$name,$name_color,$type,$market_name,$market_hash_name,$market_actions,$commodity,$market_tradable_restriction,$marketable,$market_buy_country_restriction) {
        $this->descriptions = new DescriptionDescription($appid,$classid,$instanceid,$currency, $background_color,$icon_url,$icon_url_large,$tradable,$Action_link,$Action_name,$name,$name_color,$type,$market_name,$market_hash_name,$market_actions,$commodity,$market_tradable_restriction,$marketable,$market_buy_country_restriction);
    }
    */

    public function setDescriptions($descriptions) {
        $this->descriptions = $descriptions;
    }

    public function getTotalInventoryCount() {
        return $this->total_inventory_count;
    }

    public function setTotalInventoryCount($total_inventory_count) {
        $this->total_inventory_count = $total_inventory_count;
    }

    public function getSuccess() {
        return $this->success;
    }

    public function setSuccess($success) {
        $this->success = $success;
    }

    public function getRwgrsn() {
        return $this->rwgrsn;
    }

    public function setRwgrsn($rwgrsn) {
        $this->rwgrsn = $rwgrsn;
    }
}

class Asset {
    private $appid;
    private $contextid;
    private $assetid;
    private $classid;
    private $instanceid;
    private $amount;

    public function __construct($appid, $contextid, $assetid, $classid, $instanceid, $amount) {
        $this->appid = $appid;
        $this->contextid = $contextid;
        $this->assetid = $assetid;
        $this->classid = $classid;
        $this->instanceid = $instanceid;
        $this->amount = $amount;
    }
    
    
    public function getAppid() {
        return $this->appid;
    }

    public function setAppid($appid) {
        $this->appid = $appid;
    }

    public function getContextid() {
        return $this->contextid;
    }

    public function setContextid($contextid) {
        $this->contextid = $contextid;
    }

    public function getAssetid() {
        return $this->assetid;
    }

    public function setAssetid($assetid) {
        $this->assetid = $assetid;
    }

    public function getClassid() {
        return $this->classid;
    }

    public function setClassid($classid) {
        $this->classid = $classid;
    }

    public function getInstanceid() {
        return $this->instanceid;
    }

    public function setInstanceid($instanceid) {
        $this->instanceid = $instanceid;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }
}

class InventoryDescription {
    private $appid;
    private $classid;
    private $instanceid;
    private $currency;
    private $background_color;
    private $icon_url;
    private $icon_url_large;
    private $descriptions;
    private $tradable;
    private $actions;
    private $name;
    private $name_color;
    private $type;
    private $market_name;
    private $market_hash_name;
    private $market_actions;
    private $commodity;
    private $market_tradable_restriction;
    private $marketable;
    private $tags;
    private $market_buy_country_restriction;

    //$des_type, $des_value, $des_color use for class DescriptionDescription()
    //$Action_link,$Action_name use for class Action()
    //
    public function __construct($appid,$classid,$instanceid,$currency, $background_color,$icon_url,$icon_url_large,$tradable,$Action_link,$Action_name,$name,$name_color,$type,$market_name,$market_hash_name,$market_actions,$commodity,$market_tradable_restriction,$marketable,$market_buy_country_restriction
    ) {
        $this->appid = $appid;
        $this->classid = $classid;
        $this->instanceid = $instanceid;
        $this->currency = $currency;
        $this->background_color = $background_color;
        $this->icon_url = $icon_url;
        $this->icon_url_large = $icon_url_large;
        $this->tradable = $tradable;
        $this->actions = new Action($Action_link,$Action_name);
        $this->name = $name;
        $this->name_color = $name_color;
        $this->type = $type;
        $this->market_name = $market_name;
        $this->market_hash_name = $market_hash_name;
        $this->market_actions = $market_actions;
        $this->commodity = $commodity;
        $this->market_tradable_restriction = $market_tradable_restriction;
        $this->marketable = $marketable;
        $this->market_buy_country_restriction = $market_buy_country_restriction;
    }
    
    public function getAppid(){
		return $this->appid;
	}

	public function setAppid($appid){
		$this->appid = $appid;
	}

	public function getClassid(){
		return $this->classid;
	}

	public function setClassid($classid){
		$this->classid = $classid;
	}

	public function getInstanceid(){
		return $this->instanceid;
	}

	public function setInstanceid($instanceid){
		$this->instanceid = $instanceid;
	}

	public function getCurrency(){
		return $this->currency;
	}

	public function setCurrency($currency){
		$this->currency = $currency;
	}

	public function getBackground_color(){
		return $this->background_color;
	}

	public function setBackground_color($background_color){
		$this->background_color = $background_color;
	}

	public function getIcon_url(){
		return $this->icon_url;
	}

	public function setIcon_url($icon_url){
		$this->icon_url = $icon_url;
	}

	public function getIcon_url_large(){
		return $this->icon_url_large;
	}

	public function setIcon_url_large($icon_url_large){
		$this->icon_url_large = $icon_url_large;
	}

	public function getDescriptions(){
		return $this->descriptions;
	}

	public function setDescriptions($descriptions){
		$this->descriptions = $descriptions;
	}

	public function getTradable(){
		return $this->tradable;
	}

	public function setTradable($tradable){
		$this->tradable = $tradable;
	}

	public function getActions(){
		return $this->actions;
	}

	public function setActions($actions){
		$this->actions = $actions;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getName_color(){
		return $this->name_color;
	}

	public function setName_color($name_color){
		$this->name_color = $name_color;
	}

	public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function getMarket_name(){
		return $this->market_name;
	}

	public function setMarket_name($market_name){
		$this->market_name = $market_name;
	}

	public function getMarket_hash_name(){
		return $this->market_hash_name;
	}

	public function setMarket_hash_name($market_hash_name){
		$this->market_hash_name = $market_hash_name;
	}

	public function getMarket_actions(){
		return $this->market_actions;
	}

	public function setMarket_actions($market_actions){
		$this->market_actions = $market_actions;
	}

	public function getCommodity(){
		return $this->commodity;
	}

	public function setCommodity($commodity){
		$this->commodity = $commodity;
	}

	public function getMarket_tradable_restriction(){
		return $this->market_tradable_restriction;
	}

	public function setMarket_tradable_restriction($market_tradable_restriction){
		$this->market_tradable_restriction = $market_tradable_restriction;
	}

	public function getMarketable(){
		return $this->marketable;
	}

	public function setMarketable($marketable){
		$this->marketable = $marketable;
	}

	public function getTags(){
		return $this->tags;
	}

	public function setTags($tags){
		$this->tags = $tags;
	}

	public function getMarket_buy_country_restriction(){
		return $this->market_buy_country_restriction;
	}

	public function setMarket_buy_country_restriction($market_buy_country_restriction){
		$this->market_buy_country_restriction = $market_buy_country_restriction;
	}

 

  

   
}
class Action {
    private $link;
    private $name;
    public function __construct($link,$name) {
        $this->link = $link;
        $this->name = $name;
    }
    public function getLink(){
		return $this->link;
	}

	public function setLink($link){
		$this->link = $link;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}
}
class DescriptionDescription {
    private $type;
    private $value;
    private $color;
    
    public function __construct($type, $value, $color) {
        $this->type = $type;
        $this->value = $value;
        $this->color = $color;
    }
   
    public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function getValue(){
		return $this->value;
	}

	public function setValue($value){
		$this->value = $value;
	}

	public function getColor(){
		return $this->color;
	}

	public function setColor($color){
		$this->color = $color;
	}
}


class Tag {
    private $category;
    private $internal_name;
    private $localized_category_name;
    private $localized_tag_name;
    private $color;

    public function __construct($category, $internal_name, $localized_category_name, $localized_tag_name, $color) {
        $this->category = $category;
        $this->internal_name = $internal_name;
        $this->localized_category_name = $localized_category_name;
        $this->localized_tag_name = $localized_tag_name;
        $this->color = $color;
    }
    
    
    public function getCategory(){
		return $this->category;
	}

	public function setCategory($category){
		$this->category = $category;
	}

	public function getInternal_name(){
		return $this->internal_name;
	}

	public function setInternal_name($internal_name){
		$this->internal_name = $internal_name;
	}

	public function getLocalized_category_name(){
		return $this->localized_category_name;
	}

	public function setLocalized_category_name($localized_category_name){
		$this->localized_category_name = $localized_category_name;
	}

	public function getLocalized_tag_name(){
		return $this->localized_tag_name;
	}

	public function setLocalized_tag_name($localized_tag_name){
		$this->localized_tag_name = $localized_tag_name;
	}

	public function getColor(){
		return $this->color;
	}

	public function setColor($color){
		$this->color = $color;
	}
  }

class ParsedItem {
    private $Type;
    private $MarketName;
    private $MarketHashName;
    private $Marketable;
    private $Exterior;
    private $ItemSet;
    private $Quality;
    private $Rarity;
    private $Weapon;
    private $AveragePrice;
    private $MedianPrice;
    private $LowestPrice;
    private $HighestPrice;
    private $Currency;
    private $StandardDeviation;
    private $Volume;

    public function __construct($type, $marketName, $marketHashName, $marketable, $exterior, $itemSet, $quality, $rarity, $weapon, $averagePrice, $medianPrice, $lowestPrice, $highestPrice, $currency, $standardDeviation, $volume) {
        $this->Type = $type;
        $this->MarketName = $marketName;
        $this->MarketHashName = $marketHashName;
        $this->Marketable = $marketable;
        $this->Exterior = $exterior;
        $this->ItemSet = $itemSet;
        $this->Quality = $quality;
        $this->Rarity = $rarity;
        $this->Weapon = $weapon;
        $this->AveragePrice = $averagePrice;
        $this->MedianPrice = $medianPrice;
        $this->LowestPrice = $lowestPrice;
        $this->HighestPrice = $highestPrice;
        $this->Currency = $currency;
        $this->StandardDeviation = $standardDeviation;
        $this->Volume = $volume;
    }

    public function getType(){
		return $this->Type;
	}

	public function setType($Type){
		$this->Type = $Type;
	}

	public function getMarketName(){
		return $this->MarketName;
	}

	public function setMarketName($MarketName){
		$this->MarketName = $MarketName;
	}

	public function getMarketHashName(){
		return $this->MarketHashName;
	}

	public function setMarketHashName($MarketHashName){
		$this->MarketHashName = $MarketHashName;
	}

	public function getMarketable(){
		return $this->Marketable;
	}

	public function setMarketable($Marketable){
		$this->Marketable = $Marketable;
	}

	public function getExterior(){
		return $this->Exterior;
	}

	public function setExterior($Exterior){
		$this->Exterior = $Exterior;
	}

	public function getItemSet(){
		return $this->ItemSet;
	}

	public function setItemSet($ItemSet){
		$this->ItemSet = $ItemSet;
	}

	public function getQuality(){
		return $this->Quality;
	}

	public function setQuality($Quality){
		$this->Quality = $Quality;
	}

	public function getRarity(){
		return $this->Rarity;
	}

	public function setRarity($Rarity){
		$this->Rarity = $Rarity;
	}

	public function getWeapon(){
		return $this->Weapon;
	}

	public function setWeapon($Weapon){
		$this->Weapon = $Weapon;
	}

	public function getAveragePrice(){
		return $this->AveragePrice;
	}

	public function setAveragePrice($AveragePrice){
		$this->AveragePrice = $AveragePrice;
	}

	public function getMedianPrice(){
		return $this->MedianPrice;
	}

	public function setMedianPrice($MedianPrice){
		$this->MedianPrice = $MedianPrice;
	}

	public function getLowestPrice(){
		return $this->LowestPrice;
	}

	public function setLowestPrice($LowestPrice){
		$this->LowestPrice = $LowestPrice;
	}

	public function getHighestPrice(){
		return $this->HighestPrice;
	}

	public function setHighestPrice($HighestPrice){
		$this->HighestPrice = $HighestPrice;
	}

	public function getCurrency(){
		return $this->Currency;
	}

	public function setCurrency($Currency){
		$this->Currency = $Currency;
	}

	public function getStandardDeviation(){
		return $this->StandardDeviation;
	}

	public function setStandardDeviation($StandardDeviation){
		$this->StandardDeviation = $StandardDeviation;
	}

	public function getVolume(){
		return $this->Volume;
	}

	public function setVolume($Volume){
		$this->Volume = $Volume;
	}
  }
  
class PriceData {
    private $success;
    private $average_price;
    private $median_price;
    private $amount_sold;
    private $standard_deviation;
    private $lowest_price;
    private $highest_price;
    private $first_sale_date;
    private $time;
    private $currency;

    public function getSuccess(){
		return $this->success;
	}

	public function setSuccess($success){
		$this->success = $success;
	}

	public function getAverage_price(){
		return $this->average_price;
	}

	public function setAverage_price($average_price){
		$this->average_price = $average_price;
	}

	public function getMedian_price(){
		return $this->median_price;
	}

	public function setMedian_price($median_price){
		$this->median_price = $median_price;
	}

	public function getAmount_sold(){
		return $this->amount_sold;
	}

	public function setAmount_sold($amount_sold){
		$this->amount_sold = $amount_sold;
	}

	public function getStandard_deviation(){
		return $this->standard_deviation;
	}

	public function setStandard_deviation($standard_deviation){
		$this->standard_deviation = $standard_deviation;
	}

	public function getLowest_price(){
		return $this->lowest_price;
	}

	public function setLowest_price($lowest_price){
		$this->lowest_price = $lowest_price;
	}

	public function getHighest_price(){
		return $this->highest_price;
	}

	public function setHighest_price($highest_price){
		$this->highest_price = $highest_price;
	}

	public function getFirst_sale_date(){
		return $this->first_sale_date;
	}

	public function setFirst_sale_date($first_sale_date){
		$this->first_sale_date = $first_sale_date;
	}

	public function getTime(){
		return $this->time;
	}

	public function setTime($time){
		$this->time = $time;
	}

	public function getCurrency(){
		return $this->currency;
	}

	public function setCurrency($currency){
		$this->currency = $currency;
	}
  }
?>