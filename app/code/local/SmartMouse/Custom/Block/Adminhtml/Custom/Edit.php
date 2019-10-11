<?php

class SmartMouse_Custom_Block_Adminhtml_Custom_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _getHelper()
    {
        return Mage::helper('custom');
    }

    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'custom';
        $this->_controller = 'adminhtml_custom';
        $this->_mode       = 'edit';

        $this->_addButton(
            'delete',
            array(
            'label'     => $this->_getHelper()->__('Delete'),
            'class'     => 'delete',
            'onclick'   => 'deleteConfirm(\''. $this->_getHelper()->__('Are you sure you want to do this?')
                .'\', \'' . $this->getDeleteUrl() . '\')',
        ));

        $this->_updateButton(
            'save',
            'label',
            $this->_getHelper()->__('Save')
        );
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => $this->_getHelper()->__(
                    'Save and Continue Edit'
                ),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ), -100
        );

        $this->_formScripts[] = "function saveAndContinueEdit() {
                                    editForm.submit($('edit_form').action+'back/edit/');
                                }";
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/custom/delete', array('game_id' =>$this->getRequest()->getParam('game_id')));
    }
}
