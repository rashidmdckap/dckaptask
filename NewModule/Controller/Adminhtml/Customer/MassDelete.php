<?php

namespace DCKAP\NewModule\Controller\Adminhtml\Customer;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use DCKAP\NewModule\Helper\Data;
use DCKAP\NewModule\Model\ResourceModel\Post\CollectionFactory;

class MassDelete extends Action
{
    protected $filter;

    protected $helper;

    protected $customerCollectionFactory;

    public function __construct(
        Context $context,
        Filter $filter,
        Data $helper,
        CollectionFactory $customerCollectionFactory
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->helper = $helper;
        $this->customerCollectionFactory = $customerCollectionFactory;
    }
    public function execute()
    {
        $customerCollection = $this->filter->getCollection(
            $this->customerCollectionFactory->create()
        );

        $count = 0;
        if ($customerCollection->getSize()) {
            foreach ($customerCollection as $customer) {
                $this->helper->deleteObject($customer);
                $count++;
            }
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $count));

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }

}
