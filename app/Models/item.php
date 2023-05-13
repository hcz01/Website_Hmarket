<?php
namespace App\models;

class itemModel{

    private $accountId;
    private $itemId;
    private $defIndex;
    private $paintIndex;
    private $rarity;
    private $quality;
    private $paintSeed;
    private $killEaterScoreType;
    private $killEaterValue;
    private $customName;
    private $stickers;
    private $inventory;
    private $origin;
    private $questId;
    private $dropReason;
    private $musicIndex;
    private $s;
    private $a;
    private $d;
    private $m;
    private $floatValue;
    private $imageUrl;
    private $min;
    private $max;
    private $weaponType;
    private $itemName;
    private $rarityName;
    private $qualityName;
    private $originName;
    private $wearName;
    private $full_item_name;

    /**
     * Get the value of accountId
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set the value of accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get the value of itemId
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set the value of itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get the value of defIndex
     */
    public function getDefIndex()
    {
        return $this->defIndex;
    }

    /**
     * Set the value of defIndex
     */
    public function setDefIndex($defIndex)
    {
        $this->defIndex = $defIndex;

        return $this;
    }

    /**
     * Get the value of paintIndex
     */
    public function getPaintIndex()
    {
        return $this->paintIndex;
    }

    /**
     * Set the value of paintIndex
     */
    public function setPaintIndex($paintIndex)
    {
        $this->paintIndex = $paintIndex;

        return $this;
    }

    /**
     * Get the value of rarity
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * Set the value of rarity
     */
    public function setRarity($rarity)
    {
        $this->rarity = $rarity;

        return $this;
    }

    /**
     * Get the value of quality
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set the value of quality
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Get the value of paintSeed
     */
    public function getPaintSeed()
    {
        return $this->paintSeed;
    }

    /**
     * Set the value of paintSeed
     */
    public function setPaintSeed($paintSeed)
    {
        $this->paintSeed = $paintSeed;

        return $this;
    }

    /**
     * Get the value of killEaterScoreType
     */
    public function getKillEaterScoreType()
    {
        return $this->killEaterScoreType;
    }

    /**
     * Set the value of killEaterScoreType
     */
    public function setKillEaterScoreType($killEaterScoreType)
    {
        $this->killEaterScoreType = $killEaterScoreType;

        return $this;
    }

    /**
     * Get the value of killEaterValue
     */
    public function getKillEaterValue()
    {
        return $this->killEaterValue;
    }

    /**
     * Set the value of killEaterValue
     */
    public function setKillEaterValue($killEaterValue)
    {
        $this->killEaterValue = $killEaterValue;

        return $this;
    }

    /**
     * Get the value of customName
     */
    public function getCustomName()
    {
        return $this->customName;
    }

    /**
     * Set the value of customName
     */
    public function setCustomName($customName)
    {
        $this->customName = $customName;

        return $this;
    }

    /**
     * Get the value of stickers
     */
    public function getStickers()
    {
        return $this->stickers;
    }

    /**
     * Set the value of stickers
     */
    public function setStickers($stickers)
    {
        $this->stickers = $stickers;

        return $this;
    }

    /**
     * Get the value of inventory
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * Set the value of inventory
     */
    public function setInventory($inventory)
    {
        $this->inventory = $inventory;

        return $this;
    }

    /**
     * Get the value of origin
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set the value of origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get the value of questId
     */
    public function getQuestId()
    {
        return $this->questId;
    }

    /**
     * Set the value of questId
     */
    public function setQuestId($questId)
    {
        $this->questId = $questId;

        return $this;
    }

    /**
     * Get the value of dropReason
     */
    public function getDropReason()
    {
        return $this->dropReason;
    }

    /**
     * Set the value of dropReason
     */
    public function setDropReason($dropReason)
    {
        $this->dropReason = $dropReason;

        return $this;
    }

    /**
     * Get the value of musicIndex
     */
    public function getMusicIndex()
    {
        return $this->musicIndex;
    }

    /**
     * Set the value of musicIndex
     */
    public function setMusicIndex($musicIndex)
    {
        $this->musicIndex = $musicIndex;

        return $this;
    }

    /**
     * Get the value of s
     */
    public function getS()
    {
        return $this->s;
    }

    /**
     * Set the value of s
     */
    public function setS($s)
    {
        $this->s = $s;

        return $this;
    }

    /**
     * Get the value of a
     */
    public function getA()
    {
        return $this->a;
    }

    /**
     * Set the value of a
     */
    public function setA($a)
    {
        $this->a = $a;

        return $this;
    }

    /**
     * Get the value of d
     */
    public function getD()
    {
        return $this->d;
    }

    /**
     * Set the value of d
     */
    public function setD($d)
    {
        $this->d = $d;

        return $this;
    }

    /**
     * Get the value of m
     */
    public function getM()
    {
        return $this->m;
    }

    /**
     * Set the value of m
     */
    public function setM($m)
    {
        $this->m = $m;

        return $this;
    }

    /**
     * Get the value of floatValue
     */
    public function getFloatValue()
    {
        return $this->floatValue;
    }

    /**
     * Set the value of floatValue
     */
    public function setFloatValue($floatValue)
    {
        $this->floatValue = $floatValue;

        return $this;
    }

    /**
     * Get the value of imageUrl
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set the value of imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get the value of min
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Set the value of min
     */
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get the value of max
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set the value of max
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get the value of weaponType
     */
    public function getWeaponType()
    {
        return $this->weaponType;
    }

    /**
     * Set the value of weaponType
     */
    public function setWeaponType($weaponType)
    {
        $this->weaponType = $weaponType;

        return $this;
    }

    /**
     * Get the value of itemName
     */
    public function getItemName()
    {
        return $this->itemName;
    }

    /**
     * Set the value of itemName
     */
    public function setItemName($itemName)
    {
        $this->itemName = $itemName;

        return $this;
    }

    /**
     * Get the value of rarityName
     */
    public function getRarityName()
    {
        return $this->rarityName;
    }

    /**
     * Set the value of rarityName
     */
    public function setRarityName($rarityName)
    {
        $this->rarityName = $rarityName;

        return $this;
    }

    /**
     * Get the value of qualityName
     */
    public function getQualityName()
    {
        return $this->qualityName;
    }

    /**
     * Set the value of qualityName
     */
    public function setQualityName($qualityName)
    {
        $this->qualityName = $qualityName;

        return $this;
    }

    /**
     * Get the value of originName
     */
    public function getOriginName()
    {
        return $this->originName;
    }

    /**
     * Set the value of originName
     */
    public function setOriginName($originName)
    {
        $this->originName = $originName;

        return $this;
    }

    /**
     * Get the value of wearName
     */
    public function getWearName()
    {
        return $this->wearName;
    }

    /**
     * Set the value of wearName
     */
    public function setWearName($wearName)
    {
        $this->wearName = $wearName;

        return $this;
    }

    /**
     * Get the value of full_item_name
     */
    public function getFullItemName()
    {
        return $this->full_item_name;
    }

    /**
     * Set the value of full_item_name
     */
    public function setFullItemName($full_item_name)
    {
        $this->full_item_name = $full_item_name;

        return $this;
    }
}
    

?>