<?php

class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;

    /**
     * PremiumMember constructor.
     * @param $_inDoorInterests
     * @param $_outDoorInterests
     */
    public function __construct($_inDoorInterests="No Indoor Interests", $_outDoorInterests="No Outdoor Interests")
    {
        parent::__construct($this->getFname(), $this->getLname(), $this->getAge(),
            $this->getGender(), $this->getPhone());
        $this->_inDoorInterests = $_inDoorInterests;
        $this->_outDoorInterests = $_outDoorInterests;
    }

    /**
     * Grabs an array of indoor interests
     * @return Array the person's indoor interests
     */
    public function getInDoorInterests() : Array
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param mixed $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests): void
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * Grabs an array of outdoor interests
     * @return Array the person's outdoor interests
     */
    public function getOutDoorInterests() : Array
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param mixed $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests): void
    {
        $this->_outDoorInterests = $outDoorInterests;
    }

}