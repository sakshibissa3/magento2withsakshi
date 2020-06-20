<?php
namespace Blog\Management\Model\Config\Source;


use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                 'value' => $value,
                 'label' => $label,
             ];
        }

        return $result;
    }

    public function getOptions()
    {
        $data = 
       [
            'approve' => __('Approve'),
            'reject' => __('Reject'),
            'pending' => __('Pending'),
        ];
        echo "<pre>"; print_r($data); exit; 
    }
}