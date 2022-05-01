<?php

class Rp_Process_Block_Adminhtml_Entry_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

    protected function _construct()
    {
        // code...
        $this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_entry';
    }

   public function getHeaderText()
    {
        $model = Mage::registry('current_entry');
        if ($model->getId()) 
        {
            return Mage::helper('process')->__("Edit Column");
        } 
        else 
        {
            return Mage::helper('process')->__("Add new Column");
        }
    }
}    

