<?php

namespace DCKAP\NewModule\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Model\Cart;

class RestrictAddToCart implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $_messageManager;
    private Product $product;
    private ProductRepositoryInterface $productrepositoryinterface;

    /** @var Cart $cart */
    protected $cart;

    /**
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(\Magento\Framework\Message\ManagerInterface $messageManager, Product $product,ProductRepositoryInterface $productrepositoryinterface,Cart $cart)
    {
        $this->_messageManager = $messageManager;
        $this->product = $product;
        $this->productrepositoryinterface = $productrepositoryinterface;
        $this->cart  = $cart;
    }

    /**
     * add to cart event handler.
     *
     * @param \Magento\Framework\Event\Observer $observer
     *
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
//        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/custom.log');
//        $logger = new \Zend\Log\Logger();
//        $logger->addWriter($writer);
//        $logger->info('Hello');

        $totalItems = $this->cart->getQuote()->getItemsCount();
        // get quote items collection
        if($totalItems>0){
            $product = $observer->getEvent()->getData('product');
            $productId = $product->getId();
            $product=$this->productrepositoryinterface->getById($productId);
            $customAttribute = $product->getCustomAttribute('pre_orders')->getValue();
            $itemsCollection = $this->cart->getQuote()->getItemsCollection();
            foreach($itemsCollection as $item){
                $cartItemId = $item->getProductId();
                $products=$this->productrepositoryinterface->getById($cartItemId);
                $customAttributes = $products->getCustomAttribute('pre_orders')->getValue();
            }
            if($customAttribute!=$customAttributes){
                $this->_messageManager->addError(__('This Product Not added in cart'));
                $observer->getRequest()->setParam('product', false);
            }
        }
    }
}
