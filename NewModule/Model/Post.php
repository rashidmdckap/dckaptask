<?php

namespace DCKAP\NewModule\Model;

class Post extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('DCKAP\NewModule\Model\ResourceModel\Post');
    }

}

?>
