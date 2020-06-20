<?php 

namespace Blog\Management\Model\ResourceModel\DataExample;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
		$this->_init("Blog\Management\Model\DataExample","Blog\Management\Model\ResourceModel\DataExample");
	}
}
 ?>