<?php

namespace DCKAP\NewModule\Ui\Component\Form\Customer;

use Magento\Framework\Data\OptionSourceInterface;
use DCKAP\NewModule\Model\PostFactory;

class CustomerOptions implements OptionSourceInterface
{
    protected $postFactory;

    public function __construct(
        PostFactory $postFactory
    ) {
        $this->postFactory = $postFactory;
    }
    public function toOptionArray()
    {
        $customerCollection = $this->postFactory->create()
            ->getCollection();

        $data = [];
        foreach ($customerCollection as $customer) {
            $data[] = ['value' => $customer->getentity_id(), 'label' => $customer->getcustom_name()];
        }

        return $data;
    }

}
