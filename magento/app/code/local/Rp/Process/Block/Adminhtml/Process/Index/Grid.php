<?php 
class Rp_Process_Block_Adminhtml_Process_Index_Grid extends Mage_Adminhtml_Block_widget_grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('Process_Grid');
		$this->setDefultSort('process_id');
		$this->setUseAjax(true);
		$this->setSaveParameterInSession(true);
	}

	public function _prepareCollection()
	{
		$collection = Mage::getModel('process/process')->getCollection();
		foreach ($collection->getItems() as $data) 
        {
            $data->group_id = Mage::getModel('process/process_group')
            					->load($data->group_id)->name;
        }
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	public function _prepareColumns()
	{
		$this->addColumn('process_id',
			array('header' => Mage::helper('process')->__('Process Id'),
					'index' => 'process_id'
			));
		
		$this->addColumn('group_id',
			array('header' => Mage::helper('process')->__('Group Id'),
					'index' => 'group_id'
			));
		
		$this->addColumn('type_id', array(
				'header' => Mage::helper('process')->__('Type Id'),
				'index' => 'type_id',
				'type'      => 'options',
	            'options'   => array(
	            		Rp_Process_Model_Process::TYPE_ID_IMPORT => Mage::helper('process')->__('IMPORT'),
		                Rp_Process_Model_Process::TYPE_ID_EXPORT => Mage::helper('process')->__('EXPORT'),
		                Rp_Process_Model_Process::TYPE_ID_CRON => Mage::helper('process')->__('CRON') 
	            ),
		            
		));
		$this->addColumn('name', array(
				'header' => Mage::helper('process')->__('Name'),
				'index' =>'name'
		));
		$this->addColumn('per_request_count', array(
				'header' => Mage::helper('process')->__('Per Request Count'),
				'index' =>'per_request_count'
		));

		$this->addColumn('request_interval', array(
				'header' => Mage::helper('process')->__('Request Interval'),
				'index' => 'request_interval'
		));

		$this->addColumn('request_model', array(
				'header' => Mage::helper('process')->__('Request Model'),
				'index' => 'request_model'
		));

		$this->addColumn('file_name', array(
				'header' => Mage::helper('process')->__('File Name'),
				'index' => 'file_name'
		));

		$this->addColumn('created_date', array(
				'header' => Mage::helper('process')->__('Created Date'),
				'index' => 'created_date'
		));

		$this->addColumn('Upload',
            array(
                'header'    =>  Mage::helper('process')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('process')->__('Upload'),
                        'url'       => array('base'=> '*/adminhtml_upload/uploadfile'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

        $this->addColumn('Verify',
            array(
                'header'    =>  Mage::helper('process')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('process')->__('Varify'),
                        'url'       => array('base'=> '*/adminhtml_upload/verify'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

        $this->addColumn('Execute',
            array(
                'header'    =>  Mage::helper('process')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('process')->__('Execute'),
                        'url'       => array('base'=> '*/adminhtml_upload/execute'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

        $this->addColumn('Download',
            array(
                'header'    =>  Mage::helper('process')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('process')->__('Download'),
                        'url'       => array('base'=> '*/adminhtml_upload/export'),
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
        $this->setMassactionIdField('process_id');
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