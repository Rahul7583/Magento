<?php

class Rp_Process_Block_Adminhtml_Process_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

    protected function _construct()
    {
        // code...
        $this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_process';
    }

    public function getHeaderText()
    {
        // code...
        return "Add/Edit Form";
    }




	/*protected function _construct()
	{
		$this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_process';
	}
	
	public function getHeaderText()
    {
        $model = Mage::registry('current_process');
        if ($model->getId()) 
        {
            return Mage::helper('process')->__("Edit process");
        } 
        else 
        {
            return Mage::helper('process')->__("Add new process");
        }
    }*/
}