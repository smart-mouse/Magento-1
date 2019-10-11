<?php

Class SmartMouse_Custom_Block_Adminhtml_Custom_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $helper = Mage::helper('custom');
        $value = $row->getData($this->getColumn()->getIndex());
        return '<img style="height: 50px; width: auto;" src=' . $helper->getImageUrl($value) . ' />';
    }
}