<?php

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
 