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

    public function editAction()
    {
        $id = $this->getRequest()->getParam('game_id');
        $model = Mage::getModel('custom/custom');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->_getSession()->addError(
                    $this->__('This Game no longer exists.')
                );
                $this->_redirect('*/*/');
                return;
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('current_model', $model);

        $this
            ->loadLayout()
            ->renderLayout();
    }
}