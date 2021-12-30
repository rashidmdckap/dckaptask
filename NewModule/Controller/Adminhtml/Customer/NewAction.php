<?php

namespace DCKAP\NewModule\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;

class NewAction extends Action
{
    protected $resultPageFactory;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->backendSession = $context->getSession();
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        $result->forward('edit');
        return $result;
    }
}
