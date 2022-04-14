<?php 
class Rp_Salesman_Block_Adminhtml_Salesman_Index_Grid extends Mage_Adminhtml_Block_widget_grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('salesman_Grid');
		$this->setDefultSort('salesmanId');
		$this->setUseAjax(true);
		$this->setSaveParameterInSession(true);
	}

	public function _prepareCollection()
	{
		$collection = Mage::getModel('salesman/salesman')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	public function _prepareColumns()
	{
		$this->addColumn('salesmanId',
			array('header' => Mage::helper('salesman')->__('Id'),
					'index' => 'salesmanId'
			));
		$this->addColumn('fistName', array(
				'header' => Mage::helper('salesman')->__('First Name'),
				'index' =>'firstName'
		));
		$this->addColumn('lastName', array(
				'header' => Mage::helper('salesman')->__('Last Name'),
				'index' =>'lastName'
		));

		$this->addColumn('email', array(
				'header' => Mage::helper('salesman')->__('Email'),
				'index' => 'email'
		));

		$this->addColumn('mobile', array(
				'header' => Mage::helper('salesman')->__('Mobile'),
				'index' => 'mobile'
		));

		$this->addColumn('status', array(
				'header' => Mage::helper('salesman')->__('Status'),
				'index' => 'status'
		));

		$this->addColumn('createdAt', array(
				'header' => Mage::helper('salesman')->__('createdAt'),
				'index' => 'createdAt'
		));
		$this->addColumn('updatedAt', array(
				'header' => Mage::helper('salesman')->__('updatedAt'),
				'index' => 'updatedAt'
		));
 		$this->addColumn('action',
            array(
                'header'    =>  Mage::helper('salesman')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('salesman')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		return parent::_prepareColumns();
	}

	protected function _prepareMassaction()
    {
        $this->setMassactionIdField('salesmanId');
        $this->getMassactionBlock()->setFormFieldName('salesman');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('salesman')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('salesman')->__('Are you sure?')
        ));
    }
	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}