<?php

namespace DCKAP\NewModule\Block;
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use DCKAP\NewModule\Model\ResourceModel\Post\CollectionFactory;
use Magento\Directory\Model\RegionFactory;

class Showdata extends Template
{
    protected $collectionfactory;
    protected $regionFactory;

    public function __construct(Context $context, CollectionFactory $collectionfactory, RegionFactory $regionFactory, array $data = [])
    {
        $this->collectionfactory = $collectionfactory;
        $this->regionFactory = $regionFactory;
        parent::__construct($context, $data);
    }

    public function getCollection()
    {
        return $this->collectionfactory->create();
    }
    public function getDeleteAction()
    {
        return $this->getUrl('newmodule/customer/delete', ['_secure' => true]);
    }
    public function getEditAction()
    {
        return $this->getUrl('newmodule/customer/index', ['_secure' => true]);
    }
    public function getFormPage(){
        return $this->getUrl('newmodule/customer/index');
    }
    public function getRegionData( $regionId ){
        $region = $this->regionFactory->create()->load($regionId);
        return $region->getData();
    }

}
