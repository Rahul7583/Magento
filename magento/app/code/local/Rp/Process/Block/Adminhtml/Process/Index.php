<?php 
class Rp_Process_Block_Adminhtml_Process_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_controller = 'adminhtml_process_index';
		$this->_blockGroup = 'process';
		$this->_headerText = Mage::helper('process')->__('Process_Grid');
		$this->_addButtonLable = Mage::helper('process')->__('Add New Process');
	}
}