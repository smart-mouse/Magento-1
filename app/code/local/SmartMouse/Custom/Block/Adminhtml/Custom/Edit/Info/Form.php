<?php

class SmartMouse_Custom_Block_Adminhtml_Custom_Edit_Info_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _getModel()
    {
        return Mage::registry('current_model');
    }

    protected function _getHelper()
    {
        return Mage::helper('custom');
    }

    protected function _prepareForm()
    {
        $model = $this->_getModel();
        $form  = new Varien_Data_Form(array(
            'id'     => 'edit_form',
            'action' => $this->getUrl('*/*/save'),
            'method' => 'post'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => $this->_getHelper()->__('Custom Form'),
            'class'  => 'fieldset-wide'
        ));

        if ($model && $model->getId()) {
            $modelPk = $model->getResource()->getIdFieldName();
            $fieldset->addField($modelPk, 'hidden', array(
                'name' => $modelPk
            ));
        }

        $fieldset->addField('image', 'image', array(
                'name'     => 'image',
                'label'    => $this->_getHelper()->__('Image Uploader'),
                'title'    => $this->_getHelper()->__('Image Uploader'),
            )
        );

        $fieldset->addField('main_team_id', 'select', array(
                'name'     => 'main_team_id',
                'label'    => $this->_getHelper()->__('Select Field'),
                'title'    => $this->_getHelper()->__('Select Field'),
                'values'   => $model->toOptionArray()
            )
        );

        $fieldset->addField('title', 'text', array(
                'name'     => 'title',
                'label'    => $this->_getHelper()->__('Text Field'),
                'title'    => $this->_getHelper()->__('Text Field'),
            )
        );

        $fieldset->addField('date', 'date', array(
                'name'     => 'date',
                'label'    => $this->_getHelper()->__('Date Field'),
                'title'    => $this->_getHelper()->__('Date Fiels'),
                'format'   => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
                'image'    => $this->getSkinUrl('images/grid-cal.gif')
            )
        );

        if ($model) {
            $form->setValues($model->getData());
        }
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
