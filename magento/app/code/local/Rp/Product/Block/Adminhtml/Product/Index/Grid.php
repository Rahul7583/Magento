<?php 
class Rp_Product_Block_Adminhtml_Product_Index_Grid extends Mage_Adminhtml_Block_widget_grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('product_Grid');
		$this->setDefultSort('productId');
		$this->setUseAjax(true);
		$this->setSaveParameterInSession(true);
	}

	public function _prepareCollection()
	{
		$collection = Mage::getModel('product/product')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	public function _prepareColumns()
	{
		$this->addColumn('productId',
			array('header' => Mage::helper('product')->__('Id'),
					'index' => 'productId'
			));
		$this->addColumn('name', array(
				'header' => Mage::helper('product')->__('Name'),
				'index' =>'name'
		));
		$this->addColumn('sku', array(
				'header' => Mage::helper('product')->__('sku'),
				'index' =>'sku'
		));

		$this->addColumn('price', array(
				'header' => Mage::helper('product')->__('Price'),
				'index' => 'price'
		));

		$this->addColumn('quantity', array(
				'header' => Mage::helper('product')->__('Quantity'),
				'index' => 'quantity'
		));

		$this->addColumn('status', array(
				'header' => Mage::helper('product')->__('Status'),
				'index' => 'status'
		));

		$this->addColumn('createdAt', array(
				'header' => Mage::helper('product')->__('createdAt'),
				'index' => 'createdAt'
		));
		$this->addColumn('updatedAt', array(
				'header' => Mage::helper('product')->__('updatedAt'),
				'index' => 'updatedAt'
		));

		 $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('product')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('product')->__('Edit'),
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
        $this->setMassactionIdField('productId');
        $this->getMassactionBlock()->setFormFieldName('product');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('product')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('product')->__('Are you sure?')
        ));
    }
	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}