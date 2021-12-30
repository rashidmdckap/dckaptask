<?php

namespace DCKAP\NewModule\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use DCKAP\NewModule\Model\PostFactory;

class Save extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PostFactory $postFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$this->getRequest()->isPost()) {
            $this->messageManager->addError(__("Something went wrong"));
            return $resultRedirect->setPath('*/*/');
        }
        try {
            $name = $this->getRequest()->getPost('custom_name');
            $age = $this->getRequest()->getPost('custom_age');
            $dob = $this->getRequest()->getPost('custom_dob');
            $country = $this->getRequest()->getPost('custom_country');
            $entity_id = $this->getRequest()->getPost('entity_id');
            $customerModel = $this->postFactory->create();
            $customerModel->setData('custom_name',$name);
            $customerModel->setData('custom_age',$age);
            //$customerModel->setData('custom_dob',date("m-d-Y", strtotime($dob)));
            $customerModel->setData('custom_dob',$dob);
            $customerModel->setData('custom_country',$country);
            $customerModel->setData('entity_id',$entity_id);
            $customerModel->save();

        } catch (\Exception $e) {
            $this->messageManager->addError(__("Something went wrongly"));
            return $resultRedirect->setPath('*/*/');
        }
        $this->messageManager->addSuccess(__("Customer saved successfully"));
        return $resultRedirect->setPath('*/*/');
    }

}
