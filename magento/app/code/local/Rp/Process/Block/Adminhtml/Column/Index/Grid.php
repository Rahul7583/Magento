<?php 
class Rp_Process_Block_Adminhtml_Column_Index_Grid extends Mage_Adminhtml_Block_widget_grid
{

	protected function getProcessName()
    {
        $model = Mage::getModel('process/process');
        $select = $model->getCollection()
                    ->getSelect()
                    ->reset(Zend_Db_Select::COLUMNS)
                    ->columns(['value' => 'process_id','label' => 'name'])
                    ->order('name','ASC');
        $processName = $model->getResource()->getReadConnection()->fetchAll($select);
        if ($processName) {
          return $processName[0];
        }
        return [];
    }
	public function __construct()
	{
		parent::__construct();
		$this->setId('ProcessColumn_Grid');
		$this->setDefultSort('column_id');
		$this->setUseAjax(true);
		$this->setSaveParameterInSession(true);
	}

	public function _prepareCollection()
	{
		$collection = Mage::getModel('process/process_column')->getCollection();
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
		$this->addColumn('column_id',
			array('header' => Mage::helper('process')->__('Id'),
					'index' => 'column_id'
			));

		$this->addColumn('process_id', array(
                'header' => Mage::helper('process')->__('Process Name'),
                'index' => 'process_id',
                'type'      => 'options',
                'options'   => $this->getProcessName(),
        ));
		
		$this->addColumn('name', array(
				'header' => Mage::helper('process')->__('Name'),
				'index' =>'name'
		));

		$this->addColumn('required', array(
				'header' => Mage::helper('process')->__('Required'),
				'index' => 'required',
				'type'      => 'options',
	            'options'   => array(
	                Rp_Process_Model_Process_Column::REQUIRED_YES => Mage::helper('process')->__('YES'),
	                Rp_Process_Model_Process_Column::REQUIRED_NO => Mage::helper('process')->__('NO')  
	            ),
		));

		$this->addColumn('casting_type', array(
				'header' => Mage::helper('process')->__('Casting Type'),
				'index' => 'casting_type',
				'type'      => 'options',
	            'options'   => array(
	                Rp_Process_Model_Process_Column::CASTING_TYPE_VARCHAR => Mage::helper('process')->__('VARCHAR'),
	                Rp_Process_Model_Process_Column::CASTING_TYPE_INT => Mage::helper('process')->__('INT'),
	                Rp_Process_Model_Process_Column::CASTING_TYPE_DECIMAL => Mage::helper('process')->__('DECIMAL')
	            ),
		));

		$this->addColumn('exception', array(
				'header' => Mage::helper('process')->__('Exception'),
				'index' =>'exception',
				'type' => 'options',
				'options' => array(
						Rp_Process_Model_Process_Column::EXCEPTION_YES => Mage::helper('process')->__('YES'),
						Rp_Process_Model_Process_Column::EXCEPTION_NO => Mage::helper('process')->__('NO')
				),
		));


		$this->addColumn('created_date', array(
				'header' => Mage::helper('process')->__('Created Date'),
				'index' =>'created_date'
		));

		
		return parent::_prepareColumns();
	}

	protected function _prepareMassaction()
    {
        $this->setMassactionIdField('column_id');
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