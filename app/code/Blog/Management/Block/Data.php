<?php
namespace Blog\Management\Block;
class Data extends \Magento\Framework\View\Element\Template
{
	public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
		parent::__construct($context);
	}

	public function displaydata()
	{
		return __('View in Magento2');
	}
}