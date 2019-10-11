<?php
class SmartMouse_Custom_Block_Adminhtml_Custom_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('id');
        $this->setId('custom_custom_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);

    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('custom/custom')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id',
            array(
                'header'=> $this->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'id'
            )
        );

        $this->addColumn('image',
            array(
                'header'=> $this->__('Image'),
                'index' => 'image'
            )
        );

        $this->addColumn('main_team_id',
            array(
                'header'=> $this->__('Select'),
                'index' => 'main_team_id',
                'type'      => 'options',
                'options' => Mage::getModel('custom/custom')->toOptionArray(),
            )
        );

        $this->addColumn('title',
            array(
                'header'=> $this->__('Text'),
                'index' => 'title'
            )
        );

        $this->addColumn('date',
            array(
                'header'=> $this->__('Date'),
                'type' => 'datetime',
                'index' => 'date',
                'format'	=> Mage::app()->getLocale()->getDateFormat()
            )
        );

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/custom/edit', array('game_id' => $row->getId()));
    }
}