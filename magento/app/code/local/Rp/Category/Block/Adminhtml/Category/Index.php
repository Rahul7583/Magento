<?php 
class Rp_Category_Block_Adminhtml_Category_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_controller = 'adminhtml_category_index';
		$this->_blockGroup = 'category';
		$this->_headerText = Mage::helper('category')->__('Category_Grid');
		$this->_addButtonLable = Mage::helper('category')->__('Add New category');
	}
}