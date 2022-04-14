<?php 
class Rp_Salesman_Block_Adminhtml_Salesman_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_controller = 'adminhtml_salesman_index';
		$this->_blockGroup = 'salesman';
		$this->_headerText = Mage::helper('salesman')->__('Salesman_Grid');
		$this->_addButtonLable = Mage::helper('salesman')->__('Add New Salesman');
	}
}