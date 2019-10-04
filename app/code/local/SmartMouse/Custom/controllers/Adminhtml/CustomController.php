<?php

require_once 'app/code/core/Mage/Adminhtml/Controller/Action.php';

class SmartMouse_Custom_Adminhtml_CustomController
    extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('catalog');
        $this->_title($this->__('Custom'));
        $this->renderLayout();
    }
}