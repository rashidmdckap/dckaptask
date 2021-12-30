<?php

namespace DCKAP\NewModule\Block\Adminhtml\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use DCKAP\NewModule\Model\PostFactory;

class GenericButton
{
    protected $context;

    protected $postFactory;

    public function __construct(
        Context $context,
        PostFactory $postFactory
    ) {
        $this->context = $context;
        $this->postFactory = $postFactory;
    }

    public function getLabelId()
    {
        try {
            return $this->context->getRequest()->getParam('entity_id');
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
