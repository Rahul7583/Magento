<?php

class Rp_Salesman_Block_Adminhtml_Salesman_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

	protected function _construct()
	{
		$this->_blockGroup = 'salesman';
        $this->_controller = 'adminhtml_salesman';
	}
	
	public function getHeaderText()
    {
        $model = Mage::registry('current_salesman');
        if ($model->getId()) 
        {
            return Mage::helper('salesman')->__("Edit salesman");
        } 
        else 
        {
            return Mage::helper('salesman')->__("Add new salesman");
        }
    }
}