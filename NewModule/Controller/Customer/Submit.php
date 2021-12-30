<?php

namespace DCKAP\NewModule\Controller\Customer;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use DCKAP\NewModule\Model\PostFactory;

class Submit extends Action
{
    protected $resultPageFactory;
    protected $postFactory;
    private $url;

    public function __construct(
        UrlInterface $url,
        Context $context,
        PageFactory $resultPageFactory,
        PostFactory $postFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->postFactory = $postFactory;
        $this->url = $url;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getPost();
            if ($data) {
                $name = $this->getRequest()->getPost('custom_name');
                $age = $this->getRequest()->getPost('custom_age');
                $dob = $this->getRequest()->getPost('custom_dob');
                $country = $this->getRequest()->getPost('custom_country');
                $entity_id = $this->getRequest()->getPost('entity_id');
                $model = $this->postFactory->create();
                $model->setData('custom_name',$name);
                $model->setData('custom_age',$age);
                $model->setData('custom_dob',$dob);
                $model->setData('custom_country',$country);
                $model->setData('entity_id',$entity_id);
                $model->save();

                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        //$resultRedirect->setUrl('/newmodule/customer/showdata');
        $resultRedirect->setUrl($this->url->getUrl('newmodule/customer/showdata'));
        return $resultRedirect;

    }

}
