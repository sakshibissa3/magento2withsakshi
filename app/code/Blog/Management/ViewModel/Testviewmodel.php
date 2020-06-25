<?php
namespace Blog\Management\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Testviewmodel implements ArgumentInterface
{
    public function __construct() {

    }

    public function getSomething()
    {
        return "Display Text";
    }
}