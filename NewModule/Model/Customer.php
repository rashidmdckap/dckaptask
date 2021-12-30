<?php

namespace DCKAP\NewModule\Model;

use DCKAP\NewModule\Api\Data\CustomerInterface;

class Customer extends \Magento\Framework\Model\AbstractModel implements CustomerInterface
{
    const CACHE_TAG = 'dckap_newmodules';

    protected $_cacheTag = 'dckap_newmodules';

    protected $_eventPrefix = 'dckap_newmodules';

    protected function _construct()
    {
        $this->_init('DCKAP\NewModule\Model\ResourceModel\Customer');
    }

    public function getentity_id()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setentity_id($entity_id)
    {
        return $this->setData(self::ENTITY_ID, $entity_id);
    }

    public function getcustom_name()
    {
        return $this->getData(self::CUSTOM_NAME);
    }

    public function setcustom_name($custom_name)
    {
        return $this->setData(self::CUSTOM_NAME, $custom_name);
    }

    public function getcustom_age()
    {
        return $this->getData(self::CUSTOM_AGE);
    }

    public function setcustom_age($custom_age)
    {
        return $this->setData(self::CUSTOM_AGE, $custom_age);
    }

    public function getcustom_dob()
    {
        return $this->getData(self::CUSTOM_DOB);
    }

    public function setcustom_dob($custom_dob)
    {
        return $this->setData(self::CUSTOM_DOB, $custom_dob);
    }

    public function getcustom_country()
    {
        return $this->getData(self::CUSTOM_COUNTRY);
    }

    public function setcustom_country($custom_country)
    {
        return $this->setData(self::CUSTOM_COUNTRY, $custom_country);
    }


}
