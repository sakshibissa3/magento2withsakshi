<?php
 
namespace Blog\Management\Block;
 
class Form extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Catalog\Block\Product\Context $context, array $data = []) {
 
        parent::__construct($context, $data);
 
    }
 
 
    public function getFormAction()
    {
           

        return 'blogs/submit/submit';
    }
 
/**
* Render block HTML.
*
* @return string
*/
}