<?php

class SmartMouse_Custom_Block_Adminhtml_Custom_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('category_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(

            Mage::helper('custom')->__('Details')

        );
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'category_section',
            array(
                'label' => Mage::helper('custom')->__('Info'),
                'title' => Mage::helper('custom')->__('Info'),
                'content' => $this->getLayout()->createBlock('custom/adminhtml_custom_edit_info_form')->toHtml(),
            )
        );

        return parent::_beforeToHtml();
    }
}