<?php

Class SmartMouse_Custom_Block_Adminhtml_Custom_Renderer_Date extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $helper = Mage::helper('custom');

        return $helper->formatDate($row->getDate());
    }
}