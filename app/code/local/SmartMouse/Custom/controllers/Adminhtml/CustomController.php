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

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        if ($data = $this->getRequest()->getPost()) {
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                $imageDir = Mage::helper('custom')->getImageDir();
                try {
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpeg', 'jpg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);

                    $path = 'media' . DS . $imageDir;
                    $uploader->save($path, $_FILES['image']['name']);
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }

                $data['image'] = $imageDir . DS . $_FILES['image']['name'];
            }

            if(isset($data['image']['value']) && $data['image']['value'] != '') {
                $data['image'] = $data['image']['value'];
            }

            $id = $this->getRequest()->getParam('id');
            $model = Mage::getModel('custom/custom');
            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    $this->_getSession()->addError(
                        $this->__('This Game no longer exists.')
                    );
                    $this->_redirect('*/*/index');
                    return;
                }
            }

            try {
                $model->addData($data);
                $this->_getSession()->setFormData($data);
                $model->save();
                $this->_getSession()->setFormData(false);
                $this->_getSession()->addSuccess(
                    $this->__('The Game has been saved.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            } catch (Exception $e) {
                $this->_getSession()->addError(

                    $this->__('Unable to save the Game.')

                );
                $redirectBack = true;
                Mage::logException($e);
            }

            if ($redirectBack) {
                $this->_redirect('*/*/edit', array('game_id' => $model->getId()));
                return;
            }
        }
        $this->_redirect('*/*/index');
    }
}