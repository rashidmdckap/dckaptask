<?php

namespace DCKAP\NewModule\Controller\Customer;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use DCKAP\NewModule\Model\PostFactory;

class Index extends Action
{
    protected $resultPageFactory;
    private $postFactory;
    private $url;

    public function __construct(UrlInterface $url, PostFactory $postFactory, Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->postFactory = $postFactory;
        $this->url = $url;
    }

    public function execute()
    {
        if ($this->isCorrectData()) {
            return $this->resultPageFactory->create();
        } else {
            $this->messageManager->addErrorMessage(__("Record Not Found"));
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->url->getUrl('newmodule/customer/showdata'));
            return $resultRedirect;
        }
    }

    public function isCorrectData()
    {
        if ($entity_id = $this->getRequest()->getParam("entity_id")) {
            $model = $this->postFactory->create();
            $model->load($entity_id);
            if ($model->getentity_id()) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

}
