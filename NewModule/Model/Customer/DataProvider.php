<?php

namespace DCKAP\NewModule\Model\Customer;
use DCKAP\NewModule\Model\ResourceModel\Customer\Grid\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        CollectionFactory $collectionFactory,
                          $name,
                          $primaryFieldName,
                          $requestFieldName,
        array             $meta = [],
        array             $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        $customer = $this->collection->getItems();

        foreach ($customer as $custom) {
            $this->_loadedData[$custom->getentity_id()] = $custom->getData();
        }
        return $this->_loadedData;
    }
}



