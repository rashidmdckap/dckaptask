<?php

namespace DCKAP\NewModule\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $scopeConfig;
    /**
     * Data constructor
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param $getSalableQuantityDataBySku
     */

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return $telephoneConfig
     */
    public function getEnable()
    {
        $enableConfig = $this->scopeConfig->getValue(
            'newmodule/general/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $enableConfig;
    }

}
