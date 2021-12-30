<?php
namespace DCKAP\NewModule\Controller\Customer;
class Config extends \Magento\Framework\App\Action\Action
{
    protected $helperData;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \DCKAP\NewModule\Helper\Data $helperData
    )
    {
        $this->helperData = $helperData;
        return parent::__construct($context);
    }
    public function execute()
    {
        echo $this->helperData->getGeneralConfig('enable');
        exit();
    }
}
