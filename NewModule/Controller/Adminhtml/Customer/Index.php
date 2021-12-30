<?php
namespace DCKAP\NewModule\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Context     $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('DCKAP_NewModule::customer');
        $resultPage->getConfig()->getTitle()->prepend(__('Add/Manage Customer'));

        return $resultPage;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('DCKAP_NewModule::customer');
    }
}
