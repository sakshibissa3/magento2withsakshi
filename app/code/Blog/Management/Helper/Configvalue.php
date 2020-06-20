<?php
namespace Blog\Management\Helper;

use Magento\Framework\App\Helper\Context;

class Configvalue extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        Context $context
        ) 
    {
        $this->_scopeConfig = $scopeConfig;

        parent::__construct($context);
    }

    public function getdata()
    {
       $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
       echo $this->scopeConfig->getValue("customsection/general/enable", $storeScope);

    }
}

