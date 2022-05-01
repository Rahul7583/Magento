<?php 
class Rp_Process_Block_Adminhtml_Entry_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_controller = 'adminhtml_entry_index';
		$this->_blockGroup = 'process';
		$this->_headerText = Mage::helper('process')->__('ProcessEntry_Grid');
		$this->_addButtonLable = Mage::helper('process')->__('Add Process Entry');
	}
}