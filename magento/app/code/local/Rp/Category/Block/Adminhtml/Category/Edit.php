<?php

class Rp_Category_Block_Adminhtml_Category_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

	protected function _construct()
	{
		$this->_blockGroup = 'category';
        $this->_controller = 'adminhtml_category';
	}
	
	

	public function getHeaderText()
    {
        $model = Mage::registry('current_category');
        if ($model->getId()) 
        {
            return Mage::helper('category')->__("Edit category");
        } 
        else 
        {
            return Mage::helper('category')->__("Add new category");
        }
    }
}