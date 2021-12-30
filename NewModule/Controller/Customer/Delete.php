<?php
namespace DCKAP\NewModule\Controller\Customer;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use DCKAP\NewModule\Model\PostFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

class Delete extends Action
{
    protected $resultPageFactory;
    protected $postFactory;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        PostFactory $postFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
        $this->postFactory = $postFactory;
    }
    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getParams();
            if ($data) {
                $model = $this->postFactory->create()->load($data['entity_id']);
                $model->delete();
                $this->messageManager->addSuccessMessage(__("Record Delete Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t delete record, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
