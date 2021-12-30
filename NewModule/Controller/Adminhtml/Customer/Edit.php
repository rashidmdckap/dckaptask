<?php

namespace DCKAP\NewModule\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use DCKAP\NewModule\Model\CustomerFactory;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $backendSession;

    /**
     * @var Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var DCKAP\NewModule\Model\CustomerFactory
     */
    protected $customerFactory;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param CustomerFactory $customerFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context         $context,
        Registry        $registry,
        CustomerFactory $customerFactory,
        PageFactory     $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->backendSession = $context->getSession();
        $this->registry = $registry;
        $this->customerFactory = $customerFactory;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $customer = $this->customerFactory->create();

        if ($this->getRequest()->getParam('entity_id')) {
            $customerId = $this->getRequest()->getParam('entity_id');
            $customer->load($customerId);
            $customerName = $customer->getcustom_name();
            if (!$customer->getentity_id()) {
                $this->messageManager->addError(__('Item does not exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->backendSession->getFormData(true);
        if (!empty($data)) {
            $customer->setData($data);
        }

        $this->registry->register('newmodule_customer', $customer);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('DCKAP_NewModule::customer');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Customer'));
        $resultPage->getConfig()->getTitle()->prepend(isset($customerName) ? $customerName :
            __('New Customer'));
        return $resultPage;
    }
}








