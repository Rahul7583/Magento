<?php 
class Rp_Process_Block_Adminhtml_Group_Index_Grid extends Mage_Adminhtml_Block_widget_grid
{
	public function __construct()
	{
		echo "grid";
		parent::__construct();
		$this->setId('ProcessGroup_Grid');
		$this->setDefultSort('process_group_id');
		$this->setUseAjax(true);
		$this->setSaveParameterInSession(true);
	}

	public function _prepareCollection()
	{
		$collection = Mage::getModel('process/process_group')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	public function _prepareColumns()
	{
		$this->addColumn('process_group_id',
			array('header' => Mage::helper('process')->__('Id'),
					'index' => 'process_group_id'
			));
		
		$this->addColumn('name', array(
				'header' => Mage::helper('process')->__('Name'),
				'index' =>'name'
		));
		
		return parent::_prepareColumns();
	}

	protected function _prepareMassaction()
    {
        $this->setMassactionIdField('process_group_id');
        $this->getMassactionBlock()->setFormFieldName('process');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('process')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('process')->__('Are you sure?')
        ));
    }
	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}