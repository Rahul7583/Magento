<?php 
class Rp_Product_Block_Adminhtml_Product_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_controller = 'adminhtml_product_index';
		$this->_blockGroup = 'product';
		$this->_headerText = Mage::helper('product')->__('Product_Grid');
		$this->_addButtonLable = Mage::helper('product')->__('Add New Product');
	}
}