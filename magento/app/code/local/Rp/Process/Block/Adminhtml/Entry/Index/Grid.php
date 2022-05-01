<?php 
class Rp_Process_Block_Adminhtml_Entry_Index_Grid extends Mage_Adminhtml_Block_widget_grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('ProcessEntry_Grid');
		$this->setDefultSort('entry_id');
		$this->setUseAjax(true);
		$this->setSaveParameterInSession(true);
	}

	public function _prepareCollection()
	{
		$collection = Mage::getModel('process/process_entry')->getCollection();
		foreach ($collection->getItems() as $data) 
        {
            $data->process_id = Mage::getModel('process/process')
            					->load($data->process_id)->name;
        }
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	public function _prepareColumns()
	{
		
		$this->addColumn('entry_id',
			array('header' => Mage::helper('process')->__('Entry Id'),
					'index' => 'entry_id'
			));

		$this->addColumn('process_id',
			array('header' => Mage::helper('process')->__('Process Id'),
					'index' => 'process_id',
			));
		
		$this->addColumn('identifier', array(
				'header' => Mage::helper('process')->__('Identifier'),
				'index' =>'identifier'
		));

		$this->addColumn('start_time', array(
				'header' => Mage::helper('process')->__('Start Time'),
				'index' =>'start_time'
		));

		$this->addColumn('end_time', array(
				'header' => Mage::helper('process')->__('End Time'),
				'index' =>'end_time'
		));

		$this->addColumn('data', array(
				'header' => Mage::helper('process')->__('Data'),
				'index' =>'data'
		));


		$this->addColumn('created_date', array(
				'header' => Mage::helper('process')->__('Created Date'),
				'index' =>'created_date'
		));

		
		return parent::_prepareColumns();
	}

	protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entry_id');
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