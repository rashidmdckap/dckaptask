<?php

namespace DCKAP\NewModule\Block;
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use DCKAP\NewModule\Model\PostFactory;
use Magento\Framework\App\Cache\Type\Config;
class Form extends Template
{
    protected $postFactory;
    protected $_configCacheType;
    public function __construct(\Magento\Directory\Block\Data $directoryBlock,\Magento\Directory\Model\Country $country,\Magento\Store\Model\StoreManagerInterface $storeManager,Config $configCacheType,PostFactory $postFactory,Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->postFactory = $postFactory;
        $this->directoryBlock = $directoryBlock;
        $this->_storeInfo = $storeManager;
        $this->_configCacheType=$configCacheType;
        $this->country = $country;

        //$this->storeManager = $storeManager;

    }

    public function getFormAction()
    {
        return $this->getUrl('newmodule/customer/submit', ['_secure' => true]);
    }

    public function getAllData()
    {
        $entity_id = $this->getRequest()->getParam("entity_id");
        $model = $this->postFactory->create();
        return $model->load($entity_id);
    }

    public function getViewAllPage(){
        return $this->getUrl('newmodule/customer/showdata');
    }
    public function getRegion($countryCode)
    {
        $regionCollection = $this->country->loadByCode($countryCode)->getRegions();
        $regions = $regionCollection->loadData()->toOptionArray(false);
        return $regions;
    }

}
