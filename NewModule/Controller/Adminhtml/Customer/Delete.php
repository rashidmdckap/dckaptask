<?php

namespace DCKAP\NewModule\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use DCKAP\NewModule\Model\PostFactory;

class Delete extends Action
{
    protected $postFactory;
    public function __construct(
        Context $context,
        PostFactory $postFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
    }
    public function execute()
    {
        $customerId = $this->getRequest()->getParam('entity_id');
        $resultRedirect = $this->resultRedirectFactory->create();

        $customer = $this->postFactory->create()->load($customerId);
        if (!($customer->getentity_id())) {
            $this->messageManager->addError(__("Customer doesn't exists."));
        }
        try {
            $customer->delete();
            $this->messageManager->addSuccess(__("Customer deleted succesfully."));
        } catch (\Exception $e) {
            $this->messageManager->addError(__("Error occurred while deleting customer."));
        }
        return $resultRedirect->setPath('*/*/index', ['_current' => true]);
    }
}
