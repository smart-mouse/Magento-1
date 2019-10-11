<?php
class SmartMouse_Custom_Model_Custom extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('custom/custom');
    }

    public function toOptionArray()
    {
        return array(
            '0' => Mage::helper('custom')->__('Item 0'),
            '1' => Mage::helper('custom')->__('Item 1'),
            '2' => Mage::helper('custom')->__('Item 2')
        );
    }
}